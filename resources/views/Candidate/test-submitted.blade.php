@extends('Candidate.dashboardLayout')

@section('candidate_page_styles')
    <style>
        .text-area {
            background-color: #91DDCF;
            margin: 20px 40px;
            padding: 20px;
            border-radius: 10px
        }

        .button {
            margin-left: 40px;
        }

        .button .btn a {
            text-decoration: none;
            color: white;

        }
    </style>
@endsection

@section('candidate_page_content')
    <section class="col-9">
        <div class="container mt-5">
            <div class="text-area">
                @if ($submission_type === 'manual')
                    <h3>Thank you, the test has been submitted successfully.</h3>
                @else
                    <h3>Sorry, the test time is up and the test has been submitted.</h3>
                @endif
            </div>
            <div class="button">
                <button class="btn btn-success">
                    <a href="{{ route('candidate.logout') }}">Return Home</a>
                </button>
            </div>
        </div>
    </section>
@endsection
