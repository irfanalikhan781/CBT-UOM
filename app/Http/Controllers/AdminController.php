<?php

namespace App\Http\Controllers;

use App\Models\Candidate;
use App\Models\Mcq;
use Illuminate\Http\Request;
use App\Models\Department;
use App\Models\Course;
use App\Models\Result;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $count = Department::count();
        $count_courses = Course::count();
        $count_candidates = Candidate::count();
        $count_mcqs = Mcq::count();
        return view('Admin.dashboard', compact('count', 'count_courses', 'count_candidates', 'count_mcqs'));
    }

    //Route for Searching a specific candidate result.
    public function searchResults(Request $request)
    {
        $username = $request->input('username');
        $results = Result::where('candidate_username', 'like', '%' . $username . '%')->get();

        return view('Admin.results', compact('results'));
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
    }

    /**
     * Display the specified resource.
     */
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
    public function destroy(string $id)
    {
        //
    }
}
