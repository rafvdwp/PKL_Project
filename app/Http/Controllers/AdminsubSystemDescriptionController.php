<?php

namespace App\Http\Controllers;

use App\Models\ManageDescription;
use App\Models\subSystemDescription;
use Illuminate\Http\Request;

class AdminsubSystemDescriptionController extends Controller
{
    public function store(Request $request)
    {
        // Check for existing description with same name and description name
        $existingDescription = ManageDescription::where('name', $request->name)
            ->where('Description_name', $request->Description_name)
            ->first();

        if ($existingDescription) {
            return redirect()->route('admin.project.manageDescription')
            ->with('error', 'Description already exists');
        }

        $subSystemDescription = new ManageDescription();
        $subSystemDescription->name = $request->name;
        $subSystemDescription->Description_name = $request->Description_name;
        $subSystemDescription->save();

        return redirect()->route('admin.project.manageDescription')
        ->with('success', 'Description created successfully');
    }
}
