@extends('Candidate.dashboardLayout')
@section('candidate_page_styles')
@endsection
@section('candidate_page_content')
    <section class="col-9">
        <div class="container mt-5">
            <h3>Test Instructions</h3>
            <ul>
                <li>Read all questions carefully.</li>
                <li>Each question has one correct answer.</li>
                <li>Ensure you complete the test within the given time.</li>
                <li><b>Once you start the test, you can not back it or refresh it until you submit the test or test time is
                        out.</b></li>
                <!-- Add more instructions as needed -->
            </ul>
            <form action="{{ route('candidate.startTest', ['test_id' => $test->id]) }}" method="GET">
                @csrf
                <button type="submit" class="btn btn-danger mt-3">Start Test</button>
            </form>
        </div>
    </section>
@endsection
