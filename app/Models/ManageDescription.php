<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ManageDescription extends Model
{
    use HasFactory;
    protected $table = 'manageDescription';

    public function subSystem()
    {
        return $this->belongsTo(ManagesubSystem::class, 'name', 'name');
    }

    public function managesubSystem()
    {
        return $this->belongsTo(ManagesubSystem::class);
    }

    public function project()
    {
        return $this->hasMany(Project::class);
    }

    public function specification()
    {
        return $this->hasMany(Specification::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function subSystemDesciption()
    {
        return $this->hasMany(subSystemDescription::class);
    }
}
