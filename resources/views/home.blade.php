<!-- resources/views/landing.blade.php -->


@extends('MainLayout')

@section('styles')
    <style>
        /* Home Page Styling Starts */
        body {
            margin: 0;
            padding: 0;
            font-family: 'Arial', sans-serif;
            background: url('/images/uom.jpg') center/cover no-repeat;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            color: #fff;
            text-align: center;
            position: relative;

        }

        body::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.7);
            /* Adjust the last value (0.5) for transparency */
            z-index: -1;

        }

        .logo img {
            width: 240px;
            height: 200px;
        }


        h1 {
            font-size: 3em;

        }

        .btn-container {
            margin-top: 20px;
        }

        .btn {
            display: inline-block;
            padding: 10px 20px;
            margin: 0 10px;
            text-decoration: none;
            color: #fff;
            background-color: #ff9900;
            border-radius: 5px;
        }

        .btn:hover {
            background-color: #E65C19;
        }

        .admin_btn {
            position: absolute;
            top: 20px;
            right: 20px;
        }

        /* Home Page Styling Ends */
    </style>
@endsection
@section('content')
    <section class="body-home overlay">
        <div>
            <div class="admin_btn"><a href="{{ route('admin.showLoginForm') }}" class="btn">Admin Dashboard</a>
            </div>
            <div class="logo">
                <img src="images/UOMlogo.png" alt="">

            </div>

            <h1 class="h1-home">Welcome to CBT </h1>
            <h1 class="h1-home">University of Malakand</h1>
            <div class="btn-container">

                <a href="{{ route('candidate.loginForm') }}" class="btn">Student Dashboard</a>
            </div>
        </div>
    </section>
@endsection
