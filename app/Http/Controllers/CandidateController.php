<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Candidate;
use App\Models\Test;
use App\Models\Result;
use App\Models\McqsBank;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use PhpOffice\PhpSpreadsheet\IOFactory;
use Illuminate\Support\Facades\Auth;
use Illuminate\Pagination\LengthAwarePaginator;

class CandidateController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function showUploadForm()
    {
        return view('Admin.addCandidatesForm');
    }
    public function dashboard()
    {
        //
        $candidate = Auth::guard('candidate')->user();
        // $departmentsWithTests = Department::whereHas('tests')->get();
        return view('Candidate.dashboard', compact('candidate'));
    }

    public function startDemo(Request $request)
    {
        $demoMcqs = $this->getStaticDemoMcqs();

        return view('candidate.demo-test', compact('demoMcqs'));
    }

    public function submitDemo(Request $request)
    {
        $departmentId = $request->input('department_id');
        return view('Candidate.pre-test-page', compact('departmentId'));
    }

    private function getStaticDemoMcqs()
    {
        return [
            [
                'question' => 'What is the capital of France?',
                'options' => ['Paris', 'London', 'Berlin', 'Madrid'],
                'answer' => 'Paris',
            ],
            [
                'question' => 'Which planet is known as the Red Planet?',
                'options' => ['Earth', 'Mars', 'Jupiter', 'Saturn'],
                'answer' => 'Mars',
            ],
            [
                'question' => 'What is the largest ocean on Earth?',
                'options' => ['Atlantic Ocean', 'Indian Ocean', 'Arctic Ocean', 'Pacific Ocean'],
                'answer' => 'Pacific Ocean',
            ],
            [
                'question' => 'Who wrote "To Kill a Mockingbird"?',
                'options' => ['Harper Lee', 'Mark Twain', 'Ernest Hemingway', 'F. Scott Fitzgerald'],
                'answer' => 'Harper Lee',
            ],
            [
                'question' => 'What is the smallest unit of life?',
                'options' => ['Cell', 'Atom', 'Molecule', 'Organism'],
                'answer' => 'Cell',
            ],
            [
                'question' => 'Which element has the chemical symbol O?',
                'options' => ['Gold', 'Oxygen', 'Silver', 'Iron'],
                'answer' => 'Oxygen',
            ],
            [
                'question' => 'What is the square root of 64?',
                'options' => ['6', '7', '8', '9'],
                'answer' => '8',
            ],
            [
                'question' => 'Who painted the Mona Lisa?',
                'options' => ['Vincent van Gogh', 'Pablo Picasso', 'Leonardo da Vinci', 'Michelangelo'],
                'answer' => 'Leonardo da Vinci',
            ],
            [
                'question' => 'What is the chemical formula for water?',
                'options' => ['H2O', 'O2', 'CO2', 'H2SO4'],
                'answer' => 'H2O',
            ],
            [
                'question' => 'Which planet is closest to the Sun?',
                'options' => ['Venus', 'Mars', 'Mercury', 'Jupiter'],
                'answer' => 'Mercury',
            ],
        ];
    }

    public function departmentSelectionPage()
    {
        $departments = Department::whereHas('tests')->get();
        return view('Candidate.select-department', compact('departments'));
    }
    public function selectDepartment(Request $request)
    {
        $request->validate([
            'department_id' => 'required|exists:departments,id',
        ]);

        $departmentId = $request->department_id;
        $test = Test::where('department_id', $departmentId)->first();

        if (!$test) {
            return redirect()->route('candidate.dashboard')->with('error', 'No test found for the selected department.');
        }

        return redirect()->route('candidate.preTest', ['test_id' => $test->id]);
    }

    public function preTest($test_id)
    {

        $test = Test::findOrFail($test_id);
        return view('Candidate.pre-test-page', compact('test'));
    }

    public function startTest($test_id)
    {
        $test = Test::findOrFail($test_id);
        $mcqs = $test->mcqs()->get();

        // Ensure only the number of MCQs specified in the test is fetched
        if ($mcqs->count() > $test->total_mcqs) {
            $mcqs = $mcqs->random($test->total_mcqs);
        }

        return view('Candidate.test', compact('test', 'mcqs'));
    }
    // public function startTest($test_id)
    // {
    //     $test = Test::findOrFail($test_id);
    //     $mcqs = $test->mcqs()->get();
    //     return view('Candidate.test', compact('test', 'mcqs'));
    // }

    // public function startTest(Request $request, $department_id)
    // {
    //     $candidate = auth()->user();
    //     $department = Department::findOrFail($department_id);
    //     $test = $department->tests()->first();
    //     if (!$test) {
    //         \Log::error('No test available for department ID: ' . $department_id);
    //         return redirect()->back()->with('error', 'No test available for this department.');
    //     }

    //     if (Result::where('candidate_id', $candidate->id)->exists()) {
    //         \Log::info('Candidate ID: ' . $candidate->id . ' has already taken Test ID: ' . $test->id);
    //         return redirect()->back()->with('error', 'You have already taken this test.');
    //     }

    //     // Fetch the test's MCQs
    //     $mcqs = $test->mcqs()->inRandomOrder()->get();

    //     if ($mcqs->isEmpty()) {
    //         \Log::error('No MCQs found for Test ID: ' . $test->id);
    //     } else {
    //         \Log::info('MCQs fetched for Test ID: ' . $test->id);
    //     }

    //     // Paginate the MCQs
    //     $currentPage = LengthAwarePaginator::resolveCurrentPage();
    //     $perPage = 10;
    //     $currentItems = $mcqs->slice(($currentPage - 1) * $perPage, $perPage);
    //     $paginatedMcqs = new LengthAwarePaginator($currentItems, $mcqs->count(), $perPage, $currentPage, [
    //         'path' => LengthAwarePaginator::resolveCurrentPath(),
    //     ]);

    //     return view('candidate.test', compact('test', 'paginatedMcqs', 'candidate'));
    // }




    public function showTest(Request $request)
    {
        $candidate = Auth::guard('candidate')->user();
        $test = Test::where('department_id', $request->department_id)->where('is_demo', false)->first();

        if (!$test) {
            return redirect()->route('candidate.dashboard')->with('error', 'No test available for your department.');
        }

        $mcqs = $test->mcqs()->inRandomOrder()->get();
        return view('candidate.test', compact('test', 'mcqs'));
    }

    public function submitTest(Request $request, $test_id)
    {
        // Find the test and its associated MCQs
        $test = Test::findOrFail($test_id);
        $mcqs = $test->mcqs()->get();
        $answers = $request->input('answers');

        // Calculate the candidate's score
        $score = 0;
        foreach ($mcqs as $mcq) {
            if (isset($answers[$mcq->id])) {
                $selectedOption = $answers[$mcq->id];
                // Map the selected option to 'A', 'B', 'C', 'D'
                $optionMap = [
                    'option1' => 'A',
                    'option2' => 'B',
                    'option3' => 'C',
                    'option4' => 'D',
                ];
                if ($optionMap[$selectedOption] == $mcq->answer) {
                    $score++;
                }
            }
        }

        // Get the authenticated candidate
        $candidate = Auth::guard('candidate')->user();

        // Check if the result already exists for the candidate and test
        $result = Result::where('candidate_id', $candidate->id)
            ->where('test_id', $test_id)
            ->first();

        if ($result) {
            // Update the existing result
            $result->update([
                'score' => $score,
            ]);
        } else {
            // Create a new result
            Result::create([
                'candidate_id' => $candidate->id,
                'candidate_name' => $candidate->name,
                'candidate_username' => $candidate->username,
                'department_id' => $test->department_id,
                'test_id' => $test->id,
                'score' => $score,
            ]);
        }

        // Determine the submission type
        $submission_type = $request->input('submission_type', 'manual'); // Default to 'manual' if not provided

        // Clear the session data related to the test
        $request->session()->forget('test_data');

        // Return the test-submitted view with the submission type and score
        return view('Candidate.test-submitted', compact('submission_type', 'score'));
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
            $password = $row['D'];
            $hashedpassword = Hash::make($password);
            Candidate::create([
                'name' => $row['A'],
                'username' => $row['B'],
                'email' => $row['C'],
                'password' => $hashedpassword,
                'department' => $row['E'],
            ]);
        }
        return redirect()->route('show-candidates-list')->with('success', 'Candidates Data Uploaded');
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
