<?php

namespace App\Http\Controllers;

use App\Models\Unit;
use App\Models\User;
use App\Models\Project;
use App\Models\subSystem;
use Illuminate\Http\Request;
use App\Models\Specification;
use App\Models\ManagesubSystem;
use App\Models\ManageDescription;
use Illuminate\Support\Facades\DB;
use App\Models\ManageSpecification;
use Illuminate\Support\Facades\Log;
use App\Models\subSystemDescription;
use App\Models\SpecificationBulkMaterial;
use App\Models\ManageSpecificationBulkMaterial;
use App\Models\PrintPDF;

class AdminProjectController extends Controller
{
    public function index()
    {
        $specification = Specification::all();
        $subSystem = subSystem::all();
        $project = Project::all();
        return view('admin.project.index', compact('project', 'subSystem', 'specification'));
    }

    public function manageProjectDestroy($id)
    {
        $manageProject = Project::find($id);
        $manageProject->delete();

        return redirect()->route('admin.project.manageProject');
    }

    function search(Request $request)
    {
        $project = project::all();
        $search = $request->search;
        $data_barang = Project::where('name', 'like', "%$search%")
            ->get();

        return view('admin.project.manageproject', [
            'project' => $data_barang
        ], compact('project'));
    }


    public function indexAdmin()
    {
        $specification = Specification::all();
        $subSystem = subSystem::all();
        $project = Project::orderBy('created_at', 'desc')
            ->take(20)
            ->get();
        return view('admin.project.admin', compact('project', 'subSystem', 'specification'));
    }

    public function adminUserManage()
    {
        $users = User::all();
        $specification = Specification::all();
        $subSystem = subSystem::all();
        $project = Project::all();
        return view('admin.project.userManage', compact('project', 'specification', 'subSystem', 'project', 'users'));
    }

    public function adminManagesubSystem()
    {
        $project = Project::all();
        $managesubSystem = ManagesubSystem::all();
        return view('admin.project.managesubSystem', compact('project', 'managesubSystem'));
    }

    public function manageProject()
    {
        $project = Project::all();
        return view('admin.project.manageproject', compact('project'));
    }


    public function create($projectId)
    {
        return view('admin.project.create', compact('projectId'));
    }

    public function store(Request $request)
    {

        $project = new Project();
        $project->name = $request->name;
        $project->save();

        return redirect()->route('admin.index');
    }

    public function show($projectId)
    {
        $subSystem = subSystem::all();

        $project = Project::findOrFail($projectId);


        return view('admin.project.show', compact('project', 'subSystem'));
    }

    public function edit($projectId)
    {
        $project = Project::findOrFail($projectId);
        return view('admin.project.edit', compact('project'));
    }

    public function update(Request $request, $id)
    {

        $project = Project::findOrFail($id);
        $project->name = $request->name;
        $project->save();

        return redirect()->route('admin.project.index');
    }

    public function destroy($id)
    {
        $project = Project::findOrFail($id);
        $project->delete();

        return redirect()->route('admin.index');
    }

    public function destroyUsers($id)
    {
        $users = User::find($id);
        $users->delete();

        return redirect()->route('admin.project.userManage');
    }

    public function subSystemedit(Request $request, $project, $subSystem)
    {
        $subSystem = subSystem::findOrFail($subSystem);

        // Validasi input
        $request->validate([
            'category' => 'required|in:budgetary,bulk_material',
        ]);

        // Update category
        $subSystem->update([
            'category' => $request->category
        ]);

        return redirect()->route('admin.project.show', ['project' => $project]);
    }

    public function copyProject(Request $request, $projectId)
    {
        $request->validate([
            'name' => 'required|string|max:2000'  // Increased max length to match schema
        ]);

        $project = Project::findOrFail($projectId);
        $project->load([
            'subSystem' => function ($query) {
                $query->with(['subSystemDescription' => function ($query) {
                    $query->with(['specification', 'specificationBulkMaterial']);
                }]);
            }
        ]);

        DB::beginTransaction();

        try {
            // Copy Project
            $newProject = $project->replicate();
            $newProject->name = $request->name;
            $newProject->save();

            // Get maximum IDs
            $maxSubSystemId = SubSystem::max('id');
            $maxDescriptionId = SubSystemDescription::max('id');
            $maxSpecificationId = Specification::max('id');
            $maxBulkMaterialId = SpecificationBulkMaterial::max('id');
            $maxTablePDFId = PrintPDF::max('id');

            // Counters for incremental IDs
            $subSystemCounter = 1;
            $descriptionCounter = 1;
            $specificationCounter = 1;
            $bulkMaterialCounter = 1;
            $tablePDFCounter = 1;

            foreach ($project->subSystem as $subSystem) {
                // Copy SubSystem
                $newSubSystem = $subSystem->replicate();
                $newSubSystem->id = $maxSubSystemId + $subSystemCounter;
                $newSubSystem->project_id = $newProject->id;
                $newSubSystem->save();
                $subSystemCounter++;

                foreach ($subSystem->subSystemDescription as $description) {
                    // Copy Description
                    $newDescription = $description->replicate();
                    $newDescription->id = $maxDescriptionId + $descriptionCounter;
                    $newDescription->subSystem_id = $newSubSystem->id;
                    $newDescription->project_id = $newProject->id;
                    $newDescription->save();
                    $descriptionCounter++;

                    // Copy Specifications
                    foreach ($description->specification as $specification) {
                        $newSpecification = $specification->replicate();
                        $newSpecification->id = $maxSpecificationId + $specificationCounter;
                        $newSpecification->subSystem_id = $newSubSystem->id;
                        $newSpecification->subSystemDescription_id = $newDescription->id;
                        $newSpecification->project_id = $newProject->id;
                        $newSpecification->save();
                        $specificationCounter++;

                        // Copy associated TablePDF if exists
                        $tablePDF = PrintPDF::where([
                            'specification' => $specification->specification
                        ])->first();

                        if ($tablePDF) {
                            $newTablePDF = $tablePDF->replicate();
                            $newTablePDF->id = $maxTablePDFId + $tablePDFCounter;
                            $newTablePDF->specification = $newSpecification->specification;
                            $newTablePDF->save();
                            $tablePDFCounter++;
                        }
                    }

                    // Copy Bulk Materials
                    $bulkMaterials = SpecificationBulkMaterial::where([
                        'project_id' => $project->id,
                        'subSystem_id' => $subSystem->id,
                        'subSystemDescription_id' => $description->id
                    ])->get();

                    foreach ($bulkMaterials as $material) {
                        $newMaterial = $material->replicate();
                        $newMaterial->id = $maxBulkMaterialId + $bulkMaterialCounter;
                        $newMaterial->project_id = $newProject->id;
                        $newMaterial->subSystem_id = $newSubSystem->id;
                        $newMaterial->subSystemDescription_id = $newDescription->id;
                        $newMaterial->save();
                        $bulkMaterialCounter++;
                    }
                }
            }

            DB::commit();
            return redirect()->route('admin.index')
                ->with('success', 'Project copied successfully with new name!');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Copy Project Error: ' . $e->getMessage());
            return back()->withErrors('Failed to copy project: ' . $e->getMessage());
        }
    }

    public function showsubSystem($projectId, $subSystemId)
    {

        $project = Project::findOrFail($projectId);
        $unit = Unit::all();
        $subSystem = subSystem::findOrFail($subSystemId);
        $currentDescriptionName = subSystemDescription::where('id', request()->segment(6))->value('Description_name');

        // Filter manageSpecification berdasarkan name (kategori) dan Description_name
        $manageSpecification = ManageSpecification::where('name', $subSystem->name)
            ->where('Description_name', $currentDescriptionName)
            ->get();
        $managesubSystem = ManagesubSystem::all();


        $subSystemDescription = subSystemDescription::where('subSystem_id', $subSystemId)
            ->where('project_id', $projectId)
            ->with('specification')
            ->get();

        $existingDescription = $subSystemDescription->pluck('Description_name')->toArray();


        // Set the subSystem name
        $subSystemName = $subSystem->name;
        // Fetch Descriptions for this subSystem
        $manageDescription = ManageDescription::where('name', $subSystemName)->get();

        $specification = [];
        foreach ($subSystemDescription as $Description) {
            $specification[$Description->id] = Specification::where('subSystemDescription_id', $Description->id)->get();

            // Mengambil manageSpecification yang sesuai untuk setiap Description
            $manageSpecification[$Description->id] = ManageSpecification::where('name', $subSystemName)
                ->where('Description_name', $Description->Description_name)
                ->pluck('specification_name')
                ->toArray();
        }
        $existingSpecifications = Specification::whereIn('subSystemDescription_id', $subSystemDescription->pluck('id'))
            ->pluck('specification')
            ->toArray();

        // Calculate total price for subSystem
        $summationsubSystem = DB::table('specification')
            ->join('subSystemDescription', 'specification.subSystemDescription_id', '=', 'subSystemDescription.id')
            ->where('subSystemDescription.subSystem_id', $subSystemId)
            ->selectRaw('SUM(CAST(specification.unit_price * specification.qty AS DECIMAL(10,2))) as total_price')
            ->value('total_price') ?? 0;

        // Calculate total price for Project
        $summationProject = DB::table('specification')
            ->join('subSystemDescription', 'specification.subSystemDescription_id', '=', 'subSystemDescription.id')
            ->where('subSystemDescription.project_id', $projectId)
            ->selectRaw('SUM(CAST(specification.unit_price * specification.qty AS DECIMAL(10,2))) as total_price')
            ->value('total_price') ?? 0;

        // Get current manage specifications if there's a current description
        $currentManageSpecification = [];
        if ($currentDescriptionName) {
            $currentManageSpecification = ManageSpecification::where([
                'name' => $subSystem->name,
                'Description_name' => $currentDescriptionName
            ])->get();
        }



        return view('admin.subSystem.subSystemDescription.index', compact(
            'project',
            'subSystemId',
            'subSystem',
            'subSystemDescription',
            'specification',
            'existingDescription',
            'summationsubSystem',
            'manageDescription',
            'summationProject',
            'managesubSystem',
            'project',
            'projectId',
            'manageDescription',
            'manageSpecification',
            'existingSpecifications',
            'unit'
        ));
    }



    public function showSubSystemBulkMaterial($projectId, $subSystemId)
    {
        // Basic data loading
        $project = Project::findOrFail($projectId);
        $subSystem = SubSystem::findOrFail($subSystemId);
        $unit = Unit::all();
        $currentDescriptionId = request()->segment(6);
        $managesubSystem = ManagesubSystem::all();

        // Get current description name
        $currentDescriptionName = SubSystemDescription::where('id', $currentDescriptionId)
            ->value('Description_name');

        // Get subsystem descriptions with specifications
        $subSystemDescription = SubSystemDescription::where([
            'subSystem_id' => $subSystemId,
            'project_id' => $projectId
        ])->with('specification')->get();

        $existingDescription = $subSystemDescription->pluck('Description_name')->toArray();

        // Get existing material specifications
        $existingMaterials = SpecificationBulkMaterial::where([
            'subSystem_id' => $subSystemId,
            'project_id' => $projectId
        ])->get();

        // Set the subSystem name and get descriptions
        $subSystemName = $subSystem->name;
        $manageDescription = ManageDescription::where('name', $subSystemName)->get();

        // Initialize specifications and manage specifications
        $specification = [];
        $manageSpecification = [];
        $specificationbulkmaterial = [];

        foreach ($subSystemDescription as $description) {
            // Get specifications for each description
            $specification[$description->id] = Specification::where('subSystemDescription_id', $description->id)->get();

            // Get manage specifications for each description
            $manageSpecification[$description->id] = ManageSpecification::where([
                'name' => $subSystemName,
                'Description_name' => $description->Description_name
            ])->pluck('specification_name')->toArray();

            // Get bulk material specifications for each description
            $specs = SpecificationBulkMaterial::where([
                'project_id' => $projectId,
                'subSystem_id' => $subSystemId,
                'subSystemDescription_id' => $description->id
            ])->get();

            $specificationbulkmaterial[$description->id] = $specs;
        }

        $existingSpecifications = Specification::whereIn('subSystemDescription_id', $subSystemDescription->pluck('id'))
        ->pluck('specification')
        ->toArray();

        $manageSpecificationBulkMaterial = ManageSpecification::select('specification_name')
        ->distinct()
            ->orderBy('specification_name')
            ->get();

        // Calculate total prices
        $summationsubSystem = DB::table('specification')
        ->join('subSystemDescription', 'specification.subSystemDescription_id', '=', 'subSystemDescription.id')
        ->where('subSystemDescription.subSystem_id', $subSystemId)
            ->selectRaw('SUM(CAST(specification.unit_price * specification.qty AS DECIMAL(10,2))) as total_price')
            ->value('total_price') ?? 0;

        $summationProject = DB::table('specification')
        ->join('subSystemDescription', 'specification.subSystemDescription_id', '=', 'subSystemDescription.id')
        ->where('subSystemDescription.project_id', $projectId)
            ->selectRaw('SUM(CAST(specification.unit_price * specification.qty AS DECIMAL(10,2))) as total_price')
            ->value('total_price') ?? 0;

        // Get current manage specifications
        $currentManageSpecification = [];
        if ($currentDescriptionName) {
            $currentManageSpecification = ManageSpecification::where([
                'name' => $subSystem->name,
                'Description_name' => $currentDescriptionName
            ])->get();
        }

        return view('admin.subSystem.subSystemDescription.indexbulkmaterial', compact(
            'project',
            'subSystem',
            'unit',
            'subSystemDescription',
            'specification',
            'existingDescription',
            'existingMaterials',
            'summationsubSystem',
            'summationProject',
            'manageDescription',
            'managesubSystem',
            'manageSpecificationBulkMaterial',
            'specificationbulkmaterial',
            'projectId',
            'manageSpecification',
            'existingSpecifications'
        ));
    }

    public function getSpecificationBulkMaterial($subSystem, $Description_name)
    {
        $specifications = ManageSpecificationBulkMaterial::where('name', $subSystem)
            ->where('Description_name', $Description_name)
            ->get();

        return response()->json($specifications);
    }

    public function getSpecification($subSystem, $Description_name)
    {
        $specifications = ManageSpecification::where('name', $subSystem)
            ->where('Description_name', $Description_name)
            ->get();

        return response()->json($specifications);
    }
}
