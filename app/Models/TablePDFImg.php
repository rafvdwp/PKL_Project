<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TablePDFImg extends Model
{
    use HasFactory;
    protected $table = 'TablePDFImg';

    public function project()
    {
        return $this->hasMany(Project::class);
    }
}
