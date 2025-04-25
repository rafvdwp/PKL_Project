<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\subSystem;
use App\Models\subSystemDescription;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class subSystemDescriptionController extends Controller
{
    public function store(Request $request, $projectId, $subSystemId)
    {
        
        $subSystemDescription = new subSystemDescription();
        $subSystemDescription->Description_name = $request->Description_name;
        $subSystemDescription->Description_jumlah = $request->Description_jumlah;
        $subSystemDescription->subSystem_id = $subSystemId;
        $subSystemDescription->project_id = $projectId;
        $subSystemDescription->save();

        return redirect()->route('project.show', [
            'project' => $projectId,
        ])->with('success', 'subSystem Description added successfully');
    }
}
