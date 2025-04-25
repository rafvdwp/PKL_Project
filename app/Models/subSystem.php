<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class subSystem extends Model
{
    protected $table = 'subSystem';
    public $incrementing = false;
    protected $fillable = ['id', 'project_id', 'name', 'category']; 

    // Relasi subSystem dimiliki oleh Project   
    public function project()
    {
        return $this->belongsTo(Project::class);
    }


    public function subSystem()
    {
        return $this->belongsTo(subSystem::class);
    }

    public function managesubSystem()
    {
        return $this->belongsTo(ManagesubSystem::class);
    }

    public function subSystemDescription()
    {
        return $this->hasMany(SubSystemDescription::class, 'subSystem_id', 'id');
    }

    public function subSystemDescriptions()
    {
        return $this->hasMany(SubSystemDescription::class, 'subSystem_id');
    }

    public function projects()
    {
        return $this->hasMany(Project::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function unit()
    {
        return $this->belongsTo(Unit::class);
    }

    public function PrintPDF()
    {
        return $this->hasMany(PrintPDF::class);
    }

}
