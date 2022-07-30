<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Subject;
use Illuminate\Http\Request;
use SebastianBergmann\CodeUnit\FunctionUnit;

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
}
