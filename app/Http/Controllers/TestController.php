<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Department;
use App\Models\Course;
use App\Models\McqsBank;
use App\Models\Test;
use App\Models\Result;
use App\Models\CandidateTest;
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
            'course_mcqs' => 'array',
            'course_mcqs.*.course_id' => 'exists:courses,id',
            'course_mcqs.*.mcq_count' => 'nullable|integer|min:1',
            'total_mcqs' => 'required|integer|min:1',
        ]);
        $name = $request->input('name');
        $departmentId = $request->input('department_id');
        $totalMcqs = $request->input('total_mcqs');
        $courseMcqs = $request->input('course_mcqs');

        $test = Test::create([
            'name' => $name,
            'department_id' => $departmentId,
            'total_mcqs' => $totalMcqs,
        ]);

        foreach ($courseMcqs as $courseData) {
            if (!empty($courseData['mcq_count'])) {
                $courseId = $courseData['course_id'];
                $mcqCount = $courseData['mcq_count'];

                $mcqs = McqsBank::where('course_id', $courseId)->inRandomOrder()->take($mcqCount)->get();

                foreach ($mcqs as $mcq) {
                    $test->mcqs()->attach($mcq->id);
                    \Log::info('Attaching MCQ ID: ' . $mcq->id . ' to Test ID: ' . $test->id);
                }
            }
        }

        return redirect()->route('preparedTests')->with('success', 'Test created successfully.');
    }


    /**
     * Display the specified resource.
     */

    public function showPreparedTests()
    {
        $departmentsWithTests = Test::with('department')->get()->groupBy('department_id');

        return view('Admin.preparedTests', compact('departmentsWithTests'));
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
    public function show(string $id)
    {
        //
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
    public function destroy($id, Request $request)
    {
        $test = Test::findOrFail($id);
        $test->delete();

        return redirect()->route('preparedTests')->with('success', 'Test deleted successfully.');
    }
}
