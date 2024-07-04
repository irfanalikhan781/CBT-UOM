@extends('Admin.dashboardLayout')
@section('admin_styles')
@endsection

@section('admin_content')
    <section class="col-9">
        <div class="container mt-4">
            <h5>Departments with Prepared Tests</h5>
            <table class="table table-striped">
                <thead class="table-primary">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Department Name</th>
                        <th scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($departmentsWithTests as $departmentId => $tests)
                        <tr>
                            <th scope="row">{{ $loop->iteration }}</th>
                            <td>{{ $tests->first()->department->name }}</td>
                            <td>
                                <form id="deleteForm{{ $tests->first()->id }}"
                                    action="{{ route('tests.destroy', $tests->first()->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger delete-btn">
                                        Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

    </section>
@endsection
