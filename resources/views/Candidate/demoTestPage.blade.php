@extends('Candidate.dashboardLayout')

@section('candidate_page_styles')
    <style>
        .mcq-container {
            width: 95%;
        }
    </style>
@endsection

@section('candidate_page_content')
    <section class="col-9">
        <div class="mt-3 ms-3">
            <h5>Instructions for Attempting the test!</h5>
            <ul>
                <li>This is a demo test to help you learn the method of attempting the actual test.</li>
                <li>Select the answer you think is correct for each question.</li>
                <li>Click the "Confirm" button to confirm your answer for each question.</li>
                <li>Use the "Start Test" button to begin and "Finish Test" button to submit your demo test (no marks will be
                    awarded for this demo).</li>
            </ul>
        </div>

        <div id="demoTest" class="hidden">
            <button class="btn btn-success mb-3 ms-3" id="startTest">Start Test</button>

            <h5 class="mb-3 ms-3">Demo Test - MCQs (10 Questions)</h5>

            <div class="mcq-container ms-3">
                @for ($i = 1; $i <= 10; $i++)
                    <div class="mcq mb-3">
                        <p>Question {{ $i }}</p>
                        <ul class="list-group">
                            <li class="list-group-item">
                                <input type="radio" name="question_{{ $i }}" id="answer{{ $i }}_1"
                                    value="1">
                                <label for="answer{{ $i }}_1">Option 1 (Dummy content)</label>
                            </li>
                            <li class="list-group-item">
                                <input type="radio" name="question_{{ $i }}" id="answer{{ $i }}_2"
                                    value="2">
                                <label for="answer{{ $i }}_2">Option 2 (Dummy content)</label>
                            </li>
                            <li class="list-group-item">
                                <input type="radio" name="question_{{ $i }}" id="answer{{ $i }}_3"
                                    value="3">
                                <label for="answer{{ $i }}_3">Option 3 (Dummy content)</label>
                            </li>
                            <li class="list-group-item">
                                <input type="radio" name="question_{{ $i }}" id="answer{{ $i }}_4"
                                    value="4">
                                <label for="answer{{ $i }}_4">Option 4 (Dummy content)</label>
                            </li>
                        </ul>
                        <button class="btn btn-sm btn-outline-primary confirm-btn mt-2"
                            data-question="{{ $i }}">Confirm</button>
                    </div>
                @endfor
            </div>

            <button class="btn btn-danger mt-3 ms-3" id="finishTest">Finish Test</button>
        </div>

        <div class="mcq-counter">


        </div>

    </section>

    <script></script>
@endsection
