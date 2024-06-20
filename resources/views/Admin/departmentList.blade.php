@extends('Admin.dashboardLayout')
@section('admin_styles')
    <style>
        .deptts-heading h5 {
            width: 260px;
            background-color: #ff9900;
            color: white;
            border-radius: 10px;
        }

        .deptt-name {
            margin-bottom: 40px;
        }

        .deptt-name h5 {
            background-color: #DDE6ED;
            width: 600px;
            border-radius: 10px;
        }

        .deptt-name .programs {
            display: flex;
        }

        .deptt-name .programs p {
            background-color: aqua;
            border-radius: 12px;
        }
    </style>
@endsection
@section('admin_content')
    <section class="col-9">
        <div class="deptts-heading ms-3 mt-3 mb-3">
            <h5 class="px-3 pt-2 pb-2">DEPARTMENTS LIST</h5>
        </div>
        @foreach ($departments as $department)
            <div class="deptt-name ms-3 mb-2">
                <h5 class="px-3 py-2">{{ $department->name }}</h5>
                <div class="programs">
                    <h6 class="ps-2">Programs:</h6>
                    @foreach ($department->programs as $program)
                        <p class="px-2 mx-2">{{ $program->name }}</p>
                    @endforeach
                </div>
            </div>
        @endforeach
    </section>
@endsection
