<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Department;
use App\Models\Course;
use Mockery\Loader\RequireLoader;
use Illuminate\Support\Facades\Validator;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $departments = Department::all();
        return view('Admin.addCourse', compact('departments'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $rules = [
            'courseName' => 'required|string|max:255',
            'department_id' => 'required|integer|exists:departments,id'
        ];
        $validator = validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $course = new Course;
        $course->course_name = $request->input('courseName');
        $course->department_id = $request->input('department_id');
        $course->save();

        return redirect()->route('showCourses');
    }



    /**
     * Display the specified resource.
     */
    public function show(request $request)
    {
        //
        $courses = Course::with('department')->get();
        return view('Admin.coursesList', compact('courses'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
