@extends('layouts.data')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header"> Courses </div>

                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-4">
                                    <form action="{{ route('add_course') }}" method="POST">
                                        @csrf
                                        <label for="">Year</label>
                                        <select name="year" id="" class="form-control" required>
                                            <option value="">select</option>
                                            <option value="year-1">Year One</option>
                                            <option value="year-2">Year Two</option>
                                            <option value="year-3">Year Three</option>
                                        </select>
                                        <label for="">Semester</label>
                                        <select name="semester" id="" class="form-control" required>
                                            <option value="">select</option>
                                            <option value="1"> First </option>
                                            <option value="2"> Second </option>
                                            </select>
                                        <label for="">Course Title </label>
                                        <input type="text" class="form-control" name="title" required spellcheck="false" autocomplete="off">
                                        <label for="">Course Code </label>
                                        <input type="text" class="form-control" name="code" required>
                                        <label for="">Course Unit </label>
                                        <select name="unit" id="" class="form-control" required>
                                            <option value="">select</option>
                                            <option value="0">0</option>
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                        </select>
                                        {{--  <input type="hidden" value="{{ $id }}" name="subject_id">  --}}
                                        <p></p>
                                        <button class="btn btn-primary">Add+</button>
                                    </form>
                                </div>
                                <div class="col-md-7">
                                    <div style="height: 300px;overflow: auto;">
                                    <form method="GET">
                                        <select name="year" id="" required>
                                            <option value="">select year</option>
                                            <option value="year-1">Year 1</option>
                                            <option value="year-2">Year 2</option>
                                            <option value="year-3">Year 3</option>
                                        </select>
                                        &nbsp;
                                        <select name="semester" id="" required>
                                            <option value="">select semester</option>
                                            <option value="1">First</option>
                                            <option value="2">Second</option>
                                        </select>
                                        &nbsp;
                                        <button class="btn btn-dark btn-sm">
                                            submit
                                        </button>
                                    </form>
                                    @if( count($courses) > 0 )
                                        <p></p>
                                            <table class="table" align="center" style="font-size: 12px;">
                                                <tr>
                                                    <th>#</th>
                                                    <th>Course Title</th>
                                                    <th>Code</th>
                                                    <th>Course Unit</th>
                                                    <th>Semester </th>
                                                    <th>Year </th>
                                                </tr>
                                                @foreach( $courses as $key => $course)
                                                    <tr>
                                                        <td> {{ $key+1}}</td>
                                                        <td>{{ $course->title}}</td>
                                                        <td>{{ $course->code }}</td>
                                                        <td>{{ $course->unit}}</td>
                                                        <td> {{ $course->semester }}</td>
                                                        <td> {{ $course->year }}</td>
                                                    </tr>
                                                @endforeach
                                            </table>
                                        @else
                                            <p></p>
                                            <div class="alert-info alert">
                                                <p>No Course registered for this semester </p>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('javascript')
    <script>
        @if(array_get($_GET, 'rel') == '1')
            alert('Subject Added Successfully ')
            window.location = '/panel/result'
        @elseif(array_get($_GET, 'rel') == '0')
            alert('Subject Already Exist')
            window.location = '/panel/result'
        @endif

    </script>
@stop
