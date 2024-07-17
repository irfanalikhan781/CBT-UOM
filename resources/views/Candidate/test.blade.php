@extends('Candidate.dashboardLayout')
@section('candidate_page_styles')
    <style>
        .clock {
            background-color: aquamarine;
            display: flex;
            width: 12%;
            padding-left: 10px;
            padding-top: 14px;
            position: fixed;
            right: 0;
            border-radius: 12px;
        }
    </style>
@endsection
@section('candidate_page_content')
    <section class="col-9">
        <div class="container mt-5">
            <h3>Test: {{ $test->name }}</h3>
            <div class="clock">
                <h6 class="mt-1 me-2">Time Left:</h6>
                <div id="timer" class="mb-4">Time Left: {{ $test->duration }}:00</div>
            </div>
            <form action="{{ route('candidate.submitTest', ['test_id' => $test->id]) }}" method="POST">
                @csrf
                @foreach ($mcqs as $index => $mcq)
                    <div class="form-group mb-3">
                        <label>{{ $index + 1 }}. {{ $mcq->question }}</label>
                        <div class="form-check">
                            <input type="radio" name="answers[{{ $mcq->id }}]" value="option1"
                                class="form-check-input" required>
                            <label class="form-check-label">{{ $mcq->option1 }}</label>
                        </div>
                        <div class="form-check">
                            <input type="radio" name="answers[{{ $mcq->id }}]" value="option2"
                                class="form-check-input">
                            <label class="form-check-label">{{ $mcq->option2 }}</label>
                        </div>
                        <div class="form-check">
                            <input type="radio" name="answers[{{ $mcq->id }}]" value="option3"
                                class="form-check-input">
                            <label class="form-check-label">{{ $mcq->option3 }}</label>
                        </div>
                        <div class="form-check">
                            <input type="radio" name="answers[{{ $mcq->id }}]" value="option4"
                                class="form-check-input">
                            <label class="form-check-label">{{ $mcq->option4 }}</label>
                        </div>
                    </div>
                @endforeach
                <button type="submit" class="btn btn-primary mt-3">Submit Test</button>
            </form>
        </div>
    </section>

    <script>
        // Disable back button
        history.pushState(null, null, location.href);
        window.addEventListener('popstate', function(event) {
            history.pushState(null, null, location.href);
        });

        // Disable refresh
        window.addEventListener('beforeunload', function(e) {
            e.preventDefault();
            e.returnValue = '';
        });

        // Test timer logic
        let timer = {{ $test->duration }} * 60; // Convert minutes to seconds
        const timerElement = document.getElementById('timer');

        function updateTimer() {
            const minutes = Math.floor(timer / 60);
            const seconds = timer % 60;
            timerElement.textContent = `${minutes}:${seconds < 10 ? '0' : ''}${seconds}`;
            if (timer > 0) {
                timer--;
            } else {
                document.getElementById('submission_type').value = 'timeout';
                document.getElementById('testForm').submit();
            }
        }

        setInterval(updateTimer, 1000);
        updateTimer(); // initial call to set timer
    </script>
@endsection
