<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TableTwoFill extends Model
{
    use HasFactory;
    protected $table = 'TableTwoFill';

    public function project()
    {
        return $this->hasMany(Project::class);
    }

}
