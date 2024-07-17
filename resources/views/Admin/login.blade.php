@extends('MainLayout')
@section('styles')
    <style>
        .width-400 {
            width: 600px;
        }

        .container {
            width: 100%;
            max-width: 400px;
        }

        .card {
            margin-top: 100px;
            width: 100%;
            background-color: #f8f8f8;
            /* Warna card */
            padding: 20px;
            border-radius: 12px;
            /* Border radius card */
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        h3 {
            text-align: center;
            color: #333;
        }

        form {
            display: flex;
            flex-direction: column;
        }

        input {
            padding: 10px;
            margin-bottom: 12px;
            border: 2px solid #ddd;
            /* Border color input */
            border-radius: 8px;
            /* Border radius input */
            transition: border-color 0.3s ease-in-out;
            outline: none;
            color: #333;
            background-color: #f4f4f4;
            /* Warna input */
        }

        input:focus {
            border-color: #ff9900;
            /* Warna input saat focus */
        }

        button {
            background-color: #ff9900;
            /* Warna button */
            color: #fff;
            padding: 10px;
            border: none;
            border-radius: 8px;
            /* Border radius button */
            cursor: pointer;
            transition: background-color 0.3s ease-in-out;
        }

        button:hover {
            background-color: #ff6600;
            /* Warna button saat hover */
        }
    </style>
@endsection
@section('content')
    <div class="container">
        <div class="card">
            <h3>Admin Login</h3>
            @if (session('error'))
                <div class="alert alert-danger" role="alert">
                    {{ session('error') }}
                </div>
            @endif
            <form method="POST" action="{{ route('admin.login') }}">
                @csrf
                <input type="email" id="email" name="email" placeholder="Email" value="{{ old('login') }}" required
                    autofocus>
                <input type="password" id="password" name="password" placeholder="Password" required>
                <div class="form-group form-check">
                    <input type="checkbox" class="form-check-input" id="remember" name="remember">
                    <label class="form-check-label" for="remember">Remember Me</label>
                </div>
                <button type="submit">Login</button>
            </form>
        </div>
    </div>
@endsection
