<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\ManageDescription;
use Illuminate\Http\Request;
use App\Models\ManagesubSystem;

class AdminsubSystemController extends Controller
{

    public function adminManagesubSystemstore(Request $request)
    {
        // Check if subsystem with the same name already exists
        $existingSubsystem = ManagesubSystem::where('name', $request->name)->first();

        if ($existingSubsystem) {
            // Redirect back with an error message if subsystem already exists
            return redirect()->route('admin.project.managesubSystem')->with('error', 'Subsystem already exists');
        }

        // Create new subsystem if it doesn't exist
        $subSystem = new ManagesubSystem();
        $subSystem->name = $request->name;
        $subSystem->save();

        return redirect()->route('admin.project.managesubSystem')->with('success', 'Subsystem created successfully');
    }

    public function adminDelete($id)
    {
        $subSystem = ManagesubSystem::find($id);
        $subSystem->delete();
        return redirect()->route('admin.project.managesubSystem', compact('subSystem'));
    }

    public function manageDescription()
    {
        $project = Project::all();
        $managesubSystem = ManagesubSystem::all();
        $manageDescription = ManageDescription::all();
        return view('admin.project.manageDescription', compact('project', 'managesubSystem', 'manageDescription'));
    }

    public function manageDescriptionDelete($id)
    {
        $manageDescription = manageDescription::find($id);
        $manageDescription->delete();
        return redirect()->route('admin.project.manageDescription');
    }
}
