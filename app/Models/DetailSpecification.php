<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailSpecification extends Model
{
    use HasFactory;
    protected $table = 'DetailSpecification';

    public function project()
    {
        return $this->hasMany(Project::class);
    }
}
