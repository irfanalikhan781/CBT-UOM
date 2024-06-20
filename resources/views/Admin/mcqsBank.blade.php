@extends('Admin.dashboardLayout')
@section('admin_styles')
    <style>
        .mcq-bg {
            background-color: ;
        }

        #mcqsList {
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            background-color: #f9f9f9;
        }

        #mcqsList .question {
            font-weight: bold;
            color: #333;
            margin-bottom: 10px;
        }

        #mcqsList .answer,
        #mcqsList .explanation {
            margin-top: 10px;
        }

        .list-group-item {
            border: none;
        }

        .page-width {
            width: 95%;
        }
    </style>
@endsection
@section('admin_content')
    <section class="col-9 g-0">
        <div class="d-flex justify-content-between">
            <h2 class="mt-2">MCQ Bank</h2>

            <button class="btn btn-success my-3 me-3" onclick="document.getElementById('formatForm').submit()">
                @if ($format === 'department')
                    Show All MCQs
                @else
                    Show By Department
                @endif
            </button>
        </div>

        <form id="formatForm" method="POST" action="{{ route('mcqs.switchFormat') }}" style="display: none;">
            @csrf
            <input type="hidden" name="format" value="{{ $format === 'department' ? 'all' : 'department' }}">
        </form>

        @if ($format === 'department')
            <div class="row">
                <div class="col-md-4">
                    <select class="form-control" id="departmentSelect" onchange="getDepartmentCourses()">
                        <option value="">Select Department</option>
                        @foreach ($departments as $department)
                            <option value="{{ $department->id }}">{{ $department->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-8">

                </div>

                <div id="mcqsList" class="animated fadeIn">

                </div>
            @else
                @if (count($mcqs) > 0)
                    <ul class="list-group list-group-numbered page-width">
                        @foreach ($mcqs as $mcq)
                            <li class="list-group-item mcq-bg my-2 border-bottom border-2">
                                {{ $mcq->question }}
                                <br>
                                <ul class="list-group list-group-flush">
                                    @foreach (json_decode($mcq->options) as $option)
                                        <li class="list-group-item border-bottom">{{ $option }}</li>
                                    @endforeach
                                </ul>
                                <b>Answer:</b> {{ $mcq->answer }}
                                <br>
                                <b>Explanation:</b> {{ $mcq->explanation }}
                            </li>
                        @endforeach
                    </ul>
                    <div>
                        <ul class="pagination">
                            <li class="page-item">
                                <a class="page-link" href="#" aria-label="Previous">
                                    <span aria-hidden="true">&laquo;</span>
                                </a>
                            </li>
                            <li class="page-item"><a class="page-link" href="#">1</a></li>
                            <li class="page-item"><a class="page-link" href="#">2</a></li>
                            <li class="page-item"><a class="page-link" href="#">3</a></li>
                            <li class="page-item">
                                <a class="page-link" href="#" aria-label="Next">
                                    <span aria-hidden="true">&raquo;</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                @else
                    <p>No MCQs found.</p>
                @endif
        @endif
    </section>

    <script>
        function getDepartmentCourses() {
            var departmentId = document.getElementById('departmentSelect').value;
            if (departmentId) {
                fetch(`/api/mcqs/department/{departmentId}`)
                    .then(response => response.json())
                    .then(data => {
                        var mcqsList = document.getElementById('mcqsList');
                        mcqsList.innerHTML = '';

                        if (data.length > 0) {
                            var list = document.createElement('ul');
                            list.classList.add('list-group');
                            for (var i = 0; i < data.length; i++) {
                                var listItem = document.createElement('li');
                                listItem.classList.add('list-group-item', 'mcq-bg', 'my-2');
                                listItem.innerHTML = `
                            <div class="question">${data[i].question}</div>
                            <ul class="list-group list-group-flush">
                                ${data[i].options.map(option => `<li class="list-group-item">${option}</li>`).join('')}
                            </ul>
                            <div class="answer"><b>Answer:</b> ${data[i].answer}</div>
                            <div class="explanation"><b>Explanation:</b> ${data[i].explanation}</div>
                        `;
                                list.appendChild(listItem);
                            }
                            mcqsList.appendChild(list);
                        } else {
                            mcqsList.innerHTML = '<p>No MCQs found for this department.</p>';
                        }
                    });
            } else {
                document.getElementById('mcqsList').innerHTML = ''; // Clear previous MCQs
            }
        }
    </script>
@endsection
