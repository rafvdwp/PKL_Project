<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SpecificationBulkMaterial extends Model
{
    use HasFactory;
    protected $fillable = [
        'project_id',
        'subSystemDescription_id',
        'material_type',
        'unit_material',
        'unit',
        'total_material',
        'unit_price',  // Tambahkan field unit_price
        'qty',         // Tambahkan field qty
    ];
    protected $table = 'specificationbulkmaterial';

    public function subSystem()
    {
        return $this->belongsTo(subSystem::class);
    }

    public function subSystemDescription()
    {
        return $this->belongsTo(SubSystemDescription::class, 'subSystemDescription_id');
    }

    public function project()
    {
        return $this->hasMany(Project::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function managesubSystem()
    {
        return $this->belongsTo(ManagesubSystem::class);
    }

    public function Unit()
    {
        return $this->belongsTo(Unit::class);
    }
    public function Specifiaction()
    {
        return $this->belongsTo(Specification::class);
    }

    public function manageSpecification()
    {
        return $this->belongsTo(ManageSpecification::class);
    }

    public function PrintPDF()
    {
        return $this->hasMany(PrintPDF::class);
    }

    
}
