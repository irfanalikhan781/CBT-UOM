@extends('MainLayout')
@section('styles')
    <style>
        .form {
            width: 40%;
            margin: 40px auto;
            border: 1px solid #ccc;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-control {
            border: 1px solid #aaa;
            border-radius: 5px;
            padding: 10px;
        }

        .btn {}

        .btn-success {
            background-color: #4CAF50;
            color: #fff;
            border: none;
            border-radius: 5px;
            padding: 10px 20px;
            cursor: pointer;

        }

        .btn-success:hover {
            background-color: #3e8e41;
        }
    </style>
@endsection
@section('content')
    <section class="mt-4">
        <h3 style="color: #333; font-weight: bold; text-align: center;">Candidate Login</h3>
        <form action="{{ route('candidate.login') }}" method="POST" class="form">
            @csrf
            <div class="form-group">
                <label for="username" style="color: #666;">Username</label>
                <input type="text" name="username" id="username" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="password" style="color: #666;">Password</label>
                <input type="password" name="password" id="password" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-success">Login</button>
        </form>
    </section>
@endsection
