<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Department;
use App\Models\Course;
use App\Models\Mcq;

class McqsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

        $format = $request->get('format', 'department'); // Default format
        $departments = Department::all();
        // $courses = Department::with('courses')->get()->keyBy('id');

        $mcqs = [];

        if ($format === 'department') {
            $selectedDepartmentId = $request->get('department_id');
            if ($selectedDepartmentId) {
                $mcqs = Mcq::where('department_id', $selectedDepartmentId)->get();
            }




        } else
            $mcqs = Mcq::all();

        return view('Admin.mcqsBank', compact('format', 'departments', 'mcqs', ));
    }


    public function switchFormat(Request $request)
    {
        $newFormat = $request->get('format');
        return redirect()->route('mcqs.index', ['format' => $newFormat]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $departments = Department::all();
        $courses = Course::all();
        return view('Admin.addMcqs', compact('departments', 'courses'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the uploaded file and department selection
        $request->validate([
            'mcqs_file' => 'required|mimes:csv,txt|max:10240', // Adjust maximum file size as needed
            'department_id' => 'required|exists:departments,id',
            'course_id' => 'requied|exists:course,id'
        ]);

        // Extract department ID and uploaded file from the request
        $departmentId = $request->input('department_id');
        $courseId = $request->input('course_id');
        $file = $request->file('mcqs_file');

        // Process the uploaded file
        if ($file->isValid()) {
            // Parse the file and extract MCQ data
            $mcqsData = $this->parseFile($file);

            // Insert MCQs into the database
            foreach ($mcqsData as $mcqData) {
                // Find or create course based on the department
                $course = Course::firstOrCreate([
                    'department_id' => $departmentId,
                    'name' => $mcqData['course_name'], // Assuming the course name is included in MCQs file
                ]);

                // Insert MCQ into the database
                Mcq::create([
                    'question' => $mcqData['question'],
                    'answer' => $mcqData['answer'],
                    'options' => json_encode($mcqData['options']),
                    'course_id' => $course->id,
                    'department_id' => $departmentId,
                    // Add more fields as necessary
                ]);
            }

            // Redirect back with success message
            return redirect()->back()->with('success', 'MCQs uploaded successfully!');
        } else {
            // Redirect back with error message if file is invalid
            return redirect()->back()->with('error', 'Invalid file uploaded!');
        }
    }

    // Method to parse the uploaded file and extract MCQ data
    private function parseFile($file)
    {
        $mcqsData = [];
        $lines = file($file);
        foreach ($lines as $line) {
            // Split the line into question, options, answer, and course name
            $data = str_getcsv($line);

            // Extract options and remove empty elements
            $options = array_filter(array_slice($data, 1, 4)); // Assuming options are at index 1 to 4

            // Extract question, options, answer, and course name
            $question = $data[0];
            $options = explode(',', $data[1]); // Assuming options are at index 1
            $answer = $data[2]; // Assuming answer is at index 2
            $courseName = $data[3]; // Assuming course name is at index 3

            // Add MCQ data to the array
            $mcqsData[] = [
                'question' => $question,
                'options' => $options,
                'answer' => $answer,
                'course_name' => $courseName,
            ];
        }
        return $mcqsData;
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
