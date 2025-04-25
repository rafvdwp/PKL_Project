<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PrintPDF extends Model
{
    use HasFactory;
    protected $table = 'TablePDF';

    public function Specification()
    {
        return $this->belongsTo(Specification::class);
    }

    public function SpecificationBulkMaterial()
    {
        return $this->belongsTo(SpecificationBulkMaterial::class);
    }

    public function subSystem()
    {
        return $this->belongsTo(subSystem::class);
    }

    public function subSystemDescription()
    {
        return $this->belongsTo(subSystemDescription::class);
    }
}
