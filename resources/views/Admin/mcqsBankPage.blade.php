@extends('Admin.dashboardLayout')
@section('admin_styles')
    <style>
        .page-title {
            background-color: #EEEEEE;
            width: 11rem;
            color: #028391;
            border-radius: 10px;
        }
    </style>
@endsection
@section('admin_content')
    <section class="col-9">
        <div class="page-title mt-3 ps-4 pt-2 pb-1">
            <h4>MCQs Bank</h4>
        </div>
        <div class="mt-2">
            <form action="" method="GET">
                @csrf
                <div class="row">
                    <div class="col-8">
                        <select name="department_id" class="form-select">
                            <option value="">Select Department</option>
                            @foreach ($departments as $department)
                                <option value="{{ $department->id }}">{{ $department->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-4">
                        <button type="submit" class="btn btn-success">Filter MCQs</button>
                    </div>
                </div>
            </form>
        </div>
        <div>
            <table class="table table-striped">
                <thead class="table-primary">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Question</th>
                        <th scope="col">Option 1</th>
                        <th scope="col">Option 2</th>
                        <th scope="col">Option 3</th>
                        <th scope="col">Option 4</th>
                        <th scope="col">Answer</th>
                        <th scope="col">Course</th>
                        <th scope="col">Department</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($mcqs as $index => $mcq)
                        <tr>
                            <th scope="row">{{ $index + 1 }}</th>
                            <td>{{ $mcq->question }}</td>
                            <td>{{ $mcq->option1 }}</td>
                            <td>{{ $mcq->option2 }}</td>
                            <td>{{ $mcq->option3 }}</td>
                            <td>{{ $mcq->option4 }}</td>
                            <td>{{ $mcq->answer }}</td>
                            <td>{{ $mcq->course ? $mcq->course->course_name : 'N/A' }}</td>
                            <td>{{ $mcq->department ? $mcq->department->name : 'N/A' }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

    </section>
@endsection
