<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ClassesController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->post('signout', [AuthController::class, "signout"]);


//AuthController
Route::post("signin", [AuthController::class, "signin"] );
// Route::post("signout", [AuthController::class, "signout"] );

//UserContoller
Route::get("user/index", [UserController::class, "index"]);
Route::get("user/show/{id}", [UserController::class, "show"] );
Route::post("user/create", [UserController::class, "create"] );
Route::put("user/update/{id}", [UserController::class, "update"] );
Route::delete("user/delete/{user_id}", [UserController::class, "delete"] );

//RoleController
Route::get("role/index", [RoleController::class, "index"]);
Route::get("role/{id}", [RoleController::class, "show"] );
Route::post("role/create", [RoleController::class, "create"] );
Route::put("role/update/{id}", [RoleController::class, "update"] );
Route::delete("role/delete/{role_id}", [RoleController::class, "delete"] );

//ClassesController
Route::get("classes/index", [ClassesController::class, "index"]);
Route::get("classes/{id}", [ClassesController::class, "show"] );
Route::post("classes/create", [ClassesController::class, "create"] );
Route::put("classes/update/{id}", [ClassesController::class, "update"] );
Route::delete("classes/delete/{classes_id}", [ClassesController::class, "delete"] );

//CourseController
Route::get("course/index", [CourseController::class, "index"]);
Route::get("course/{id}", [CourseController::class, "show"] );
Route::post("course/create", [CourseController::class, "create"] );
Route::put("course/update/{id}", [CourseController::class, "update"] );
Route::delete("course/delete/{course_id}", [CourseController::class, "delete"] );

//RoomsController
Route::get("room/index", [RoomController::class, "index"]);
Route::get("room/{id}", [RoomController::class, "show"] );
Route::post("room/create", [RoomController::class, "create"] );
Route::put("room/update/{id}", [RoomController::class, "update"] );
Route::delete("room/delete/{room_id}", [RoomController::class, "delete"] );

//PermissionController
Route::get("permission/index", [PermissionController::class, "index"]);
Route::get("permission/{id}", [PermissionController::class, "show"] );
Route::post("permission/create", [PermissionController::class, "create"] );
Route::put("permission/update/{id}", [PermissionController::class, "update"] );
Route::delete("permission/delete/{permission_id}", [PermissionController::class, "delete"] );

//SubjectController
Route::get("subject/index", [SubjectController::class, "index"]);
Route::get("subject/{id}", [SubjectController::class, "show"] );
Route::post("subject/create", [SubjectController::class, "create"] );
Route::put("subject/evaluate-grade", [SubjectController::class, "evaluate"]);
Route::get("subject/student-grade/{student_id}/{subject_id}", [SubjectController::class, "getStudentGrade"]);
Route::put("subject/update/{id}", [SubjectController::class, "update"] );
Route::delete("subject/delete/{subject_id}", [SubjectController::class, "delete"] );

//StudentsController
Route::get("student/index", [StudentController::class, "index"]);
Route::get("student/{id}", [StudentController::class, "show"] );
Route::post("student/create", [StudentController::class, "create"] );
Route::put("student/update/{id}", [StudentController::class, "update"] );
Route::delete("student/delete/{student_id}", [StudentController::class, "delete"] );