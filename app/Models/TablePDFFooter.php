<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TablePDFFooter extends Model
{
    use HasFactory;
    protected $table = 'TablePDFFooter';
    
    public function project()
    {
        return $this->hasMany(Project::class);
    }
}
