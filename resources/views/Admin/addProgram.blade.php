@extends('Admin.dashboardLayout')
@section('admin_styles')
    <style>
        .width-26 {
            width: 26rem;
            background-color: #DDE6ED;
        }

        form .add-btn {
            background-color: #BE3144;
            width: 6rem;
            color: white;
        }

        form .add-btn:hover {
            background-color: #ff9900;
        }
    </style>
@endsection
@section('admin_content')
    <section class="container col-9">
        <div class="width-26 border rounded mx-auto mt-4">
            <form method="POST" action="{{ route('insert-program') }}" class="px-4">
                @csrf
                <div class="text-center mt-3">
                    <h5>
                        Add Program
                    </h5>
                </div>

                <label for="depttName">Program</label><br>
                <input type="text" id="programName" name="programName" class="form-control mb-2">

                <button type="submit" class="btn add-btn">ADD</button>

            </form>
        </div>

    </section>
@endsection
