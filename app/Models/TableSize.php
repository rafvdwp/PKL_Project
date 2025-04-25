<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TableSize extends Model
{
    use HasFactory;
    protected $table = 'Size';

    public function project()
    {
        return $this->hasMany(Project::class);
    }
}
