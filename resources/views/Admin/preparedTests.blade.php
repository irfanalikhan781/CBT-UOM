@extends('Admin.dashboardLayout')
@section('admin_styles')
@endsection

@section('admin_content')
    <section class="col-9">
        <h5 class="mt-3">Prepared Tests</h5>

        @if ($tests->isEmpty())
            <div class="alert alert-info">
                No tests have been prepared yet.
            </div>
        @else
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Test Name</th>
                        <th>Department</th>
                        <th>Admin</th>
                        <th>Total MCQs</th>
                        <th>Duration (minutes)</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($tests as $test)
                        <tr>
                            <td>{{ $test->name }}</td>
                            <td>{{ $test->department->name }}</td>
                            <td>{{ $test->admins->name }}</td>
                            <td>{{ $test->total_mcqs }}</td>
                            <td>{{ $test->duration }}</td>
                            <td>
                                <form action="{{ route('tests.destroy', $test->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </section>
@endsection
