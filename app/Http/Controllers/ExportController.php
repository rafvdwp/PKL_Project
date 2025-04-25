<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;
use App\Models\Specification;
use Illuminate\Support\Facades\Log;
use App\Exports\SpecificationExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\SpecificationBulkMaterial;
use App\Exports\SpecificationExport_budgetary;
use App\Exports\SpecificationExportBulk_Material;

class ExportController extends Controller
{
    public function exportSpecification_budgetary($project_id)
    {
        try {
            // Memastikan project exists
            $project = Project::findOrFail($project_id);

            // Mengambil specifications untuk project tertentu dengan eager loading yang tepat
            $specifications = Specification::with([
                'subSystemDescription' => function ($query) {
                    $query->with(['subSystem' => function ($query) {
                        $query->orderBy('id');
                    }]);
                }
            ])
                ->whereHas('subSystemDescription', function ($query) use ($project_id) {
                    $query->where('project_id', $project_id)
                        ->whereHas('subSystem', function ($query) {
                            $query->where('category', 'budgetary');
                        });
                })
                ->orderBy('subSystemDescription_id')
                ->orderBy('id')
                ->get();

            // Log untuk debugging
            Log::info("Exporting specifications for project {$project_id}", [
                'specifications_count' => $specifications->count(),
                'project_name' => $project->name
            ]);

            // Cek jika ada data
            if ($specifications->isEmpty()) {
                return back()->with('error', "No budgetary specifications found for project '{$project->name}'.");
            }

            // Group specifications by subsystem untuk verifikasi
            $groupedSpecs = $specifications->groupBy('subSystemDescription.subSystem.id');

            // Log grouped specifications
            Log::info("Grouped specifications by subsystem", [
                'subsystems_count' => $groupedSpecs->count()
            ]);

            // Buat file Excel baru untuk setiap project
            $filename = "budgetary-specification-{$project->name}-" . time() . '.xlsx';
            $export = new SpecificationExport_budgetary($specifications, $project_id);

            // Kembalikan file Excel yang baru dibuat
            return Excel::download($export, $filename);
        } catch (\Exception $e) {
            Log::error("Error exporting specifications for project {$project_id}", [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            return back()->with('error', 'Failed to export specifications: ' . $e->getMessage());
        }
    }

    public function exportSpecification_bulk_material($project_id)
    {
        // Memastikan project exists
        $project = Project::findOrFail($project_id);

        // Mengambil specifications untuk project tertentu dengan eager loading yang tepat
        $specifications = SpecificationBulkMaterial::with(['subSystemDescription.subSystem'])
            ->whereHas('subSystemDescription', function ($query) use ($project_id) {
                $query->where('project_id', $project_id)
                    ->whereHas('subSystem', function ($query) {
                        $query->where('category', 'bulk_material');
                    });
            })
            ->whereHas('subSystemDescription.subSystem', function ($query) use ($project_id) {
                $query->where('project_id', $project_id);
            })
            ->orderBy('id')
            ->get();

        // Cek jika ada data
        if ($specifications->isEmpty()) {
            return back()->with('error', "No bulk material specifications found for project '{$project->name}'.");
        }

        // Export ke Excel
        $export = new SpecificationExportBulk_Material($specifications, $project_id);
        $filename = "bulk-material-specification-{$project->name}-" . time() . '.xlsx';

        return Excel::download($export, $filename);
    }
}
