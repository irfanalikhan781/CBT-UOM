@extends('Admin.dashboardLayout')
@section('admin_styles')
    <style>
        .courses-heading h5 {
            width: 260px;
            background-color: #ff9900;
            color: white;
            border-radius: 10px;
        }

        .course-name {
            background-color: #DDE6ED;
            width: 600px;
            border-radius: 10px;
        }
    </style>
@endsection
@section('admin_content')
    <section class="col-9">
        <div class="courses-heading ms-3 mt-3 mb-3">
            <h5 class="px-3 pt-2 pb-2">COURSES LIST</h5>
        </div>
        @foreach ($courses as $course)
            <div class="course-name d-flex ms-3 mb-2">
                <h5 class="px-3 py-2"> {{ $course->course_name }}</h5>
                <p class="pt-2 ps-5">{{ $course->department->name }}</p>
            </div>
        @endforeach
    </section>
@endsection
