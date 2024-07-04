@extends('Candidate.dashboardLayout')
@section('candidate_page_styles')
@endsection
@section('candidate_page_content')
    <section class="col-9">
        <div class="container mt-3">
            <ul>
                <li>
                    <p>We hope you have learned how to attemp the test while attempting the demo test.</br>Get ready for the
                        actual
                        test.</p>
                </li>
            </ul>
            <p><span>
                    <h6>Note:</h6>
                </span>On Clicking the 'Start Test' button the actual test will start and timer will be on.
                </br>
                So click the button 'Start Test' when you are ready.
            </p>
            <div>
                <a href="{{ route('candidate.startTest', ['department_id' => $departmentId]) }}"><button type="button"
                        class="btn btn-success">Start
                        Test</button></a>
            </div>
        </div>
    </section>
@endsection
