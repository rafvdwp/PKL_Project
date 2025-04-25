<?php

namespace App\Http\Controllers;

use App\Models\Unit;
use App\Models\Project;
use App\Models\PrintPDF;
use App\Models\TableSize;
use App\Models\TablePDFImg;
use App\Models\TablePDFOne;
use App\Models\TablePDFTwo;
use App\Models\TableOneFill;
use App\Models\TableTwoFill;
use Illuminate\Http\Request;
use App\Models\Specification;
use App\Models\TablePDFThree;
use App\Models\TablePDFFooter;
use App\Models\TableThreeFill;
use App\Models\ManageDescription;
use App\Models\DetailSpecification;
use App\Models\ManageSpecification;
use App\Models\SpecificationBulkMaterial;

class PrintToPDF extends Controller
{
    public function indexthree($projectId)
    {
        $TablePDFImg = TablePDFImg::all();
        $DetailSpecification = DetailSpecification::all();
        $TableOneFill = TableOneFill::all();
        $TablePDFFooter = TablePDFFooter::all();
        $TablePDFOne = TablePDFOne::all();
        $TablePDFThree = TablePDFThree::all();
        $TablePDFTwo = TablePDFTwo::all();
        $TableSize = TableSize::all();
        $TableThreeFill = TableThreeFill::all();
        $TableTwoFill = TableTwoFill::all();
        $manageDescription = ManageDescription::all();
        $manageSpecification = ManageSpecification::all();
        $manageUnit = Unit::all();
        // Get project-specific specifications
        $specification = Specification::where('project_id', $projectId)->get();
        $project = Project::all();

        // Calculate total price for project-specific specifications
        $totalPrice = $specification->sum(function ($item) {
            return $item->qty * $item->unit_price;
        });

        $printPDF = TablePDFImg::first(); // Assuming you want to keep the PDF settings global

        // Get project-specific bulk materials through subsystem descriptions
        $specificationBulkMaterial = SpecificationBulkMaterial::whereHas('subSystemDescription', function ($query) use ($projectId) {
            $query->where('project_id', $projectId);
        })->get();

        return view('admin.project.printthree', compact(
            'specification',
            'manageDescription',
            'manageSpecification',
            'manageUnit',
            'TablePDFImg',
            'DetailSpecification',
            'TableOneFill',
            'TablePDFFooter',
            'TablePDFOne',
            'TablePDFThree',
            'TablePDFTwo',
            'TableSize',
            'TableThreeFill',
            'TableTwoFill',
            'totalPrice',
            'printPDF',
            'project',
            'projectId',
            'specificationBulkMaterial'
        ));
    }

    public function TablePDFOneStore(Request $request, $projectId)
    {
        $TablePDFOne = new TablePDFOne();
        $TablePDFOne->table_title1 = $request->table_title1;
        $TablePDFOne->save();

        return redirect()->route('admin.printthree', ['projectId' => $projectId]);
    }

    public function TablePDFTwoStore(Request $request, $projectId)
    {
        $TablePDFTwo = new TablePDFTwo();
        $TablePDFTwo->table_title2 = $request->table_title2;
        $TablePDFTwo->no = $request->no;
        $TablePDFTwo->specification = $request->specification;
        $TablePDFTwo->save();

        return redirect()->route('admin.printthree', ['projectId' => $projectId]);
    }

    public function TablePDFThreeStore(Request $request, $projectId)
    {
        $TablePDFThree = new TablePDFThree();
        $TablePDFThree->table_title3 = $request->table_title3;
        $TablePDFThree->description = $request->description;
        $TablePDFThree->save();

        return redirect()->route('admin.printthree', ['projectId' => $projectId]);
    }
    public function TablePDFFooterStore(Request $request, $projectId)
    {
        $TablePDFThree = new TablePDFFooter();
        $TablePDFThree->footer = $request->footer;
        $TablePDFThree->save();

        return redirect()->route('admin.printthree', ['projectId' => $projectId]);
    }


    public function ImgStore(Request $request, $projectId)
    {
        $request->validate([
            'img' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        // Create a new record for image
        $TablePDFImg = new TablePDFImg();

        if ($request->hasFile('img')) {
            $image = $request->file('img');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads/pdf-headers'), $imageName);
            $TablePDFImg->img = 'uploads/pdf-headers/' . $imageName;
        }
        $TablePDFImg->save();

        return redirect()->route('admin.printthree', ['projectId' => $projectId]);
    }

    // In PrintToPDF controller
    public function updateImage(Request $request, $projectId, $id)
    {
        $request->validate([
            'img' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $TablePDFImg = TablePDFImg::findOrFail($id);

        // Remove old file if exists
        if ($TablePDFImg->img && file_exists(public_path($TablePDFImg->img))) {
            unlink(public_path($TablePDFImg->img));
        }

        // Upload new image
        if ($request->hasFile('img')) {
            $image = $request->file('img');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads/pdf-headers'), $imageName);
            $TablePDFImg->img = 'uploads/pdf-headers/' . $imageName;
        }

        $TablePDFImg->save();

        return redirect()->route('admin.printthree', ['projectId' => $projectId])
            ->with('success', 'Image updated successfully');
    }

    


    public function TableOneFillStore(Request $request, $projectId)
    {
        $TableOneFill = new TableOneFill();
        $TableOneFill->code = $request->code;
        $TableOneFill->description = $request->description;
        $TableOneFill->type = $request->type;
        $TableOneFill->unit = $request->unit;
        $TableOneFill->qty = $request->qty;
        $TableOneFill->save();

        return redirect()->route('admin.printthree', ['projectId' => $projectId]);
    }

    public function TableTwoFillStore(Request $request, $projectId)
    {
        $TableTwoFill = new TableTwoFill();
        $TableTwoFill->specification = $request->specification;
        $TableTwoFill->size = $request->size;
        $TableTwoFill->unit = $request->unit;
        $TableTwoFill->qty = $request->qty;
        $TableTwoFill->save();

        return redirect()->route('admin.printthree', ['projectId' => $projectId]);
    }

    public function TableThreeFillStore(Request $request, $projectId)
    {
        $TableThreeFill = new TableThreeFill();
        $TableThreeFill->idno = $request->idno;
        $TableThreeFill->description = $request->description;
        $TableThreeFill->unit = $request->unit;
        $TableThreeFill->qty = $request->qty;
        $TableThreeFill->save();

        return redirect()->route('admin.printthree', ['projectId' => $projectId]);
    }
}
