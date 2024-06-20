@extends('Admin.dashboardLayout')
@section('admin_styles')
    <style>
        .col-9 form {
            width: 60%;
        }
    </style>
@endsection
@section('admin_content')
    <section class="col-9">
        <!-- upload.blade.php -->
        <form action="{{ route('upload-mcqs-file') }}" method="post" enctype="multipart/form-data" class="form">
            @csrf
            <h5 class="mt-3">Upload MCQs File</h5>
            <input type="file" name="mcqs_file" class="form-control my-2">
            <div class="row">
                <div class="col-5">
                    <select name="department_id" class="form-select" id="department">
                        <option value="">Select Department</option>
                        @foreach ($departments as $department)
                            <option value="{{ $department->id }}">{{ $department->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-5">
                </div>
            </div>

            <button type="submit" class="btn btn-success my-2">Upload</button>
        </form>

    </section>
@endsection
