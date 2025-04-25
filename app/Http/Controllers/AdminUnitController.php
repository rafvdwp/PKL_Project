<?php

namespace App\Http\Controllers;

use App\Models\TableSize;
use App\Models\Unit;
use Illuminate\Http\Request;

class AdminUnitController extends Controller
{
    public function index()
    {
        $unit = Unit::all();
        $Size = TableSize::all();
        return view('admin.project.manageUnit', compact('unit', 'Size'));
    }

    public function store(Request $request)
    {
        $existingUnit = Unit::where('name', $request->name)
            ->first();

        if ($existingUnit) {
            return redirect()->route('admin.manageUnit')
            ->with('error', 'already exists');
        }
        $unit = new Unit();
        $unit->name = $request->name;
        $unit->save();

        return redirect()->route('admin.manageUnit')->with('success', 'created successfully');
    }

    public function delete($id)
    {
        $manageUnit = Unit::find($id);
        $manageUnit->delete();

        return redirect()->route('admin.manageUnit');
    }

    public function SizeStore(Request $request)
    {
        $existingSize = TableSize::where('Size', $request->Size)
            ->first();

        if ($existingSize) {
            return redirect()->route('admin.manageUnit')
            ->with('error', 'already exists');
        }
        $Size = new TableSize();
        $Size->Size = $request->Size;
        $Size->save();

        return redirect()->route('admin.manageUnit')->with('success', 'created successfully');

    }

    public function SizeDelete($id)
    {
        $Size = TableSize::find($id);
        $Size->delete();

        return redirect()->route('admin.manageUnit');
    }
}
