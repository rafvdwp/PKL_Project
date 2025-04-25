<?php

namespace App\Http\Controllers;

use App\Models\subSystem;
use Illuminate\Http\Request;
use App\Models\ManagesubSystem;
use App\Models\ManageDescription;
use App\Models\ManageSpecificationBulkMaterial;

class AdminManageSpecificationBulkMaterial extends Controller
{
    public function index()
    {
        $manageSpecificationbulkmaterial = ManageSpecificationBulkMaterial::all();
        $managesubSystem = ManagesubSystem::all();
        // Kita tidak perlu load semua Description di awal
        $manageDescription = [];
        $subSystem = subSystem::all();

        return view('admin.project.manageSpecificationbulkmaterial', compact(
            'manageSpecificationbulkmaterial',
            'managesubSystem',
            'manageDescription',
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
        $specification = new ManageSpecificationbulkmaterial();
        $specification->name = $request->name;
        $specification->material_type = $request->material_type;
        $specification->Description_name    = $request->Description_name;
        $specification->save();

        return redirect()->route('admin.manageSpecificationbulkmaterial.index');
    }

    public function delete($id)
    {
        $manageSpecification = ManageSpecificationbulkmaterial::find($id);
        $manageSpecification->delete();
        return redirect()->route('admin.manageSpecificationbulkmaterial.index');
    }
}
