<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Classes extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'course_id'
    ];

    public function students()
    {
        return $this->hasMany(Student::class);
    }

    public function course()
    {
        return $this->belongsTo(Course::class, 'course_id', 'id');
    }
}
