<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Classes;
use Illuminate\Http\Request;

class ClassesController extends Controller
{
    public function index()
    {
        $classes = Classes::with('course')->get();

        return $classes;
    }

    public function show($id)
    {
        $classes = Classes::with('course')->find($id);

        return $classes;
    }

    public function create(Request $request)
    {
        $classes = Classes::create([
            'name' =>$request->name,
            'description' =>$request->description,
            'course_id' =>$request->course_id
        ]);

        return $classes;
    }

    public function update($id, Request $request)
    {
        $classes = Classes::find($id);

        $classes->update([
            'name' =>$request->name,
            'description' =>$request->description,
            'course_id' =>$request->course_id
        ]);

        return $classes;
    }

    public function delete($classes_id)
    {
        $classes = Classes::find($classes_id);

        return $classes->delete();
    }
}
