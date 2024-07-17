@extends('Candidate.dashboardLayout')

@section('candidate_page_styles')
    <style>
    </style>
@endsection

@section('candidate_page_content')
    <section class="col-9">
        <div class="container">
            <h2 class="my-3">Demo Test</h2>
            <form action="{{ route('candidate.submit-demo') }}" method="POST">
                @csrf
                @foreach ($demoMcqs as $index => $mcq)
                    <div class="mb-3">
                        <p>{{ $index + 1 }}. {{ $mcq['question'] }}</p>
                        @foreach ($mcq['options'] as $option)
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="answers[{{ $index }}]"
                                    value="{{ $option }}" required>
                                <label class="form-check-label">{{ $option }}</label>
                            </div>
                        @endforeach
                    </div>
                @endforeach
                <button type="submit" class="btn btn-success">Submit Demo Test</button>
            </form>
        </div>

    </section>

    <script></script>
@endsection
