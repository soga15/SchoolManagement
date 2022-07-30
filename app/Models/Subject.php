<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'code',
        'course_id'
    ];

    public function courses()
    {
        return $this->belongsToMany(Course::class, 'course_subjects');
    }
}
