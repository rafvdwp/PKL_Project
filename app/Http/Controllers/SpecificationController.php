<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Specification;
use Illuminate\Support\Facades\Auth;

class SpecificationController extends Controller
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
            'subSystemDescription' => $subSystemDescriptionId,
        ])->with('success', 'Specification added successfully');
    }

    public function update(Request $request, $projectId, $subSystemId, $subSystemDescriptionId)
    {
        $specification = new Specification();
        $specification->name = $request->name;
        $specification->length = $request->length;
        $specification->price = $request->price;
        $specification->subSystem_id = $subSystemId;
        $specification->project_id = $projectId;
        $specification->subSystemDescription_id = $subSystemDescriptionId; // Save the subSystemDescription_id
        $specification->update();

        return redirect()->route('admin.project.subSystem', [
            'project' => $projectId,
            'subSystem' => $subSystemId,
        ])->with('success', 'Specification added successfully');
    }

}
