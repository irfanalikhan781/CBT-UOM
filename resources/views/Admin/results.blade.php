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

        .export-button {
            padding: 10px 20px;
            border: none;
            background-color: #008CBA;
            color: white;
            border-radius: 4px;
            cursor: pointer;
        }

        .export-button:hover {
            background-color: #007B9E;
        }

        /* Modal styles */
        .modal {
            display: none;
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgb(0, 0, 0);
            background-color: rgba(0, 0, 0, 0.4);
            padding-top: 60px;
        }

        .modal-content {
            background-color: #fefefe;
            margin: 5% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 80%;
            max-width: 500px;
            border-radius: 8px;
        }

        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }

        .close:hover,
        .close:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }

        .modal form {
            display: flex;
            flex-direction: column;
        }

        .modal form label,
        .modal form input,
        .modal form select,
        .modal form button {
            margin-bottom: 15px;
        }

        .modal form button {
            background-color: #4CAF50;
            color: white;
            padding: 10px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .modal form button:hover {
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
                <input type="text" name="username" placeholder="Search by Candidate Name">
                <button type="submit">Search</button>
            </form>
            <button class="export-button" onclick="showExportModal()">Export Results</button>
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
                        <td>{{ $result->test->name }}</td>
                        <td>{{ $result->score }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

    </section>
    <!-- Export Modal -->
    <div id="exportModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeExportModal()">&times;</span>
            <form action="{{ route('admin.exportResults') }}" method="POST">
                @csrf
                <label for="test_name">Test Name:</label>
                <input type="text" id="test_name" name="test_name" required>

                <label for="export_type">Export Type:</label>
                <select id="export_type" name="export_type" required>
                    <option value="excel">Excel</option>
                    <option value="pdf">PDF</option>
                </select>

                <button type="submit">Export</button>
            </form>
        </div>
    </div>

    <script>
        function showExportModal() {
            document.getElementById('exportModal').style.display = 'block';
        }

        function closeExportModal() {
            document.getElementById('exportModal').style.display = 'none';
        }

        // Close the modal when clicking outside of it
        window.onclick = function(event) {
            if (event.target == document.getElementById('exportModal')) {
                document.getElementById('exportModal').style.display = 'none';
            }
        }
    </script>
@endsection
