<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = ['name', 'project_id'];

    // Relasi Category dimiliki oleh Project
    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function lan()
    {
        return $this->hasMany(Lan::class);
    }

}
