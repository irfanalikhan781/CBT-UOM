@extends('Candidate.dashboardLayout')
@section('candidate_page_styles')
    <style>
        .hero-title {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin-top: 2rem;
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

        .buttons {
            display: flex;
        }

        form {
            /* width: 50%; */
        }

        select .form-select {
            background-color: seagreen;
        }

        .skip-button a {
            text-decoration: none;
            color: white;
        }
    </style>
@endsection
@section('candidate_page_content')
    <section class="col-9">
        <div class="row ms-4">
            <div class="col-8">
                <div class="hero-title">
                    <h1>Welcome </h1>
                    <h2>{{ $candidate->name }}</h2>
                    <h3>to Computer Based Test UOM</h3>
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
            <div class="buttons">
                <form action="{{ route('candidate.start-demo') }}" method="POST">
                    @csrf
                    {{-- <div class="form-group">
                        <label for="department" class="mb-2">Select Your Department</label>
                        <select name="department_id" id="department" class="form-select" required>
                            <option value="">Select Department</option>
                            @foreach ($departmentsWithTests as $department)
                                <option value="{{ $department->id }}">{{ $department->name }}</option>
                            @endforeach
                        </select>
                    </div> --}}
                    <button type="submit" class="btn btn-success mt-3">Start Demo Test</button>
                </form>
                <div class="skip-button mt-3 mx-3">
                    <button type="button" class="btn btn-info"><a href="{{ route('department-selection-page') }}">Skip Demo
                            Test</a></button>
                </div>
            </div>
        </div>


    </section>
@endsection
