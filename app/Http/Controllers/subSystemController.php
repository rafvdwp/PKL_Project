<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\subSystem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class subSystemController extends Controller
{
    public function create($projectId)
    {
        $project = Project::all();
        return view('users.project.create', compact('project', 'projectId'));
    }

    public function store(Request $request, $projectId)
    {
        $subSystem = new subSystem();
        $subSystem->name = $request->name;
        $subSystem->project_id = $projectId;
        $subSystem->save();

        return redirect()->route('project.show', ['project' => $subSystem->project_id]);

    }
}
