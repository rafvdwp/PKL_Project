<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubCategory extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'category_id'];

    // Relasi SubCategory dimiliki oleh Category
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
