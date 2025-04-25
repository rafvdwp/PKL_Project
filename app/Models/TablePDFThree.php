<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TablePDFThree extends Model
{
    use HasFactory;
    protected $table = 'TablePDFThree';

    public function project()
    {
        return $this->hasMany(Project::class);
    }

}
