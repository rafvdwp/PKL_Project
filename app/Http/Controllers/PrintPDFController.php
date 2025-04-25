<?php

namespace App\Http\Controllers;

use App\Models\subSystem;
use App\Models\TablePDFImg;
use App\Models\TablePDFOne;
use App\Models\TablePDFTwo;
use Codedge\Fpdf\Fpdf\Fpdf;
use App\Models\TableOneFill;
use App\Models\TableTwoFill;
use Illuminate\Http\Request;
use App\Models\TablePDFThree;
use App\Models\TablePDFFooter;
use App\Models\TableThreeFill;
use App\Models\subSystemDescription;

class CustomPDFController extends Fpdf
{
    protected $footerText;

    // Constructor to accept footer text
    public function __construct($orientation = 'P', $unit = 'mm', $size = 'A4')
    {
        parent::__construct($orientation, $unit, $size);
        // Get footer text from database
        $footerData = TablePDFFooter::first();
        $this->footerText = $footerData ? $footerData->footer : "FOOTER DUMMY";
    }
    // Override untuk Header
    public function Header()
    {
        $this->SetFont("Arial", "", 12);

        // Get TablePDFImg data
        $tablePDFImages = TablePDFImg::all();

        $currentY = 10; // Start from top of page

        if ($tablePDFImages->isNotEmpty()) {
            foreach ($tablePDFImages as $image) {
                // Get the image path from storage
                $imagePath = public_path($image->img);
                if (file_exists($imagePath)) {
                    // Add image with appropriate dimensions
                    $this->Image($imagePath, 10, $currentY, 190); // Using $this instead of $fpdf
                    $currentY += 40; // Adjust spacing between images
                }
            }
        }

        // Add spacing after the last image or from top if no images
        $this->SetY($currentY + 10);
    }

    // Override untuk Footer
    public function Footer()
    {
        $this->SetY(-15);
        $this->SetFont("Arial", "", 10);
        $this->Cell(0, 10, $this->footerText, 0, 0, "C");
    }
}

class PrintPDFController extends Controller
{
    public static function print(Request $request)
    {
        $fpdf = new CustomPDFController('P', 'mm', 'A4');
        $fpdf->AddPage();
        $fpdf->setTitle("Budgeting Report");
        $fpdf->SetFont('Arial', 'B', 13);
        $tableSpacing = 10;

        // Get data for table one
        $tableTitle = TablePDFOne::all();
        $tableOneData = TableOneFill::all();


        // ===================================
        // Table Heading 1
        // ===================================
        $initialY = 38;
        $fpdf->SetY($initialY - 6);

        $fpdf->SetX(9);
        $fpdf->Cell(5, 6, "5.", 0, 0, 'L');
        foreach ($tableTitle as $headerData) {
            $fpdf->Cell(0, 6, $headerData->table_title1, 0, 1, 'L');
        }
        $fpdf->SetY($initialY);


        $fpdf->Cell(15, 6, "NO.", '1', 0, 'C');
        $fpdf->Cell(25, 6, "CODE", '1', 0, 'C');
        $fpdf->Cell(60, 6, "DESCRIPTION", '1', 0, 'C');
        $fpdf->Cell(50, 6, "TYPE", '1', 0, 'C');
        $fpdf->Cell(20, 6, "UNIT", '1', 0, 'C');
        $fpdf->Cell(20, 6, "QTY", '1', 0, 'C');
        $fpdf->Ln();

        // Data Table 1
        $fpdf->SetFont('Arial', '', 11);

        foreach ($tableOneData as $index => $item) {
            $x = $fpdf->GetX();
            $y = $fpdf->GetY();
            $colWidths = [15, 25, 60, 50, 20, 20];

            // Description column
            $fpdf->SetXY($x + $colWidths[0] + $colWidths[1], $y);
            $fpdf->MultiCell($colWidths[2], 6, $item->description, 0, 'L');
            $newYDescription = $fpdf->GetY();

            // Type column
            $fpdf->SetXY($x + $colWidths[0] + $colWidths[1] + $colWidths[2], $y);
            $fpdf->MultiCell($colWidths[3], 6, $item->type, 0, 'L');
            $newYType = $fpdf->GetY();

            $cellHeight = max($newYDescription, $newYType) - $y;
            $fpdf->SetXY($x, $y);

            // Number and Code
            $fpdf->Cell($colWidths[0], $cellHeight, $index + 1, '1', 0, 'C');
            $fpdf->Cell($colWidths[1], $cellHeight, $item->code, '1', 0, 'C');

            // Borders for Description and Type
            $fpdf->SetXY($x + $colWidths[0] + $colWidths[1], $y);
            $fpdf->Cell($colWidths[2], $cellHeight, '', '1');

            $fpdf->SetXY($x + $colWidths[0] + $colWidths[1] + $colWidths[2], $y);
            $fpdf->Cell($colWidths[3], $cellHeight, '', '1');

            // Unit and Qty
            $fpdf->SetXY($x + $colWidths[0] + $colWidths[1] + $colWidths[2] + $colWidths[3], $y);
            $fpdf->Cell($colWidths[4], $cellHeight, $item->unit, '1', 0, 'C');
            $fpdf->Cell($colWidths[5], $cellHeight, $item->qty, '1', 0, 'C');
            $fpdf->Ln();
        }

        $fpdf->SetY($fpdf->GetY() + $tableSpacing);

        // ===================================
        // Table Heading 2
        // ===================================

        $TablePDFTwo = TablePDFTwo::all();
        $TableTwoFill = TableTwoFill::all();

        $fpdf->SetY($fpdf->GetY() + $tableSpacing);
        $fpdf->SetFont('Arial', 'B', 13);
        $fpdf->SetX(9);
        $fpdf->Cell(5, 6, "6.", 0, 0, 'L');

        foreach ($TablePDFTwo as $headerData) {
            $fpdf->Cell(0, 6, $headerData->table_title2, 0, 1, 'L');
        }

        // Table Headers
        $fpdf->Cell(15, 6, "NO.", '1', 0, 'C');
        $fpdf->Cell(75, 6, "SPECIFICATION", '1', 0, 'C');
        $fpdf->Cell(60, 6, "SIZE", '1', 0, 'C');
        $fpdf->Cell(20, 6, "UNIT", '1', 0, 'C');
        $fpdf->Cell(20, 6, "QTY", '1', 0, 'C');
        $fpdf->Ln();

        // Table Subheader
        foreach ($TablePDFTwo as $headerData) {
            $fpdf->Cell(0, 6, $headerData->no, 0, 1, 'L');
        }
        foreach ($TablePDFTwo as $headerData) {
        $fpdf->Cell(75, 6, $headerData->specification, 'TB', 0, 'L');
        }
        $fpdf->Cell(60, 6, "", 'TB', 0, 'C');
        $fpdf->Cell(20, 6, "", 'TB', 0, 'C');
        $fpdf->Cell(20, 6, "", 'R', 0, 'C');
        $fpdf->Ln();

        // Data Table 2
        $fpdf->SetFont('Arial', '', 11);

        foreach ($TableTwoFill as $index => $item) {
            $x = $fpdf->GetX();
            $y = $fpdf->GetY();
            $colWidths = [15, 75, 60, 20, 20];

            // Calculate height needed for wrapped text
            $fpdf->SetXY($x + $colWidths[0], $y);
            $fpdf->MultiCell($colWidths[1], 6, $item->specification, 0, 'L');
            $newY1 = $fpdf->GetY();

            $fpdf->SetXY($x + $colWidths[0] + $colWidths[1], $y);
            $fpdf->MultiCell($colWidths[2], 6, $item->size, 0, 'L');
            $newY2 = $fpdf->GetY();

            $cellHeight = max($newY1, $newY2) - $y;

            // Draw cells with calculated height
            $fpdf->SetXY($x, $y);
            $fpdf->Cell($colWidths[0], $cellHeight, $index + 1, '1', 0, 'C');

            $fpdf->SetXY($x + $colWidths[0], $y);
            $fpdf->MultiCell($colWidths[1], $cellHeight, $item->specification, '1', 'L');

            $fpdf->SetXY($x + $colWidths[0] + $colWidths[1], $y);
            $fpdf->MultiCell($colWidths[2], $cellHeight, $item->size, '1', 'L');

            $fpdf->SetXY($x + $colWidths[0] + $colWidths[1] + $colWidths[2], $y);
            $fpdf->Cell($colWidths[3], $cellHeight, $item->unit, '1', 0, 'C');
            $fpdf->Cell($colWidths[4], $cellHeight, $item->qty, '1', 0, 'C');
            $fpdf->Ln($cellHeight);
        }

        $fpdf->SetY($fpdf->GetY() + $tableSpacing);

        // ===================================
        // Table Heading 3
        // ===================================

        $TablePDFThree = TablePDFThree::all();
        $TableThreeFill = TableThreeFill::all();

        // $tableSpacing = 10;

        // $$fpdf->SetY($fpdf->GetY() + $tableSpacing);
        $fpdf->SetFont('Arial', 'B', 13);
        $fpdf->SetX(9);
        $fpdf->Cell(5, 6, "7.", 0, 0, 'L');

        // Get table title from TablePDFThree
        foreach ($TablePDFThree as $headerData) {
            $fpdf->Cell(0, 6, $headerData->table_title3, 0, 1, 'L');
        }

        // Table Headers
        $x = $fpdf->GetX();
        $y = $fpdf->GetY();

        $fpdf->MultiCell(15, 6, "ITEM NO.", '1', 'C');
        $newYHeader = $fpdf->GetY();
        $cellHeightHeader = $newYHeader - $y;

        $fpdf->SetXY($x + 15, $y);
        $fpdf->Cell(17, $cellHeightHeader, "ID NO.", '1', 0, 'C');
        $fpdf->Cell(118, $cellHeightHeader, "DESCRIPTION", '1', 0, 'C');
        $fpdf->Cell(20, $cellHeightHeader, "UNIT", '1', 0, 'C');
        $fpdf->Cell(20, $cellHeightHeader, "QTY", '1', 0, 'C');
        $fpdf->Ln();

        // Table Content
        $fpdf->SetFont('Arial', '', 11);

        foreach ($TableThreeFill as $index => $item) {
            $x = $fpdf->GetX();
            $y = $fpdf->GetY();
            $colWidths = [15, 17, 118, 20, 20];

            // Print the description first to calculate height
            $fpdf->SetXY($x + $colWidths[0] + $colWidths[1], $y);
            $fpdf->MultiCell($colWidths[2], 6, $item->description, '1', 'L');
            $newY = $fpdf->GetY();
            $cellHeight = $newY - $y;

            // Print other cells with the calculated height
            $fpdf->SetXY($x, $y);
            $fpdf->Cell($colWidths[0], $cellHeight, ($index + 1) . ".", '1', 0, 'C');
            $fpdf->Cell($colWidths[1], $cellHeight, $item->idno, '1', 0, 'C');

            // Set position for unit and qty
            $fpdf->SetXY($x + $colWidths[0] + $colWidths[1] + $colWidths[2], $y);
            $fpdf->Cell($colWidths[3], $cellHeight, $item->unit, '1', 0, 'C');
            $fpdf->Cell($colWidths[4], $cellHeight, $item->qty, '1', 0, 'C');
            $fpdf->Ln();
        }


        $fpdf->Output();
        exit;
    }
}
