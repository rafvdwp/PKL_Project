<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TablePDFTwo extends Model
{
    use HasFactory;
    protected $table = 'TablePDFTwo';

    public function project()
    {
        return $this->hasMany(Project::class);
    }
}
