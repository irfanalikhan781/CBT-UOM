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

        .dashboard {
            position: absolute;
            left: 500;
            top: 10;
            color: white;
        }

        .dashboard a {
            text-decoration: none;
            color: white
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

        section .row {
            justify-content: unset;
        }

        aside {
            background-color: #f8f9fa;
            height: 100%;

        }

        aside .heading {
            text-align: center;
            background-color: #0C2D57;
            color: white;
        }

        aside .text-center a {
            text-align: left;
        }

        aside .create-test {
            background-color: #BE3144;
            color: white;
            width: 200px;
        }

        aside .create-test:hover {
            background-color: #ff9900;
            color: white;
        }

        aside .add-deptt {
            background-color: #DDE6ED;
            width: 200px;
        }

        aside .add-deptt:hover {
            background-color: #526D82;
            color: white;
        }

        aside .add-course {
            background-color: #DDE6ED;
            width: 200px;
        }

        aside .add-course:hover {
            background-color: #526D82;
            color: white;
        }

        aside .add-mcqs {
            background-color: #DDE6ED;
            width: 200px;
        }

        aside .add-mcqs:hover {
            background-color: #526D82;
            color: white;
        }
    </style>
    @yield('admin_styles')
@endsection

@section('content')
    <div class="nav">

        <h3 class="dashboard"><a href="{{ route('admin.showLoginForm') }}">Admin Dashboard</a></h3>
        <form class="logout" method="POST" action="{{ route('admin.logout') }}">
            @csrf
            <button class="btn" type="submit">LOG OUT</button>
        </form>


    </div>
    <section class="main">
        <div class="row">
            <div class="col-3 ">
                <aside class="shadow pb-3">
                    <div class="heading py-2">
                        <h5>CONTROLS</h5>
                    </div>
                    <div class="text-center">
                        <a href="{{ route('createTestForm') }}" class="btn create-test rounded-pill mt-2">CREATE TEST</a>
                        <a href="{{ route('addDepartment') }}" class="btn add-deptt rounded-pill mt-2"><i
                                class="fa-solid fa-circle-plus"></i>
                            Add
                            Department</a>
                        <a href="{{ route('addProgram') }}" class="btn add-deptt rounded-pill mt-2"><i
                                class="fa-solid fa-circle-plus"></i>
                            Add
                            Program</a>
                        <a href="{{ route('admin.addCourse') }}" class="btn add-course rounded-pill mt-2"><i
                                class="fa-solid fa-circle-plus"></i>
                            Add
                            Course</a>
                        <a href="{{ route('get-upload-mcqs-form') }}" class="btn add-mcqs rounded-pill mt-2"><i
                                class="fa-solid fa-circle-plus"></i> Add
                            MCQs</a>
                        <a href="{{ route('show-upload-candidates-form') }}" class="btn add-course rounded-pill mt-2"><i
                                class="fa-solid fa-circle-plus"></i>
                            Add
                            Candidates</a>
                    </div>
                </aside>
            </div>

            @yield('admin_content')

        </div>

    </section>
@endsection
