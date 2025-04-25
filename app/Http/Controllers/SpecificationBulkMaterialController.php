<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Specificationbulkmaterial;
use Illuminate\Support\Facades\Auth;

class SpecificationbulkmaterialController extends Controller
{
    public function store(Request $request, $projectId, $subSystemId, $subSystemDescriptionId)
    {
        $specificationbulkmaterial = new specificationbulkmaterial();
        $specificationbulkmaterial->material_type = $request->material_type;
        $specificationbulkmaterial->unit_material = $request->unit_material;
        $specificationbulkmaterial->unit = $request->unit;
        $specificationbulkmaterial->total_material = $request->total_material;
        $specificationbulkmaterial->subSystem_id = $subSystemId;
        $specificationbulkmaterial->project_id = $projectId;
        $specificationbulkmaterial->subSystemDescription_id = $subSystemDescriptionId;
        $specificationbulkmaterial->save();

        return redirect()->route('project.subSystembulkmaterial', [
            'project' => $projectId,
            'subSystem' => $subSystemId,
        ])->with('success', 'specificationbulkmaterial added successfully');
    }


    public function update(Request $request, $projectId, $subSystemId)
    {
        // Mengambil ID spesifikasi dari form
        $specificationId = $request->input('specification_id');

        // Mencari spesifikasi berdasarkan ID yang benar
        $specificationbulkmaterial = specificationbulkmaterial::findOrFail($specificationId);

        // Update hanya field price
        $specificationbulkmaterial->unit_price = $request->unit_price;
        $specificationbulkmaterial->save();

        return redirect()->route('admin.project.subSystembulkmaterial', [
            'project' => $projectId,
            'subSystem' => $subSystemId,
        ])->with('success', 'Price updated successfully');
    }

    public function delete($subSystemDescriptionId)
    {
        $specificationbulkmaterial = specificationbulkmaterial::find($subSystemDescriptionId);
        $specificationbulkmaterial->delete();

        return redirect()->route('project.subSystem', ['project' => $specificationbulkmaterial->project_id, 'subSystem' => $specificationbulkmaterial->subSystem_id]);
    }
}
