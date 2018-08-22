@extends('layouts.main')
@section('content')
<div class="card-header">
    <div class="container">
        <h3>Dashboard</h3>
    </div>
</div>
        <div class="flex-center position-ref full-height">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-8 col-md-offset-3">
                        <div class="card">
                            <div class="card-header">
                                Course Registration
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-12" style="font-size:12px">
                                        @if(count($register) > 0)
                                            <div class="alert-info alert">
                                                <a href="#" onclick="window.print()">[click to print course registered] </a>
                                            </div>
                                        @else
                                            <div class="alert-info alert">
                                                Register your courses
                                            </div>
                                        @endif
                                        <div class="row">
                                            <div class="col-md-4">
                                                <b>Semester: First</b>
                                            </div>
                                            <div class="col-md-4">
                                                <b>Year: one</b>
                                            </div>

                                        </div>


                                        @if( count($register) > 0 )

                                            <table class="table" style="font-size: 12px;background: #ddd" cellpadding="5" cellspacing="1">
                                                <tr>
                                                    <th>#</th>
                                                    <th>Title</th>
                                                    <th>Code</th>
                                                    <th>Unit</th>
                                                </tr>
                                                @foreach ($register as $key => $single)

                                                    <tr <tr
                                                        @if($key%2 == 0)
                                                            style="background: #FFF"
                                                        @endif
                                                    >
                                                        <td> {{ $key + 1}} </td>
                                                        <td> {{ array_get($single, 'get_course.title' ) }}</td>
                                                        <td> {{ array_get($single, 'get_course.code') }} </td>
                                                        <td> {{ array_get($single, 'get_course.unit') }} </td>
                                                    </tr>
                                                @endforeach
                                        @else

                                        <form method="POST" action="{{ route('add-course') }}">
                                            @csrf
                                        <input type="hidden" value="year-1" name="year">
                                        <input type="hidden" value="1" name="semester">
                                        <table class="table" style="font-size: 12px;background: #ddd" cellpadding="5" cellspacing="1">
                                            <tr>
                                                <th>&nbsp;</th>
                                                <th>#</th>
                                                <th>Title</th>
                                                <th>Code</th>
                                                <th>Unit</th>
                                            </tr>

                                            @if( count($courses) > 0 )
                                                @foreach ($courses as $key => $course)
                                                    <tr
                                                        @if($key%2 == 0)
                                                            style="background: #FFF"
                                                        @endif
                                                    >
                                                        <td>
                                                            <input type="checkbox" name="courses[]" value="{{ $course->id }}-{{ $course->unit}}"
                                                            class="course-selection">
                                                        </td>
                                                        <td>{{ $key+1}}</td>
                                                        <td>{{ $course->title}}</td>
                                                        <td>{{ $course->code}}</td>
                                                        <td>{{ $course->unit}}</td>
                                                    </tr>
                                                @endforeach
                                            @endif
                                        </table>
                                        <div>
                                            <b>Total Unit: <span id="total-unit">0</span> Unit(s)</b>
                                        </div>
                                        <hr>
                                        <button class="btn-primary btn" id="subject-courses">Submit &amp; Print </button>
                                        </form>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

@stop
@section('javascript')
<script src="/js/utility.js"></script>
@stop