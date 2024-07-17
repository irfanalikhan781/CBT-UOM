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
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Writer\Pdf\Mpdf as PdfWriter;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Fill;


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
        $results = Result::with(['candidate', 'department', 'test'])
            ->get();
        return view('Admin.results', compact('results'));
    }

    // Exprorting results Method
    public function exportResults(Request $request)
    {
        $request->validate([
            'test_name' => 'required|string',
            'export_type' => 'required|string|in:excel,pdf'
        ]);

        $testName = $request->input('test_name');
        $exportType = $request->input('export_type');

        // Fetch the test by name
        $test = Test::where('name', $testName)->first();
        if (!$test) {
            return redirect()->back()->with('error', 'Test not found.');
        }

        // Fetch the results for the specified test
        $results = Result::where('test_id', $test->id)->get();

        // Create a new spreadsheet
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Set column widths
        $sheet->getColumnDimension('A')->setWidth(10);
        $sheet->getColumnDimension('B')->setWidth(15);
        $sheet->getColumnDimension('C')->setWidth(25);
        $sheet->getColumnDimension('D')->setWidth(25);
        $sheet->getColumnDimension('E')->setWidth(20);
        $sheet->getColumnDimension('F')->setWidth(20);
        $sheet->getColumnDimension('G')->setWidth(10);

        // Set the headers
        $headers = ['S.No', 'Candidate ID', 'Candidate Name', 'Candidate Username', 'Department', 'Test Name', 'Score'];
        $headerCells = ['A1', 'B1', 'C1', 'D1', 'E1', 'F1', 'G1'];


        foreach ($headerCells as $index => $cell) {
            $sheet->setCellValue($cell, $headers[$index]);
            $sheet->getStyle($cell)->getFont()->setBold(true);
            $sheet->getStyle($cell)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
            $sheet->getStyle($cell)->getBorders()->getAllBorders()->setBorderStyle(Border::BORDER_THIN);
            $sheet->getStyle($cell)->getFill()->setFillType(Fill::FILL_SOLID)->getStartColor()->setARGB('FFFFE0');
        }

        // Populate the data
        $row = 2;
        $index = 1;
        foreach ($results as $result) {
            $sheet->setCellValue('A' . $row, $index++);
            $sheet->setCellValue('B' . $row, $result->candidate_id);
            $sheet->setCellValue('C' . $row, $result->candidate_name);
            $sheet->setCellValue('D' . $row, $result->candidate_username);
            $sheet->setCellValue('E' . $row, $result->department->name);
            $sheet->setCellValue('F' . $row, $testName);
            $sheet->setCellValue('G' . $row, $result->score);

            // Apply styles to data cells
            foreach (range('A', 'G') as $col) {
                $cell = $col . $row;
                $sheet->getStyle($cell)->getBorders()->getAllBorders()->setBorderStyle(Border::BORDER_THIN);
                $sheet->getStyle($cell)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
            }

            $row++;
        }

        if ($exportType === 'excel') {
            $writer = new Xlsx($spreadsheet);
            $fileName = $testName . '_results.xlsx';
            $filePath = storage_path('app/public/' . $fileName);
            $writer->save($filePath);
        } else {
            $class = PdfWriter::class;
            $writer = new $class($spreadsheet);
            $writer->setUseInlineCss(true); // Ensure CSS is applied correctly
            $fileName = $testName . '_results.pdf';
            $filePath = storage_path('app/public/' . $fileName);
            $writer->save($filePath);
        }

        return response()->download($filePath)->deleteFileAfterSend(true);
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
