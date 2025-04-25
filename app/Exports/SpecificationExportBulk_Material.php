<?php

namespace App\Exports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Style\Alignment;

class SpecificationExportBulk_Material implements WithMultipleSheets
{
    protected $specifications;

    public function __construct($specifications)
    {
        $this->specifications = $specifications->filter(function ($item) {
            return $item->subSystemDescription->subSystem->category === 'bulk_material';
        });
    }

    public function sheets(): array
    {
        $sheets = [];

        if ($this->specifications->isNotEmpty()) {
            // Group by subsystem
            $groupedSpecifications = $this->specifications->groupBy(function ($item) {
                return $item->subSystemDescription->subSystem->id;
            });

            $groupedSpecifications = $groupedSpecifications->sortKeys();

            $subSystemCounter = 1;
            foreach ($groupedSpecifications as $subSystemId => $items) {
                $subSystem = $items->first()->subSystemDescription->subSystem;
                $subSystemName = $subSystem->name;

                // Get unique descriptions for this subsystem
                $descriptions = $items->map(function ($item) {
                    return $item->subSystemDescription;
                })->unique('id');

                // Create new sheet with separate descriptions
                $sheets[] = new SubsystemSheetExportBulk_Material(
                    $items,                 // Material items
                    $subSystemName,         // Subsystem name
                    $subSystemCounter,      // Subsystem counter
                    $descriptions          // Unique descriptions
                );

                $subSystemCounter++;
            }
        }

        return $sheets;
    }
}
