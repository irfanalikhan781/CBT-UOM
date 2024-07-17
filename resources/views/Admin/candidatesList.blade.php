@extends('Admin.dashboardLayout')
@section('admin_styles')
    <style>
        .table {
            width: 100%;
            table-layout: fixed;
        }

        .table th,
        .table td {
            word-wrap: break-word;
            white-space: normal;
        }
    </style>
@endsection
@section('admin_content')
    <section class="col-9">
        <div class="container">
            <div class="mt-4">
                <h5>List of All Candidates</h5>
            </div>
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead class="table-primary">
                        <tr>
                            <th scope="col">#</th>
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
                                <td>{{ $candidate->name }}</td>
                                <td>{{ $candidate->username }}</td>
                                <td>{{ $candidate->email }}</td>
                                <td>{{ $candidate->password }}</td>
                                <td>{{ $candidate->department }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </section>
@endsection
