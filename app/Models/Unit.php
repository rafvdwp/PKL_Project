<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Unit extends Model
{
    use HasFactory;
    protected $table = 'unit';

    public function specification()
    {
        return $this->hasMany(Specification::class);
    }

    public function project()
    {
        return $this->hasMany(Project::class);
    }
}
