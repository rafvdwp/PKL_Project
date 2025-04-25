<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TableOneFill extends Model
{
    use HasFactory;
    protected $table = 'TableOneFill';
    protected $fillable = [
        'code',
        'description',
        'type',
        'unit',
        'qty'
    ];

    public function project()
    {
        return $this->hasMany(Project::class);
    }
}
