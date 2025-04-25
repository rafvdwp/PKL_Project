<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Specification;

class AdminSpecificationController extends Controller
{
    public function store(Request $request, $projectId, $subSystemId, $subSystemDescriptionId)
    {
        $specification = new Specification();
        $specification->specification = $request->specification;
        $specification->part_number = $request->part_number;
        $specification->unit = $request->unit;
        $specification->qty = $request->qty;
        $specification->unit_price = $request->unit_price;
        $specification->subSystem_id = $subSystemId;
        $specification->project_id = $projectId;
        $specification->subSystemDescription_id = $subSystemDescriptionId;
        $specification->save();

        return redirect()->route('admin.project.subSystem', [
            'project' => $projectId,
            'subSystem' => $subSystemId,
        ])->with('success', 'Specification added successfully');
    }


    public function update(Request $request, $projectId, $subSystemId)
    {
        // Mengambil ID spesifikasi dari form
        $specificationId = $request->input('specification_id');

        // Mencari spesifikasi berdasarkan ID yang benar
        $specification = Specification::findOrFail($specificationId);

        // Update hanya field price
        $specification->unit_price = $request->unit_price;
        $specification->save();

        return redirect()->route('admin.project.subSystem', [
            'project' => $projectId,
            'subSystem' => $subSystemId,
        ])->with('success', 'Price updated successfully');
    }

    public function delete($subSystemDescriptionId)
    {
        $specification = Specification::find($subSystemDescriptionId);
        $specification->delete();

        return redirect()->route('admin.project.subSystem', ['project' => $specification->project_id, 'subSystem' =>$specification->subSystem_id]);
    }
}
