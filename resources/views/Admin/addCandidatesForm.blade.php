@extends('Admin.dashboardLayout')
@section('admin_styles')
    <style>
        .upload-candidates-form form {
            width: 50%;
        }
    </style>
@endsection
@section('admin_content')
    <section class="col-9">
        <div class="upload-candidates-form">
            <form action="{{ route('upload-candidates-form') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mt-3">
                    <h5>Upload candidates excel file</h5>
                </div>
                <label for="candidatesFile">Select File</label>
                <input type="file" id="cadidatesFile" name="file" class="form-control" required>
                <button type="submit" class="btn btn-success mt-2">Submit</button>
            </form>
        </div>

    </section>
@endsection
