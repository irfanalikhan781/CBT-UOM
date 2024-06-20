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
            <form method="POST" action="{{ route('insert-department') }}" class="px-4">
                @csrf
                <div class="text-center mt-3">
                    <h5>
                        Add Department
                    </h5>
                </div>

                <label for="depttName">Department Name</label><br>
                <input type="text" id="depttName" name="depttName" class="form-control mb-2">

                {{-- <p class="body1 pt-4">Programs</p>
                <div class="form-check pb-4">
                    <input class="form-check-input" type="checkbox" value="Masters" id="checkMasters">
                    <label class="form-check-label" for="checkMasters">
                        Masters Program
                    </label>
                    <br>
                    <input class="form-check-input" type="checkbox" value="PhD" id="checkPhD">
                    <label class="form-check-label" for="checkPhD">
                        Ph.D Program
                    </label>
                </div> --}}
                @if (count($programs) > 0)
                    <label for="programs">Programs:</label>
                    @foreach ($programs as $program)
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" id="program_{{ $program->id }}"
                                name="programs[]" value="{{ $program->id }}">
                            <label class="form-check-label" for="program_{{ $program->id }}">{{ $program->name }}</label>
                        </div>
                    @endforeach
                @else
                    <p>Enter programs first.</p>
                @endif
                <button type="submit" class="btn add-btn">ADD</button>

            </form>
        </div>

    </section>
@endsection
