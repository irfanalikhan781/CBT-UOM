<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Department;
use App\Models\Course;
use App\Models\McqsBank;
use App\Models\Test;
use App\Models\Result;
use App\Models\CandidateTest;
use App\Models\Admin;
use Illuminate\Support\Facades\Auth;
use Illuminate\Pagination\LengthAwarePaginator;

class TestController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $departments = Department::with('courses')->get();
        return view('Admin.createTestForm', compact('departments'));
    }

    /**
     * Store a newly created resource in storage.
     */
    // TestController.php
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'department_id' => 'required|exists:departments,id',
            'total_mcqs' => 'required|integer|min:1',
            'course_mcqs' => 'required|array',
            'duration' => 'required|integer|min:1'
        ]);

        $adminId = Auth::guard('admin')->id();

        $test = Test::create([
            'name' => $request->name,
            'department_id' => $request->department_id,
            'admin_id' => $adminId,
            'total_mcqs' => $request->total_mcqs,
            'duration' => $request->duration
        ]);

        foreach ($request->course_mcqs as $courseMcqs) {
            $mcqs = McqsBank::where('course_id', $courseMcqs['course_id'])
                ->inRandomOrder()
                ->limit($courseMcqs['mcq_count'])
                ->pluck('id')
                ->toArray();
            $test->mcqs()->attach($mcqs);
        }

        return redirect()->route('preparedTests')->with('success', 'Test created successfully!');
    }


    /**
     * Display the specified resource.
     */

    public function showPreparedTests()
    {
        $tests = Test::with('department', 'admins')->get();
        return view('Admin.preparedTests', compact('tests'));
    }








    // public function startTest(Department $department)
    // {
    //     $candidate = auth()->user();
    //     $test = $department->tests->first();

    //     if (Result::where('candidate_id', $candidate->id)->where('test_id', $test->id)->exists()) {
    //         return redirect()->back()->with('error', 'You have already taken this test.');
    //     }

    //     $requirements = json_decode($test->requirements, true);
    //     $mcqs = collect();

    //     foreach ($requirements as $courseId => $count) {
    //         $mcqsFromCourse = McqsBank::where('course_id', $courseId)
    //             ->inRandomOrder()
    //             ->take($count)
    //             ->get();
    //         $mcqs = $mcqs->merge($mcqsFromCourse);
    //     }

    //     $currentPage = LengthAwarePaginator::resolveCurrentPage();
    //     $perPage = 10;
    //     $currentItems = $mcqs->slice(($currentPage - 1) * $perPage, $perPage);
    //     $paginatedMcqs = new LengthAwarePaginator($currentItems, $mcqs->count(), $perPage, $currentPage, [
    //         'path' => LengthAwarePaginator::resolveCurrentPath(),
    //     ]);

    //     return view('candidate.test', compact('test', 'paginatedMcqs'));
    // }
    public function results()
    {
        //
        $results = Result::all();
        return view('Admin.results', compact('results'));
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
    public function destroy($id)
    {
        $test = Test::find($id);

        if ($test) {
            $test->delete();
            return redirect()->route('preparedTests')->with('success', 'Test deleted successfully.');
        }

        return redirect()->route('preparedTests')->with('error', 'Test not found.');
    }
}
