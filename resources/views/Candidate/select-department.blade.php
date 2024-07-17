@extends('Candidate.dashboardLayout')
@section('candidate_page_styles')
    <style>
        form .form-group {
            width: 50%;
        }
    </style>
@endsection

@section('candidate_page_content')
    <section class="col-9">
        <div class="container mt-5">
            <h3>Select Your Department</h3>
            <form action="{{ route('candidate.selectDepartment') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="department_id">Department</label>
                    <select name="department_id" id="department_id" class="form-control" required>
                        <option value="">Select Department</option>
                        @foreach ($departments as $department)
                            <option value="{{ $department->id }}">{{ $department->name }}</option>
                        @endforeach
                    </select>
                </div>
                <button type="submit" class="btn btn-success mt-3">Next</button>
            </form>
        </div>
    </section>
@endsection
