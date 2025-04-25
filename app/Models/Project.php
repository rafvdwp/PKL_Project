<?php

namespace App\Models;

use App\Models\subSystem;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Project extends Model
{
    use HasFactory;

    protected $table = 'projects';
    protected $fillable = ['name', 'user_id'];

    public function subSystem()
    {
        return $this->hasMany(SubSystem::class, 'project_id', 'id');
    }

    public function user() 
    {
        return $this->belongsTo(User::class, 'project_id', 'id');
    }

    public function subSystemDescription()
    {
        return $this->hasMany(subSystemDescription::class, 'project_id', 'id');
    }

    public function specification()
    {
        return $this->belongsTo(Specification::class, 'project_id', 'id');
    }

    public function ManagesubSystem()
    {
        return $this->belongsTo(ManagesubSystem::class, 'project_id', 'id');
    }

    public function DetailSpecification()
    {
        return $this->belongsTo(DetailSpecification::class, 'project_id', 'id');
    }

    public function TableOneFill()
    {
        return $this->belongsTo(TableOneFill::class, 'project_id', 'id');
    }

    public function TablePDFFooter()
    {
        return $this->belongsTo(TablePDFFooter::class, 'project_id', 'id');
    }

    public function TablePDFImg()
    {
        return $this->belongsTo(TablePDFImg::class, 'project_id', 'id');
    }

    public function TablePDFOne()
    {
        return $this->belongsTo(TablePDFOne::class, 'project_id', 'id');
    }

    public function TablePDFThree()
    {
        return $this->belongsTo(TablePDFThree::class, 'project_id', 'id');
    }

    public function TablePDFTwo()
    {
        return $this->belongsTo(TablePDFTwo::class, 'project_id', 'id');
    }

    public function TablePDFSize()
    {
        return $this->belongsTo(TableSize::class, 'project_id', 'id');
    }

    public function TableThreeFill()
    {
        return $this->belongsTo(TableThreeFill::class, 'project_id', 'id');
    }

}
