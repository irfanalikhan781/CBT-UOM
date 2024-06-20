@extends('Candidate.dashboardLayout')
@section('candidate_page_styles')
    <style>
        .hero-title {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin-top: 5rem;
        }

        .hero-title h1 {
            color: #4CCD99;
        }

        .hero-title h3 {
            color: #496989;
        }

        .instructions {
            margin-top: 3rem;
        }

        .departments-dropdown {
            width: 20rem;
            border: solid seagreen 2px;
            border-radius: 8px
        }

        select .form-select {
            background-color: seagreen;
        }
    </style>
@endsection
@section('candidate_page_content')
    <section class="col-9">
        <div class="row ms-4">
            <div class="col-8">
                <div class="hero-title">
                    <h1>Welcome </h1>
                    <h3>Computer Based Test UOM</h3>
                </div>
            </div>
            <div class="col-6 instructions">
                <h5><u>Instructions:</u></h5>
                <ul>
                    <li>Do not try to use Cheating materials, if caught, your test will be cancelled</li>
                    <li>Do not open other tabs, otherwise you will face penalty</li>
                    <li>Select your department carefully. if you select wrong department, you test will be considered not
                        attempted</li>
                </ul>
            </div>
            <div class="dropdown mt-2">
                <div class="departments-dropdown">
                    <select class="form-select" aria-label="Default select example" name="department_id">
                        <option selected>Select Department</option>
                        @foreach ($departments as $department)
                            <option class="" value="{{ $department->id }}">{{ $department->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>


    </section>
@endsection
