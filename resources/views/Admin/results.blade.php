@extends('Admin.dashboardLayout')

@section('admin_styles')
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }

        table,
        th,
        td {
            border: 1px solid black;
        }

        th,
        td {
            padding: 15px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        .search-container {
            margin-bottom: 20px;
        }

        .search-container input[type="text"] {
            padding: 10px;
            margin-right: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        .search-container button {
            padding: 10px 20px;
            border: none;
            background-color: #4CAF50;
            color: white;
            border-radius: 4px;
            cursor: pointer;
        }

        .search-container button:hover {
            background-color: #45a049;
        }
    </style>
@endsection

@section('admin_content')
    <section class="col-9">
        <h2>Test Results</h2>

        <div class="search-container">
            <form action="{{ route('admin.searchResults') }}" method="GET">
                @csrf
                <input type="text" name="username" placeholder="Search by Candidate Username">
                <button type="submit">Search</button>
            </form>
        </div>

        <table>
            <thead>
                <tr>
                    <th>#</th>
                    <th>Candidate ID</th>
                    <th>Candidate Name</th>
                    <th>Candidate Username</th>
                    <th>Department</th>
                    <th>Test Name</th>
                    <th>Score</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($results as $index => $result)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $result->candidate_id }}</td>
                        <td>{{ $result->candidate_name }}</td>
                        <td>{{ $result->candidate_username }}</td>
                        <td>{{ $result->department->name }}</td>
                        <td>{{ $result->test_name }}</td>
                        <td>{{ $result->score }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </section>
@endsection
