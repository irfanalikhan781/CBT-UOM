@extends('Admin.dashboardLayout')
@section('admin_styles')
    <style>
        form {
            width: 60%;
        }

        .total-number-of-mcqs label {
            color: #40A578;
        }
    </style>
@endsection
@section('admin_content')
    <section class="col-9">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        <form action="{{ route('tests.store') }}" method="post" class="form">
            @csrf
            <h5 class="mt-3">Create Test</h5>
            <div class="form-group">
                <label for="name">Test Name</label>
                <input type="text" name="name" id="name" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="department_id">Select Department</label>
                <select name="department_id" id="department_id" class="form-control" required>
                    <option value="">Select Department</option>
                    @foreach ($departments as $department)
                        <option value="{{ $department->id }}">{{ $department->name }}</option>
                    @endforeach
                </select>
            </div>

            <div id="courses-container" class="form-group mt-3">
                <!-- Courses will be dynamically populated based on selected department -->
            </div>

            <div class="form-group mt-3 total-number-of-mcqs">
                <label for="total_mcqs ">Total Number of MCQs</label>
                <input type="number" name="total_mcqs" id="total_mcqs" class="form-control" required>
            </div>

            <button type="submit" class="btn btn-danger my-2">Create Test</button>
        </form>
    </section>

    <script>
        document.getElementById('department_id').addEventListener('change', function() {
            const departmentId = this.value;
            const coursesContainer = document.getElementById('courses-container');
            coursesContainer.innerHTML = '';

            if (departmentId) {
                const department = @json($departments).find(d => d.id == departmentId);

                if (department && department.courses) {
                    department.courses.forEach(course => {
                        const courseElement = `
                            <div class="form-group mt-2">
                                <label for="course_mcqs_${course.id}">Number of MCQs for ${course.course_name}</label>
                                <input type="number" name="course_mcqs[${course.id}][mcq_count]" id="course_mcqs_${course.id}" class="form-control" min="1" value="">
                                <input type="hidden" name="course_mcqs[${course.id}][course_id]" value="${course.id}">
                            </div>
                        `;
                        coursesContainer.insertAdjacentHTML('beforeend', courseElement);
                    });
                }
            }
        });
    </script>
@endsection
