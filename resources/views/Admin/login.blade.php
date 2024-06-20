{{-- <!DOCTYPE html>
<html lang="en">

<head>
</head>

<body>
    <section>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">{{ __('Admin Login') }}</div>

                        <div class="card-body">
                            @if (session('error'))
                                <div class="alert alert-danger" role="alert">
                                    {{ session('error') }}
                                </div>
                            @endif

                            <form method="POST" action="{{ route('admin.login') }}">
                                @csrf

                                <div class="form-group row">
                                    <label for="email"
                                        class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                                    <div class="col-md-6">
                                        <input id="email" type="email" class="form-control" name="email"
                                            value="{{ old('email') }}" required autofocus>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="password"
                                        class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                                    <div class="col-md-6">
                                        <input id="password" type="password" class="form-control" name="password"
                                            required>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-md-6 offset-md-4">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="remember"
                                                id="remember" {{ old('remember') ? 'checked' : '' }}>

                                            <label class="form-check-label" for="remember">
                                                {{ __('Remember Me') }}
                                            </label>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group row mb-0">
                                    <div class="col-md-8 offset-md-4">
                                        <button type="submit" class="btn btn-primary">
                                            {{ __('Login') }}
                                        </button>

                                        @if (Route::has('password.request'))
                                            <a class="btn btn-link" href="{{ route('password.request') }}">
                                                {{ __('Forgot Your Password?') }}
                                            </a>
                                        @endif
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>

</html> --}}


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
    {{-- <section>
        <div class="container">
            <div class="width-400">
                <div class="">
                    <div class="card">
                        <div class="">
                            <h3 class="">{{ __('Admin Login') }}</h3>
                            <a href="{{ url('/') }}">Back</a>
                        </div>

                        <div class="">
                            @if (session('error'))
                                <div class="alert alert-danger" role="alert">
                                    {{ session('error') }}
                                </div>
                            @endif

                            <form method="POST" action="{{ route('admin.login') }}">
                                @csrf

                                <div>
                                    <label for="email">{{ __('E-Mail Address') }}</label>
                                    <input id="email" type="email" name="email" value="{{ old('email') }}"
                                        placeholder="Email" required autofocus>
                                </div>

                                <div>
                                    <label for="password">{{ __('Password') }}</label>
                                    <input id="password" type="password" name="password" placeholder="Password" required>
                                </div>

                                <div class="form-group mb-0">
                                    <div>
                                        <button type="submit">
                                            {{ __('Login') }}
                                        </button>

                                        @if (Route::has('password.request'))
                                            <a class="btn btn-link" href="{{ route('password.request') }}">
                                                {{ __('Forgot Your Password?') }}
                                            </a>
                                        @endif
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section> --}}
    <div class="container">
        <div class="card">
            <h3>Admin Login</h3>
            @if (session('error'))
                <div class="alert alert-danger" role="alert">
                    {{ session('error') }}
                </div>
            @endif
            <form method="POST" action="{{ route('superadmin.login') }}">
                @csrf
                <input type="text" id="email" name="login" placeholder="login" value="{{ old('login') }}" required
                    autofocus>
                <input type="password" id="password" name="password" placeholder="Password" required>
                @if (Route::has('password.request'))
                    <a class="btn btn-link" href="{{ route('password.request') }}">
                        {{ __('Forgot Your Password?') }}
                    </a>
                @endif
                <button type="submit">Login</button>
            </form>
        </div>
    </div>
@endsection
