<?php

namespace App\Models;

use App\Models\ManageDescription;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ManagesubSystem extends Model
{
    use HasFactory;
    protected $table = 'managesubSystem';

    public function project()
    {
        return $this->hasMany(Project::class);
    }

    public function subSystem()
    {
        return $this->hasMany(subSystem::class);
    }

    public function subSystemDescription()
    {
        return $this->hasMany(subSystemDescription::class);
    }

    public function specification()
    {
        return $this->hasMany(Specification::class);
    }

    public function manageDescription()
    {
        return $this->hasMany(manageDescription::class);
    }
}
