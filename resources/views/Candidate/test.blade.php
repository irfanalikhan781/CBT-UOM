@extends('Candidate.dashboardLayout')
@section('candidate_page_styles')
    <style>
        .mcq-container {
            width: 95%;
        }
    </style>
@endsection
@section('candidate_page_content')
    <section class="col-9">
        <h1>Test: {{ $test->name }}</h1>
        <form action="{{ route('candidate.storeTestResults', $test->id) }}" method="POST">
            @csrf
            @foreach ($paginatedMcqs as $mcq)
                <div class="form-group">
                    <label>{{ $mcq->question }}</label>
                    @foreach (json_decode($mcq->options, true) as $option)
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="mcqs[{{ $mcq->id }}]"
                                value="{{ $option }}" required>
                            <label class="form-check-label">{{ $option }}</label>
                        </div>
                    @endforeach
                </div>
            @endforeach
            {{ $paginatedMcqs->links() }}
            <button type="submit" class="btn btn-primary mt-3">Submit Test</button>
        </form>
    </section>
@endsection
