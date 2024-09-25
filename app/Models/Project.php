<?php

namespace App\Models;

use App\Models\Category;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Project extends Model
{
    use HasFactory;

    protected $table = 'projects';
    protected $fillable = ['name'];

    public function category()
    {
        return $this->hasMany(Category::class);
    }
}
