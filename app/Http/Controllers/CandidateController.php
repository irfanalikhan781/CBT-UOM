<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Candidate;
use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\IOFactory;

class CandidateController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function showUploadForm()
    {
        return view('Admin.addCandidatesForm');
    }
    public function index()
    {
        //
        $departments = Department::all();
        return view('Candidate.dashboard', compact('departments'));
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
    public function uploadForm(Request $request)
    {
        //
        $request->validate([
            'file' => 'required|file|mimes:xlsx,xls',
        ]);

        $file = $request->file('file');
        $spreadsheet = IOFactory::load($file->getPathname());
        $sheetdata = $spreadsheet->getActiveSheet()->toArray(null, true, true, true);

        foreach ($sheetdata as $index => $row) {
            if ($index == 1) {
                continue;
            }
            Candidate::create([
                'name' => $row['A'],
                'username' => $row['B'],
                'email' => $row['C'],
                'password' => $row['D'],
                'department' => $row['E'],
            ]);
        }
        return redirect()->back()->with('success', 'Candidates Data Uploaded');
    }

    /**
     * Display the specified resource.
     */
    public function show()
    {
        //
        $candidates = Candidate::all();
        return view('Admin.candidatesList', compact('candidates'));
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
