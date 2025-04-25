<?php

namespace App\Http\Controllers;

use App\Models\Unit;
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

class ProjectController extends Controller
{
    public function index()
    {
        $specification = Specification::all();
        $subSystem = subSystem::all();
        $project = Project::all();
        $managesubSystem = ManagesubSystem::all();
        $manageDescription = ManageDescription::all();
        return view('users.project.index', compact('project', 'subSystem', 'specification', 'managesubSystem', 'manageDescription'));
    }

    public function print()
    {
        return view('Print.print');
    }



    public function searchlist(Request $request)
    {
        $query = $request->input('search');

        $project = Project::where('name', 'LIKE', "%{$query}%")->get();

        return view('users.project.manageproject', compact('project', 'query'));
    }


    public function create($projectId)
    {
        return view('users.project.create', compact('projectId'));
    }

    public function store(Request $request)
    {

        $project = new Project();
        $project->name = $request->name;
        $project->save();

        return redirect()->route('project.index');
    }

    public function show($projectId)
    {
        $subSystem = subSystem::all();
        $managesubSystem = ManagesubSystem::all();


        $project = Project::findOrFail($projectId);

        return view('users.project.show', compact('project', 'subSystem', 'managesubSystem'));
    }


    public function edit($projectId)
    {
        $project = Project::findOrFail($projectId);

        return view('users.project.edit', compact('project'));
    }

    public function deleteDescription($subSystemId)
    {
        $description = subSystemDescription::findOrFail($subSystemId);
        $description->delete();
        return redirect()->route('project.show', ['project' => $description->project_id]);
    }

    public function delete($projectId,)
    {

        $subSystem = subSystem::findOrFail($projectId,);
        $subSystem->delete();
        return redirect()->route('project.show', ['project' => $subSystem->project_id]);
    }

    public function destroy($id)
    {
        $project = Project::findOrFail($id);
        $project->delete();

        return redirect()->route('project.index');
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

        return redirect()->route('project.show', ['project' => $project]);
    }

    public function showsubSystem($projectId, $subSystemId)
    {
        $unit = Unit::findOrFail($projectId);
        $project = Project::findOrFail($projectId);
        $subSystem = subSystem::findOrFail($subSystemId);
        $currentDescriptionName = subSystemDescription::where('id', request()->segment(6))->value('Description_name');

        // Fetch all required data
        $managesubSystem = ManagesubSystem::all();
        $subSystemName = $subSystem->name;

        // Fetch subSystem descriptions with specifications
        $subSystemDescription = subSystemDescription::where([
            'subSystem_id' => $subSystemId,
            'project_id' => $projectId
        ])->with('specification')->get();

        // Get existing descriptions
        $existingDescription = $subSystemDescription->pluck('Description_name')->toArray();

        // Get manage descriptions for this subSystem
        $manageDescription = ManageDescription::where('name', $subSystemName)->get();

        // Initialize specifications array and get manage specifications
        $specification = [];
        $manageSpecification = [];

        foreach ($subSystemDescription as $description) {
            // Get specifications for each description
            $specification[$description->id] = Specification::where('subSystemDescription_id', $description->id)->get();

            // Get manage specifications for each description
            $manageSpecification[$description->id] = ManageSpecification::where([
                'name' => $subSystemName,
                'Description_name' => $description->Description_name
            ])->pluck('specification_name')->toArray();
        }

        // Get existing specifications
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

        $currentManageSpecification = [];
        if ($currentDescriptionName) {
            $currentManageSpecification = ManageSpecification::where([
                'name' => $subSystem->name,
                'Description_name' => $currentDescriptionName
            ])->get();
        }

        return view('users.subSystem.subSystemDescription.index', compact(
            'summationsubSystem',
            'summationProject',
            'managesubSystem',
            'project',
            'projectId',
            'subSystemId',
            'subSystem',
            'subSystemDescription',
            'specification',
            'existingDescription',
            'manageDescription',
            'manageSpecification',
            'existingSpecifications',
            'currentManageSpecification'
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

        return view('users.subSystem.subSystemDescription.indexbulkmaterial', compact(
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

    // public function showSubSystemBulkMaterial($projectId, $subSystemId)
    // {
    //     // Basic data loading
    //     $project = Project::findOrFail($projectId);
    //     $subSystem = SubSystem::findOrFail($subSystemId);
    //     $unit = Unit::all();
    //     $currentDescriptionId = request()->segment(6);
    //     $specificationbulkmaterial = Specification::findOrFail($subSystemId);
    //     $managesubSystem = ManagesubSystem::findOrFail($subSystemId);

    //     // Get current description name
    //     $currentDescriptionName = SubSystemDescription::where('id', $currentDescriptionId)
    //         ->value('Description_name');

    //     // Get subsystem descriptions
    //     $subSystemDescription = SubSystemDescription::where([
    //         'subSystem_id' => $subSystemId,
    //         'project_id' => $projectId
    //     ])->with('specifications')->get();

    //     // Get existing material specifications
    //     $existingMaterials = SpecificationBulkMaterial::where([
    //         'subSystem_id' => $subSystemId,
    //         'project_id' => $projectId
    //     ])->get();

    //     // Fetch all required data
    //     $managesubSystem = ManagesubSystem::all();
    //     $subSystemName = $subSystem->name;


    //     // Get existing descriptions
    //     $existingDescription = $subSystemDescription->pluck('Description_name')->toArray();

    //     // Get manage descriptions for this subSystem
    //     $manageDescription = ManageDescription::where('name', $subSystemName)->get();

    //     // Initialize specifications array and get manage specifications
    //     $specification = [];
    //     $manageSpecification = [];

    //     foreach ($subSystemDescription as $description) {
    //         // Get specifications for each description
    //         $specification[$description->id] = Specification::where('subSystemDescription_id', $description->id)->get();

    //         // Get manage specifications for each description
    //         $manageSpecification[$description->id] = ManageSpecification::where([
    //             'name' => $subSystemName,
    //             'Description_name' => $description->Description_name
    //         ])->pluck('specification_name')->toArray();
    //     }

    //     // Fetch specifications grouped by description ID
    //     $specificationbulkmaterial = [];
    //     foreach ($subSystemDescription as $description) {
    //         $specs = SpecificationBulkMaterial::where([
    //             'project_id' => $projectId,
    //             'subSystem_id' => $subSystemId,
    //             'subSystemDescription_id' => $description->id
    //         ])->get();

    //         $specificationbulkmaterial[$description->id] = $specs;
    //     }

    //     $manageDescription = ManageDescription::where('name', $subSystemName)->get();


    //     $manageSpecificationBulkMaterial = ManageSpecification::select('specification_name')
    //         ->distinct()
    //         ->orderBy('specification_name')
    //         ->get();

    //     // Calculate total price for subSystem
    //     $summationsubSystem = DB::table('specification')
    //         ->join(
    //             'subSystemDescription',
    //             'specification.subSystemDescription_id',
    //             '=',
    //             'subSystemDescription.id'
    //         )
    //         ->where('subSystemDescription.subSystem_id', $subSystemId)
    //         ->selectRaw('SUM(CAST(specification.unit_price * specification.qty AS DECIMAL(10,2))) as total_price')
    //         ->value('total_price') ?? 0;

    //     // Calculate total price for Project
    //     $summationProject = DB::table('specification')
    //         ->join(
    //             'subSystemDescription',
    //             'specification.subSystemDescription_id',
    //             '=',
    //             'subSystemDescription.id'
    //         )
    //         ->where('subSystemDescription.project_id', $projectId)
    //         ->selectRaw('SUM(CAST(specification.unit_price * specification.qty AS DECIMAL(10,2))) as total_price')
    //         ->value('total_price') ?? 0;

    //     // Get current manage specifications if there's a current description
    //     $currentManageSpecification = [];
    //     if ($currentDescriptionName) {
    //         $currentManageSpecification = ManageSpecification::where([
    //             'name' => $subSystem->name,
    //             'Description_name' => $currentDescriptionName
    //         ])->get();
    //     }

    //     return view('users.subSystem.subSystemDescription.indexbulkmaterial', compact(
    //         'project',
    //         'subSystem',
    //         'unit',
    //         'projectId',
    //         'subSystemDescription',
    //         'existingMaterials',
    //         'manageSpecification',
    //         'manageSpecificationBulkMaterial',
    //         'summationsubSystem',
    //         'summationProject',
    //         'specification',
    //         'existingDescription',
    //         'manageDescription',
    //         'managesubSystem',
    //         'specificationbulkmaterial'

    //     ));
    // }
    // public function getSpecificationBulkMaterial($subSystem, $Description_name)
    // {
    //     $specifications = ManageSpecificationBulkMaterial::where('name', $subSystem)
    //         ->where('Description_name', $Description_name)
    //         ->get();

    //     return response()->json($specifications);
    // }

}
