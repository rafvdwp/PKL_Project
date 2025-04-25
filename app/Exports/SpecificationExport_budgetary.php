<?php

namespace App\Exports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;
use Maatwebsite\Excel\Concerns\WithTitle;
use PhpOffice\PhpSpreadsheet\Style\Alignment;

class SpecificationExport_budgetary implements WithMultipleSheets
{
    protected $specifications;
    protected $projectId;

    public function __construct($specifications, $projectId)
    {
        $this->specifications = $specifications;
        $this->projectId = $projectId;
    }

    public function sheets(): array
    {
        $sheets = [];

        // Add summary sheet first
        $sheets[] = new SummarySheetExport($this->specifications);

        // Group specifications by subsystem while considering project_id
        $groupedSpecifications = $this->specifications->groupBy(function ($item) {
            // Create a unique key combining project_id and subsystem_id
            return $item->project_id . '-' . $item->subSystemDescription->subSystem->id;
        })->sortKeys();

        // Add individual subsystem sheets
        $subSystemCounter = 1;
        foreach ($groupedSpecifications as $combinedKey => $items) {
            // Only process items for the current project
            if (explode('-', $combinedKey)[0] == $this->projectId) {
                $subSystemName = $items->first()->subSystemDescription->subSystem->name;
                $sheets[] = new SubsystemSheetExport_budgetary(
                    $items,
                    $subSystemName,
                    $subSystemCounter
                );
                $subSystemCounter++;
            }
        }
        return $sheets;
    }
}


class SummarySheetExport implements FromCollection, WithTitle, WithHeadings, WithEvents
{
    protected $specifications;
    protected $totalRows;

    public function __construct($specifications)
    {
        $this->specifications = $specifications;
    }

    public function title(): string
    {
        return 'Summary';
    }

    public function collection()
    {
        $rows = collect();

        // Add empty rows
        $rows->push(['', '', '', '']);
        $rows->push(['', '', '', '']);
        $rows->push(['', '', '', '']);

        // Add title row
        $rows->push([
            'SYSTEM PRICE SUMMARY',
            '',
            '',
            '',
        ]);

        // Add header row for the summary table
        $rows->push([
            'NO',
            'SUBSYSTEM NAME',
            'TOTAL ITEMS',
            'TOTAL PRICE',
        ]);

        // Group specifications by subsystem
        $groupedSpecifications = $this->specifications->groupBy(function ($item) {
            return $item->subSystemDescription->subSystem->id;
        })->sortKeys();

        $counter = 1;
        $grandTotal = 0;

        foreach ($groupedSpecifications as $subSystemId => $items) {
            $subSystemName = $items->first()->subSystemDescription->subSystem->name;

            // Calculate total price for this subsystem
            $subSystemTotal = $items->sum(function ($item) {
                return $item->qty * $item->unit_price;
            });

            $grandTotal += $subSystemTotal;

            $rows->push([
                $counter,
                $subSystemName . ' SYSTEM',
                $items->count(),
                'Rp.'. number_format($subSystemTotal, 0, ',', '.'),
            ]);

            $counter++;
        }

        // Add empty row
        $rows->push(['', '', '', '']);

        // Add grand total row
        $rows->push([
            '',
            'GRAND TOTAL',
            '',
            'Rp.'. number_format($grandTotal, 0, ',', '.'),
        ]);

        $this->totalRows = $rows->count();

        return $rows;
    }

    public function headings(): array
    {
        return []; // Headings are included in collection
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $lastRow = $this->totalRows;

                // Set column widths
                $event->sheet->getColumnDimension('A')->setWidth(10);
                $event->sheet->getColumnDimension('B')->setWidth(50);
                $event->sheet->getColumnDimension('C')->setWidth(20);
                $event->sheet->getColumnDimension('D')->setWidth(30);

                // Style the title row (now at row 4)
                $event->sheet->mergeCells('A4:D4');
                $event->sheet->getStyle('A4:D4')->applyFromArray([
                    'font' => [
                        'bold' => true,
                        'size' => 16,
                        'name' => 'Trebuchet MS',
                    ],
                    'alignment' => [
                        'horizontal' => Alignment::HORIZONTAL_CENTER,
                        'vertical' => Alignment::VERTICAL_CENTER,
                    ],
                    'fill' => [
                        'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                        'color' => ['rgb' => '93C572'],
                    ],
                ]);

                // Style the header row (now at row 5)
                $event->sheet->getStyle('A5:D5')->applyFromArray([
                    'font' => [
                        'bold' => true,
                        'size' => 12,
                        'name' => 'Trebuchet MS',
                    ],
                    'fill' => [
                        'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                        'color' => ['rgb' => 'b0d499'],
                    ],
                    'alignment' => [
                        'horizontal' => Alignment::HORIZONTAL_CENTER,
                        'vertical' => Alignment::VERTICAL_CENTER,
                    ],
                ]);


                // Style all data cells (now starting from row 6)
                $event->sheet->getStyle('A6:D' . ($lastRow - 2))->applyFromArray([
                    'font' => [
                        'size' => 11,
                        'name' => 'Trebuchet MS',
                    ],
                    'fill' => [
                        'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                        'color' => ['rgb' => 'ebf3e6'],
                    ],
                ]);

                // Style the grand total row
                $event->sheet->getStyle('A' . $lastRow . ':D' . $lastRow)->applyFromArray([
                    'font' => [
                        'bold' => true,
                        'size' => 12,
                        'name' => 'Trebuchet MS',
                    ],
                    'fill' => [
                        'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                        'color' => ['rgb' => '93C572'],
                    ],
                ]);

                // Set number format for price column
                $event->sheet->getStyle('D6:D' . $lastRow)
                    ->getNumberFormat()
                    ->setFormatCode('"Rp" #,##0.00');

                // Center align specific columns
                $event->sheet->getStyle('A6:A' . $lastRow)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
                $event->sheet->getStyle('C6:C' . $lastRow)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);

                // Left align system names
                $event->sheet->getStyle('B6:B' . $lastRow)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_LEFT);

                // Right align prices
                $event->sheet->getStyle('D6:D' . $lastRow)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_LEFT);

                // Add borders
                $event->sheet->getStyle('A4:D' . $lastRow)->applyFromArray([
                    'borders' => [
                        'outline' => [
                            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK,
                            'color' => ['rgb' => '000000'],
                        ],
                        'inside' => [
                            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                            'color' => ['rgb' => '000000'],
                        ],
                    ],
                ]);

                // Set row height
                $event->sheet->getRowDimension(4)->setRowHeight(30);
                $event->sheet->getRowDimension(5)->setRowHeight(25);

                // Freeze panes (now at row 6)
                $event->sheet->getDelegate()->freezePane('A6');
            },
        ];
    }
}