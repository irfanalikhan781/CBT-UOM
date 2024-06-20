<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\Course;
use App\Models\Mcq;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Route::get('/api/mcqs/courses/{departmentId}', function ($departmentId) {
//     $courses = Course::where('department_id', $departmentId)->get();
//     return response()->json($courses);
// });

// Route::get('/api/mcqs/course/{courseId}', function ($courseId) {
//     $mcqs = Mcq::where('course_id', $courseId)->get();
//     return response()->json($mcqs);
// });

Route::get('/api/mcqs/department/{departmentId}', function ($departmentId) {
    $mcqs = Mcq::where('department_id', $departmentId)->get();
    return response()->json($mcqs);
});
