<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Program;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DepartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $programs = Program::all();
        return view('Admin.addDepartment', compact('programs'));

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
        $rules = [
            'depttName' => 'required|string|max:255',
            'programs' => 'required|array',
            'programs.*' => 'integer|exists:programs,id',
        ];
        $validator = validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $department = Department::create([
            'name' => $request->input("depttName")
        ]);
        $department->programs()->attach($request->input('programs'));
        session()->flash('success', 'Department created successfully!');
        return redirect()->route('departmentList');

        // $this->validate($request, [
        //     'depttName' => 'required|string|max:255',
        // ]);

        // $departmentName = $request->input('depttName');

        // $department = Department::create([
        //     'name' => $departmentName,
        // ]);

        // Handle success message, redirect, etc.
        // return redirect()->route('departmentList')
        //     ->with('success', 'Department ' . $departmentName . ' created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(request $request)
    {
        //
        $departments = Department::with('programs')->get();
        return view('admin.departmentList', compact('departments'));
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
