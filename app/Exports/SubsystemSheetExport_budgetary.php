<?php

namespace App\Exports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadings;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use Maatwebsite\Excel\Concerns\FromCollection;

class SubsystemSheetExport_budgetary implements FromCollection, WithHeadings, WithTitle, WithEvents
{
    protected $items;
    protected $subSystemName;
    protected $subSystemNumber;

    public function __construct($items, $subSystemName, $subSystemNumber)
    {
        $this->items = $items;
        $this->subSystemName = $subSystemName;
        $this->subSystemNumber = $subSystemNumber;
    }

    public function collection()
    {
        $rows = collect();

        // Add subsystem header row
        $rows->push([
            $this->subSystemNumber,
            $this->subSystemName . ' SYSTEM',
            '',
            '',
            '',
            '',
            '',
            '',
        ]);

        // Group items by description while considering project_id
        $groupedByDescription = $this->items->groupBy(function ($item) {
            // Create a unique key combining project_id and description_id
            return $item->project_id . '-' . $item->subSystemDescription->id;
        });

        $descriptionCounter = 1;
        $totalDescriptions = $groupedByDescription->count();

        foreach ($groupedByDescription as $combinedKey => $items) {
            $firstItem = $items->first();
            $descriptionNumber = $this->subSystemNumber . '.' . $descriptionCounter;

            foreach ($items as $index => $item) {
                $subTotal = $item->qty * $item->unit_price;

                // Combine description and specification in the same row
                $rows->push([
                    $index === 0 ? $descriptionNumber : '', // Show number only for first item
                    $index === 0 ? $firstItem->subSystemDescription->Description_name : '', // Show description only for first item
                    $item->specification,
                    $item->part_number,
                    $item->qty,
                    $item->unit,
                    'Rp.' . number_format($item->unit_price, 0, ',', '.'),
                    'Rp.' . number_format($subTotal, 0, ',', '.'),
                ]);
            }

            // Add empty row after each description group except the last one
            if ($descriptionCounter < $totalDescriptions) {
                $rows->push(['', '', '', '', '', '', '', '']);
            }

            $descriptionCounter++;
        }

        return $rows;
    }

    public function headings(): array
    {
        return [
            'ITEM NO.',
            'DESCRIPTION',
            'SPECIFICATION',
            'PART NUMBER',
            'QTY',
            'UNIT',
            'UNIT PRICE',
            'Sub Total',
        ];
    }

    public function title(): string
    {
        return $this->subSystemName;
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $highestRow = $event->sheet->getHighestRow() + 3;

                $event->sheet->insertNewRowBefore(1, 3);

                // Default center alignment for all cells
                $event->sheet->getStyle('A4:H' . $highestRow)->getAlignment()->setVertical(Alignment::VERTICAL_CENTER);
                $event->sheet->getStyle('A4:H' . $highestRow)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);

                $event->sheet->getStyle('G4:G' . $highestRow)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_LEFT);
                $event->sheet->getStyle('C5:C' . $highestRow)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_LEFT);
                $event->sheet->getStyle('B4:B' . $highestRow)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_LEFT);
                $event->sheet->getStyle('H4:H' . $highestRow)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_LEFT);

                // Set custom number format
                $event->sheet->getStyle('G4:H' . $highestRow)
                    ->getNumberFormat()
                    ->setFormatCode('[$Rp. ]#,##0');

                $event->sheet->getStyle('H4:H' . $highestRow)
                    ->getNumberFormat()
                    ->setFormatCode('"Rp" #,##0.00');

                // Column widths
                $event->sheet->getColumnDimension('A')->setWidth(15);
                $event->sheet->getColumnDimension('B')->setWidth(40);
                $event->sheet->getColumnDimension('C')->setWidth(40);
                $event->sheet->getColumnDimension('D')->setWidth(15);
                $event->sheet->getColumnDimension('E')->setWidth(10);
                $event->sheet->getColumnDimension('F')->setWidth(10);
                $event->sheet->getColumnDimension('G')->setWidth(20);
                $event->sheet->getColumnDimension('H')->setWidth(20);

                // Borders
                $event->sheet->getStyle('A4:H' . $highestRow)->applyFromArray([
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
                    'font' => [
                        'name' => 'Trebuchet MS',
                        'size' => 8,
                    ],
                ]);

                // Set default background color
                $event->sheet->getStyle('A4:H' . $highestRow)->applyFromArray([
                    'fill' => [
                        'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                        'color' => ['rgb' => 'ebf3e6'],
                    ],
                ]);

                // Freeze panes
                $event->sheet->getDelegate()->freezePane('A6');

                // Headers styling
                $event->sheet->getStyle('A4:H4')->applyFromArray([
                    'font' => [
                        'bold' => true,
                        'size' => 12,
                        'name' => 'Trebuchet MS',
                    ],
                    'fill' => [
                        'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                        'color' => ['rgb' => '93C572'],
                    ],
                    'alignment' => [
                        'horizontal' => Alignment::HORIZONTAL_CENTER,
                        'vertical' => Alignment::VERTICAL_CENTER,
                    ],

                ]);

                // Description header rows styling
                for ($row = 6; $row <= $highestRow; $row++) {
                    $itemNoCell = $event->sheet->getCell('A' . $row)->getValue();
                    $descriptionCell = $event->sheet->getCell('B' . $row)->getValue();

                    if (!empty($itemNoCell) && !empty($descriptionCell)) {
                        $event->sheet->getStyle('A' . $row . ':H' . $row)->applyFromArray([
                            'fill' => [
                                'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                                'color' => ['rgb' => 'ddecd3'],
                            ],
                            'font' => [
                                'name' => 'Trebuchet MS',
                                'size' => 8,
                            ],
                        ]);
                    }
                }

                // Subsystem name row styling (row 5) - Updated with b0d499 color and font size 10
                $event->sheet->getStyle('A5:H5')->applyFromArray([
                    'fill' => [
                        'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                        'color' => ['rgb' => 'b0d499'],  // Changed to b0d499
                    ],
                    'font' => [
                        'name' => 'Trebuchet MS',
                        'size' => 10,  // Changed to size 10
                    ],
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

                $event->sheet->getStyle('B5')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_LEFT);

                // Enable text wrapping
                $event->sheet->getStyle('A4:H' . $highestRow)->getAlignment()->setWrapText(true);

                // Add padding to all cells
                $event->sheet->getStyle('A4:H' . $highestRow)->getAlignment()->setIndent(1);

                $event->sheet->getRowDimension(4)->setRowHeight(30);
                $event->sheet->getRowDimension(5)->setRowHeight(20);
            },
        ];
    }
}
