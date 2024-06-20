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
        <div>
            <h4>The test has started. Keep attempting the questions</h4>
        </div>
        <div class="mcq-container ms-3">
            @for ($i = 1; $i <= 100; $i++)
                <div class="mcq mb-3">
                    <p>Question {{ $i }}</p>
                    <ul class="list-group list-group-numbered">
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

            <button class="btn btn-danger mt-3" id="finishTest">Finish Test</button>
        </div>
        </div>
    </section>
@endsection
