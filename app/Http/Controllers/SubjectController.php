<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Subject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SubjectController extends Controller
{
   public function index()
   {
    $subjects = Subject::all();

    return $subjects;
   }

   public function show($id)
   {
    $subject = Subject::find($id);

    return $subject;
   }

   public function create(Request $request)
   {
    $subject = Subject::create([
        'name' =>$request->name,
        'description' =>$request->description,
        'code' =>$request->code
       
    ]);

    return $subject;
   }

   public function update($id, Request $request)
   { 
    $subject = Subject::find($id);

    $subject->update([
        'name' =>$request->name,
        'description' =>$request->description,
        'code' =>$request->code
    ]);
    

    return $subject;
   }

   public function delete($subject_id)
   {
    $subject = Subject::find($subject_id);

    return $subject->delete();
   }

   public function getStudentGrade($student_id, $subject_id)
   {
        $student_subject = DB::table('student_subjects')
        ->where('student_id', $student_id)
        ->where('subject_id', $subject_id)
        ->first();
        return $student_subject;
   }

   public function evaluate(Request $request)
   {
        $student_id = $request->student_id;
        $subject_id = $request->subject_id;

        $student_subject = DB::table('student_subjects')
            ->where('student_id', $student_id)
            ->where('subject_id', $subject_id)
            ->first();

        if ($student_subject) {
            $updated_student_subject = DB::table('student_subjects')
            ->where('student_id', $student_id)
            ->where('subject_id', $subject_id)
            ->update([
                'grade' => $request->grade
            ]);
            return 'updated';
        }else {
            $new_student_subject = DB::table('student_subjects')
            ->insert([
                'student_id' =>$request->student_id,
                'subject_id' =>$request->subject_id,
                'grade' => $request->grade,
            ]);
            return 'added';
        }
   }
}
