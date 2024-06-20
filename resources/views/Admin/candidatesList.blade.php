@extends('Admin.dashboardLayout')
@section('admin_styles')
@endsection
@section('admin_content')
    <section class="col-9">
        <div class="mt-4">
            <h5>List of All Candidates</h5>
        </div>
        <div>
            <table class="table table-striped">
                <thead class="table-primary">
                    <tr>
                        <th scope="col"># </th>
                        <th scope="col">Name</th>
                        <th scope="col">Username</th>
                        <th scope="col">Email</th>
                        <th scope="col">Password</th>
                        <th scope="col">Department</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($candidates as $candidate)
                        <tr>
                            <th scope="row">{{ $loop->iteration }}</th>
                            <th>{{ $candidate->name }}</th>
                            <th>{{ $candidate->username }}</th>
                            <th>{{ $candidate->email }}</th>
                            <th>{{ $candidate->password }}</th>
                            <th>{{ $candidate->department }}</th>
                        </tr>
                    @endforeach

                </tbody>
            </table>
        </div>
    </section>
@endsection
