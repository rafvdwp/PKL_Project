<?php

namespace App\Http\Controllers;

use App\Models\DetailSpecification;
use App\Models\subSystem;
use App\Models\ManageDescription;
use Illuminate\Http\Request;
use App\Models\ManagesubSystem;
use App\Models\ManageSpecification;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx\Rels;

class AdminManageSpecification extends Controller
{
    public function index()
    {
        $manageSpecification = ManageSpecification::all();
        $managesubSystem = ManagesubSystem::all();
        // Kita tidak perlu load semua Description di awal
        $manageDescription = ManageDescription::all();
        $detailSpecificaation = DetailSpecification::all();
        $subSystem = subSystem::all();

        return view('admin.project.manageSpecification', compact(
            'manageSpecification',
            'managesubSystem',
            'manageDescription',
            'detailSpecificaation',
            'subSystem'
        ));
    }

    // Tambah method baru untuk AJAX
    public function getDescriptions($subSystemName)
    {
        $Descriptions = ManageDescription::where('name', $subSystemName)->get();
        return response()->json($Descriptions);
    }

    public function store(Request $request)
    {
        $existingSpecification = ManageSpecification::where('name', $request->name)
        ->where('specification_name', $request->specification_name)
        ->where('Description_name', $request->Description_name)->first();

        if($existingSpecification) {
            return redirect()->route('admin.manageSpecification.index')->with('error', 'already exists');
        }
        $specification = new ManageSpecification();
        $specification->name = $request->name;
        $specification->specification_name = $request->specification_name;
        $specification->Description_name    = $request->Description_name;
        $specification->save();

        return redirect()->route('admin.manageSpecification.index')
        ->with('success', 'created successfully');
    }

    public function delete($id) 
    {
        $manageSpecification = ManageSpecification::find($id);
        $manageSpecification->delete();
        return redirect()->route('admin.manageSpecification.index');
    }

    public function DetailSpecificationStore(Request $request)
    {

        $existingdetailSpecification = DetailSpecification::where('DetailSpecification', $request->DetailSpecification)
        ->first();

        if ($existingdetailSpecification) {
            return redirect()->route('admin.manageSpecification.index')
            ->with('error', 'already exists');
        }

        $detailSpecification = new DetailSpecification();
        $detailSpecification->DetailSpecification = $request->DetailSpecification;
        $detailSpecification->save();

        return redirect()->route('admin.manageSpecification.index')
        ->with('success', 'created successfully');
    }

    public function DetailSpecificationDelete($id)
    {
        $detailSpecification = DetailSpecification::find($id);
        $detailSpecification->delete();

        return redirect()->route('admin.manageSpecification.index');
    }
}
