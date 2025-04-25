<?php

namespace App\Http\Controllers;

use App\Models\ManageItem;
use App\Models\Specification;
use App\Models\subSystemDescription;
use Illuminate\Http\Request;
use Symfony\Component\CssSelector\Node\Specificity;

class AdminSummation extends Controller
{
    public function index($projectId)
    {
        // Retrieve specifications with their descriptions
        $Specifiation = Specification::with(['subSystemDescription' => function ($query) {
            $query->select('id', 'Description_name');
        }])
            ->where('project_id', $projectId)
            ->get();
        $subSystemDescription = subSystemDescription::all();

        $specifications = Specification::where('project_id', $projectId)->get();
        $totalPrice = $specifications->sum(function ($item) {
            return $item->qty * $item->unit_price;
        });

        // Calculate the total price for the specified project
        $totalPrice = Specification::where('project_id', $projectId)->sum('unit_price');

        return view('admin.project.summation', compact('Specifiation', 'totalPrice', 'subSystemDescription','specifications','projectId'));
    }

    public function indexthree($projectId)
    {
        

        $specification = Specification::where('project_id', $projectId)->get();
        $totalPrice = $specification->sum(function ($item) {
            return $item->qty * $item->unit_price;
        });

        // Calculate the total price for the specified project
        $totalPrice = Specification::where('project_id', $projectId)->sum('unit_price');

        return view('admin.project.printthree', compact('specification', 'totalPrice'));
    }

}
