<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Student extends Model
{
    use HasFactory, SoftDeletes;

    // protected $table = 'students';
    // protected $primarykey = 'student_id';
    // public $incrementing = false;
    // protected $keyType = 'string';
    // public $timestamp = false;

    // create data eloquent
    protected $fillable = [
        'name', 'gender', 'nis', 'class_id', 'image'
    ];

    public function class()
    {
        return $this->belongsTo(ClassRoom::class);
    }

    public function extracurriculars()
    {
        return $this->belongsToMany(Extracurricular::class, 'student_extracurricular', 'student_id', 'extracurricular_id');
    }
}
