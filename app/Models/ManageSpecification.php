<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ManageSpecification extends Model
{
    use HasFactory;
    protected $table = 'managespecification';

    public function SpecificationBulkMaterial()
    {
        return $this->hasMany(SpecificationBulkMaterial::class);
    }
}

