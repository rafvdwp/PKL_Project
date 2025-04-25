<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class subSystemDescription extends Model
{
    use HasFactory;

    protected $fillable = [
        'Description_name',
        'Description_jumlah',
        'subSystem_id',
        'project_id',
        'user_id'
    ];

    protected $table = 'subSystemDescription';

    public function specification()
    {
        return $this->hasMany(Specification::class, 'subSystemDescription_id', 'id');
    }

    public function subSystem()
    {
        return $this->belongsTo(SubSystem::class, 'subSystem_id');
    }

    public function project() 
    {
        return $this->belongsTo(project::class);
    }

    public function user() 
    {
        return $this->belongsTo(User::class);
    }

    public function managesubSystem()
    {
        return $this->belongsTo(ManagesubSystem::class);
    }

    public function subSystemDescription()
    {
        return $this->hasMany(SubSystemDescription::class, 'subSystem_id');
    }

    public function specificationbulkmaterial()
    {
        return $this->hasMany(SpecificationBulkMaterial::class, 'subSystemDescription_id');
    }

    public function specifications()
    {
        return $this->hasMany(Specification::class, 'subSystemDescription_id');
    }


    public function specificationBulkMaterials()
    {
        return $this->hasMany(SpecificationBulkMaterial::class, 'subSystemDescription_id');
    }

    public function PrintPDF()
    {
        return $this->hasMany(PrintPDF::class);
    }
    

}
