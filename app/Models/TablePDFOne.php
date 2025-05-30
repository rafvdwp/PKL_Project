<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TablePDFOne extends Model
{
    use HasFactory;
    protected $table = 'TablePDFOne';

    public function project()
    {
        return $this->hasMany(Project::class);
    }

}
