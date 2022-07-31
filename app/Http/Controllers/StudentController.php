<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function index()
    {
        $students = Student::with('class')->get();

        return $students;
    }

    public function show($id)
    {
        $student = Student::with('class.course.subjects')->find($id);

        return $student;
    }

    public function create (Request $request)
    {
        $student = Student::create([
            'firstname'=> $request->firstname,
            'lastname'=> $request->lastname,
            'gender'=> $request->gender,
            'address'=> $request->address,
            'birthdate'=> $request->birthdate,
            'email'=> $request->email,
            'password'=> bcrypt($request->password),
            'class_id'=> $request->class_id,
        ]);

        return $student;
    }

    public function update($id, Request $request)
    {
        $student = Student::find($id);

        $student->update([
            'firstname'=> $request->firstname,
            'lastname'=> $request->lastname,
            'gender'=> $request->gender,
            'address'=> $request->address,
            'birthdate'=> $request->birthdate,
            'email'=> $request->email,
            'password'=> bcrypt($request->password),
            'class_id'=> $request->class_id
        ]);
        
        return $student;
    }


    public function delete($student_id)
    {
        $student = Student::find($student_id);

        return $student->delete();
    }  
}
