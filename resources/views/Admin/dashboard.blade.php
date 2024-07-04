@extends('Admin.dashboardLayout')
@section('admin_styles')
    <style>
        /* Dashboard Navigation Panel */
        /* .nav {
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

                                                                                                                                                                                .logout {
                                                                                                                                                                                    position: absolute;
                                                                                                                                                                                    right: 10;
                                                                                                                                                                                    top: 12;
                                                                                                                                                                                }

                                                                                                                                                                                .logout a {
                                                                                                                                                                                    text-decoration: none;
                                                                                                                                                                                    color: white;
                                                                                                                                                                                    background-color: #ff9900;
                                                                                                                                                                                }

                                                                                                                                                                                section {}

                                                                                                                                                                                aside {
                                                                                                                                                                                    background-color: #f8f9fa;
                                                                                                                                                                                    height: 100vh;

                                                                                                                                                                                }

                                                                                                                                                                                aside .heading {
                                                                                                                                                                                    text-align: center;
                                                                                                                                                                                    background-color: #0C2D57;
                                                                                                                                                                                    color: white;
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
                                                                                                                                                                                } */

        .row {
            justify-content: space-around
        }

        /* .card {
                                                                                                                                    height: 260px;
                                                                                                                                } */

        /* .card img {
                                                                                                                                    z-index: -1;
                                                                                                                                    width: 200px;
                                                                                                                                    height: 180px;
                                                                                                                                    opacity: 0.3;
                                                                                                                                } */

        .card-body .text {
            display: flex;
            justify-content: space-between;
        }

        .card-body .text a {
            text-decoration: none;
            color: white;
        }

        .card-body span {}

        .deptt-card {
            background-color: #BE3144;
            color: white;
            width: 260px;
        }


        .courses-card {
            background-color: #4CB9E7;
            color: white;
            width: 260px;
        }

        .MCQS-card {
            background-color: #74E291;
            color: white;
            width: 260px;
            display: none;
        }

        .MCQS-card .card-body img {
            width: 240px;
        }

        .candidates-card {
            background-color: #FFAF61;
            color: white;
            width: 260px;
        }

        .mcqsBank-card {
            background-color: #028391;
            color: white;
            width: 260px
        }

        .preparedtests-card {
            background-color: #DA0C81;
            color: white;
            width: 260px;
        }
    </style>
@endsection
@section('admin_content')
    <div class="col-9">
        <div class="row mt-3 me-5">
            <div class="card col-3 border m-2 rounded deptt-card">
                <div class="card-body">
                    {{-- <img src="/images/department.png" alt=""> --}}
                    <div class="text mt-2">
                        <a href="{{ route('departmentList') }}" class="">
                            <h5>Departments</h5>
                        </a>
                        <span>
                            <h5>{{ $count }}</h5>
                        </span>
                    </div>


                </div>
            </div>
            <div class="card col-3 border m-2 rounded courses-card">
                <div class="card-body mt-2">
                    {{-- <img src="/images/courses-icon.png" class="" alt=""> --}}
                    <div class="text">
                        <a href="{{ route('showCourses') }}">
                            <h5>Courses</h5>
                        </a>
                        <span>
                            <h5>{{ $count_courses }}</h5>
                        </span>
                    </div>
                </div>

            </div>
            <div class="card col-3 border m-2 rounded MCQS-card">
                <div class="card-body mt-2">
                    {{-- <img src="/images/mcqs.png" alt=""> --}}
                    <div class="text">
                        <a href="{{ route('mcqs.index') }}">
                            <h5>MCQs Bank</h5>
                        </a>
                        <span>
                            <h5>{{ $count_mcqs }}</h5>
                        </span>
                    </div>
                </div>

            </div>
            <div class="card col-3 border m-2 rounded candidates-card">
                <div class="card-body mt-2">
                    {{-- <img src="/images/courses-icon.png" class="" alt=""> --}}
                    <div class="text">
                        <a href="{{ route('show-candidates-list') }}">
                            <h5>Candidates List</h5>
                        </a>
                        <span>
                            <h5>{{ $count_candidates }}</h5>
                        </span>
                    </div>
                </div>
            </div>
            <div class="card col-3 border m-2 rounded mcqsBank-card">
                <div class="card-body mt-2">
                    {{-- <img src="/images/courses-icon.png" class="" alt=""> --}}
                    <div class="text">
                        <a href="{{ route('mcqs-bank-page') }}">
                            <h5>Mcqs Bank</h5>
                        </a>
                        <span>
                            <h5></h5>
                        </span>
                    </div>
                </div>
            </div>
            <div class="card col-3 border m-2 rounded preparedtests-card">
                <div class="card-body mt-2">
                    {{-- <img src="/images/courses-icon.png" class="" alt=""> --}}
                    <div class="text">
                        <a href="{{ route('preparedTests') }}">
                            <h5>Prepared Tests</h5>
                        </a>
                        <span>
                            <h5></h5>
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- </div>
    </section> --}}
@endsection
