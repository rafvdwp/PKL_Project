<?php

namespace App\Exports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadings;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class SubsystemSheetExportBulk_Material implements FromCollection, WithTitle, WithHeadings, WithEvents
{
    protected $items;
    protected $subSystemName;
    protected $subSystemNumber;
    protected $summaryData;
    protected $descriptions;

    public function __construct($items, $subSystemName, $subSystemNumber, $descriptions)
    {
        $this->items = $items;
        $this->subSystemName = $subSystemName;
        $this->subSystemNumber = $subSystemNumber;
        $this->descriptions = $descriptions; // New parameter for descriptions
        $this->prepareSummaryData();
    }

    private function prepareSummaryData()
    {
        $this->summaryData = [];
        $counter = 1;

        // Only loop through descriptions, not materials
        foreach ($this->descriptions as $description) {
            $this->summaryData[] = [
                'item_no' => $counter,
                'description' => $description->Description_name ?? '',
                'qty' => $description->Description_jumlah ?? 0,
            ];
            $counter++;
        }
    }

    public function collection()
    {
        $rows = collect();

        // Add empty rows for spacing at the top
        for ($i = 0; $i < 3; $i++) {
            $rows->push(['', '', '', '', '', '', '', '', '']);
        }

        // Add first table (Summary)
        $rows->push([
            'SUMMARY OF ' . strtoupper($this->subSystemName) . ' SYSTEM',
            '',
            '',
            '',
            '',
            '',
            '',
            '',
            ''
        ]);

        // Summary headers
        $rows->push([
            'ITEM NO.',
            'DESCRIPTION',
            'QTY',
            '',
            '',
            '',
            '',
            '',
            ''
        ]);

        // Summary data
        foreach ($this->summaryData as $summary) {
            $rows->push([
                $summary['item_no'],
                $summary['description'],
                $summary['qty'],
                '',
                '',
                '',
                '',
                '',
                ''
            ]);
        }

        // Add spacing between tables
        for ($i = 0; $i < 3; $i++) {
            $rows->push(['', '', '', '', '', '', '', '', '']);
        }

        // Second table (Materials)
        $rows->push([
            'MATERIAL LIST OF ' . strtoupper($this->subSystemName) . ' SYSTEM',
            '',
            '',
            '',
            '',
            '',
            '',
            '',
            ''
        ]);

        // Materials table header
        $rows->push([
            'No.',
            'Material Type',
            'Unit Material',
            'Unit',
            'Total Material',
            'Remark',
            '',
            '',
            ''
        ]);

        // Materials data
        $counter = 1;
        foreach ($this->items as $item) {
            $rows->push([
                $counter,
                $item->material_type,
                $item->unit_material,
                $item->unit,
                $item->total_material,
                '',
                '',
                '',
                ''
            ]);
            $counter++;
        }

        return $rows;
    }

    public function title(): string
    {
        return $this->subSystemName;
    }

    public function headings(): array
    {
        return [];
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $sheet = $event->sheet->getDelegate();

                // Set column dimensions
                $sheet->getColumnDimension('A')->setWidth(15);
                $sheet->getColumnDimension('B')->setWidth(40);
                $sheet->getColumnDimension('C')->setWidth(15);
                $sheet->getColumnDimension('D')->setWidth(15);
                $sheet->getColumnDimension('E')->setWidth(20);
                $sheet->getColumnDimension('F')->setWidth(15);

                // Calculate row positions
                $summaryTitleRow = 4;
                $summaryHeaderRow = 5;
                $summaryLastRow = 5 + count($this->summaryData);
                $materialsTitleRow = $summaryLastRow + 4;
                $materialsHeaderRow = $materialsTitleRow + 1;
                $materialsLastRow = $materialsHeaderRow + count($this->items);

                // Style Summary Title
                $sheet->mergeCells("A{$summaryTitleRow}:C{$summaryTitleRow}");
                $sheet->getStyle("A{$summaryTitleRow}:C{$summaryTitleRow}")->applyFromArray([
                    'font' => [
                        'bold' => true,
                        'size' => 10,
                        'name' => 'Trebuchet MS'
                    ],
                    'fill' => [
                        'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                        'startColor' => ['rgb' => 'b0d499']
                    ],
                    'alignment' => [
                        'horizontal' => Alignment::HORIZONTAL_CENTER,
                        'vertical' => Alignment::VERTICAL_CENTER
                    ]
                ]);

                // Style Summary Section
                $sheet->getStyle("A{$summaryHeaderRow}:C{$summaryLastRow}")->applyFromArray([
                    'font' => [
                        'name' => 'Trebuchet MS',
                        'size' => 8
                    ],
                    'borders' => [
                        'allBorders' => [
                            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN
                        ]
                    ],
                    'fill' => [
                        'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                        'startColor' => ['rgb' => 'ebf3e6']
                    ]
                ]);

                // Style Materials Title
                $sheet->mergeCells("A{$materialsTitleRow}:F{$materialsTitleRow}");
                $sheet->getStyle("A{$materialsTitleRow}:F{$materialsTitleRow}")->applyFromArray([
                    'font' => [
                        'bold' => true,
                        'size' => 10,
                        'name' => 'Trebuchet MS'
                    ],
                    'fill' => [
                        'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                        'startColor' => ['rgb' => 'b0d499']
                    ],
                    'alignment' => [
                        'horizontal' => Alignment::HORIZONTAL_CENTER,
                        'vertical' => Alignment::VERTICAL_CENTER
                    ]
                ]);

                // Style Materials Section
                $sheet->getStyle("A{$materialsHeaderRow}:F{$materialsLastRow}")->applyFromArray([
                    'font' => [
                        'name' => 'Trebuchet MS',
                        'size' => 8
                    ],
                    'borders' => [
                        'allBorders' => [
                            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN
                        ]
                    ],
                    'fill' => [
                        'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                        'startColor' => ['rgb' => 'ebf3e6']
                    ]
                ]);

                // Style Headers
                $headerStyle = [
                    'font' => [
                        'bold' => true,
                        'size' => 12,
                        'name' => 'Trebuchet MS'
                    ],
                    'fill' => [
                        'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                        'startColor' => ['rgb' => '93C572']
                    ],
                    'alignment' => [
                        'horizontal' => Alignment::HORIZONTAL_CENTER,
                        'vertical' => Alignment::VERTICAL_CENTER
                    ]
                ];

                $sheet->getStyle("A{$summaryHeaderRow}:C{$summaryHeaderRow}")->applyFromArray($headerStyle);
                $sheet->getStyle("A{$materialsHeaderRow}:F{$materialsHeaderRow}")->applyFromArray($headerStyle);

                // Set alignment for specific columns in both tables
                $sheet->getStyle('A:A')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
                $sheet->getStyle('C:C')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
                $sheet->getStyle('D:D')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
                $sheet->getStyle('F:F')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
                $sheet->getStyle('B:B')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_LEFT);
                $sheet->getStyle('E:E')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_LEFT);

                // Enable text wrapping
                $sheet->getStyle("A{$summaryTitleRow}:F{$materialsLastRow}")->getAlignment()->setWrapText(true);

                // Set row heights
                $sheet->getRowDimension($summaryTitleRow)->setRowHeight(20);
                $sheet->getRowDimension($summaryHeaderRow)->setRowHeight(30);
                $sheet->getRowDimension($materialsTitleRow)->setRowHeight(20);
                $sheet->getRowDimension($materialsHeaderRow)->setRowHeight(30);

                // Freeze panes for both tables
                $sheet->freezePane('A6');
            }
        ];
    }
}
