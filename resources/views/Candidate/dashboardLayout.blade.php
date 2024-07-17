@extends('MainLayout')
@section('styles')
    <style>
        .nav {
            width: 100%;
            height: 60px;
            background-color: #750E21;
            position: relative;
            display: flex;
        }

        .nav form {
            width: 10%;
        }

        .title {
            position: absolute;
            left: 500;
            top: 10;
            color: white;

        }

        .logout {
            position: absolute;
            right: 10;
            top: 12;
        }

        .logout button {
            color: white;
            background-color: #ff9900;
        }

        .logout button:hover {
            color: white;
        }

        /* section .row {
                                                                                        justify-content: unset;

                                                                                    } */
        aside {
            background-color: #f8f9fa;
            height: 100%;

        }

        aside .avatar {
            width: 130px;
            height: 130px;
            background-color: #DDE6ED;
            align-content: center;
            border-radius: 50%;
        }

        aside .add-deptt {
            background-color: #DDE6ED;
            width: 200px;
        }

        aside .counter .row .col-6 {
            width: 30px;
            height: 30px;
        }

        aside .counter-title {
            background-color: #A3C9AA;
            text-align: center;
            border-radius: 24px;

        }
    </style>
    @yield('candidate_page_styles')
@endsection

@section('content')
    <div class="nav">

        <h3 class="title">CBT University of Malakand</h3>
        <form class="logout" method="POST" action="{{ route('candidate.logout') }}">
            @csrf
            <button class="btn" type="submit">LOG OUT</button>
        </form>


    </div>
    <section class="main">
        <div class="row g-0">
            <div class="col-3 ">
                <aside class="shadow">
                    <div class="avatar mx-auto mt-2">
                        <img src="" alt="">
                    </div>

                    <div class="text-center">
                        <h3 class="btn add-deptt rounded-pill mt-2">
                            Irfan Ali Khan </h3>

                        <p class="mb-1"><b>Roll No:</b> 123</p>
                        <p><b>CNIC:</b> 7439734937539</p>
                    </div>
                    {{-- <div class="counter">
                        <div class="counter-title py-2 mx-5 my-3">
                            <h5>MCQs Counter</h5>
                        </div>
                        <div class="row justify-content-center g-0">
                            @for ($i = 1; $i <= 100; $i++)
                                <div class="col-6 border border-2 border-dark rounded-circle mx-2 my-1">
                                    <p class="">{{ $i }}</p>
                                </div>
                            @endfor
                        </div>
                    </div> --}}
                </aside>
            </div>

            @yield('candidate_page_content')

        </div>

    </section>
@endsection
