<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\McqsBank;
use App\Models\Course;
use App\Models\Department;
use PhpOffice\PhpSpreadsheet\IOFactory;

class McqsBankController extends Controller
{
    //
    public function index(Request $request)
    {
        $departments = Department::all();
        $departmentId = $request->input('department_id');

        if ($departmentId) {
            $mcqs = McqsBank::where('department_id', $departmentId)->get();
        } else {
            $mcqs = McqsBank::with('courses', 'departments')->get();
        }
        return view('Admin.mcqsBankPage', compact('departments', 'mcqs'));
    }
    public function create()
    {
        $departments = Department::all();
        return view('Admin.addMcqsFile', compact('departments'));
    }

    public function upload(Request $request)
    {
        $request->validate([
            'mcqs_file' => 'required|file|mimes:xlsx, xls',
            'department_id' => 'required|exists:departments,id',
        ]);
        $departmentId = $request->input('department_id');
        $file = $request->file('mcqs_file');
        $spreadsheet = IOFactory::load($file->getPathname());
        $sheetData = $spreadsheet->getActiveSheet()->toArray(null, true, true, true);

        foreach ($sheetData as $index => $row) {
            if ($index == 1) {
                continue;
            }

            $courseName = $row['G'];
            $course = Course::where('course_name', $courseName)->first();
            if ($course) {
                McqsBank::create([
                    'question' => $row['A'],   // Assuming question is in column A
                    'option1' => $row['B'],    // Assuming option1 is in column B
                    'option2' => $row['C'],    // Assuming option2 is in column C
                    'option3' => $row['D'],    // Assuming option3 is in column D
                    'option4' => $row['E'],    // Assuming option4 is in column E
                    'answer' => $row['F'],     // Assuming answer is in column F
                    'course_id' => $course->id,
                    'department_id' => $departmentId,
                ]);
            }
        }
        return redirect()->back()->with('success', 'MCQs uploaded successfully.');
    }
}
