@extends('Admin.dashboardLayout')
@section('admin_styles')
    <style>
        .width-26 {
            width: 26rem;
            background-color: #DDE6ED;
        }

        form .add-btn {
            background-color: #BE3144;
            width: 6rem;
            color: white;
        }

        form .add-btn:hover {
            background-color: #ff9900;
        }
    </style>
@endsection
@section('admin_content')
    <section class="container col-9">
        <div class="width-26 border rounded mx-auto mt-4">
            <form method="POST" action="{{ route('admin.insert-course') }}" class="px-4">
                @csrf
                <div class="text-center mt-3">
                    <h5>
                        Add Course
                    </h5>
                    <label for="courseName">Enter Course Name</label>
                    <input type="text" id="courseName" name="courseName" class="form-control mb-2" required><br>
                    <div class="mb-2">
                        <select name="department_id">
                            @foreach ($departments as $department)
                                <option class="" value="{{ $department->id }}">{{ $department->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <button type="submit" class="btn add-btn">ADD</button>
                </div>
            </form>
        </div>
    </section>
@endsection
