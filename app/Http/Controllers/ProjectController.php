<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $projects = Project::get();
        return view('projects.index', compact('projects'));
    }

    // ProjectController.php

public function showCategory($projectId, $categoryId)
{
    // Temukan project berdasarkan ID
    $projects = Project::findOrFail($projectId);
    // Temukan kategori berdasarkan ID di dalam project tersebut
    $category = $projects->category()->findOrFail($categoryId);
              // Pastikan nama view sesuai dengan nama kategori, misalnya 'inproject.lan.index'
       $viewName = 'inproject.' . strtolower(str_replace(' ', '', $category->name)) . '.index'; // Menghapus spasi dan lowercase untuk mencegah error
    // Return ke view yang sesuai
    return view($viewName, compact('projects', 'category'));
}

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('projects.create');
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $projects = new Project();
        $projects->name = $request->name;
        $projects->save();
        return redirect()->route('projects.index', compact('projects'));
    }
    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $projects = Project::with('category')->findOrFail($id);
        return view('projects.show', compact('projects'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        return view('projects.edit');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $projects = Project::find($id);
        $projects->name = $request->name;
        $projects->save();
        return redirect()->route('projects.index', compact('projects'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $projects = Project::find($id);
        $projects->delete();
        return redirect()->route('projects.index', compact('projects'));
    }
}
