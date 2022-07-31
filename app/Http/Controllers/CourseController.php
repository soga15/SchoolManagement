<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Course;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    public function index()
    {
        $courses = Course::with('subjects')->get();

        return $courses;
    }

    public function show($id)
    {
       $course = Course::find($id);

       return $course;
    }

    public function create(Request $request)
    {
        $course = Course::create([
            'name' =>$request->name,
            'description' =>$request->description,
        ]);

        return $course;
    }

    public function update($id, Request $request)
    {
        $course = Course::find($id);

        $course->update([
            'name' =>$request->name,
            'description' =>$request->description
        ]);
        $course->subjects()->sync($request->subjects);

        return $course;
    }

    public function delete($course_id)
    {
        $course = Course::find($course_id);

        return $course->delete();
    }
}
