@extends('layouts.main')
<style>
    .panel-top {
        background: #ddd;
        margin-bottom: 5px;
        padding: 5px;
    }

    #row {
        padding-top: 10px;
    }

    .red {
        color: #993300;
    }
</style>
@section('content')

<br>
<div class="card-header">
        <div class="container">
            <h3>Result Information</h3>
        </div>
    </div>
    <div class="container" style="padding: 10px;">
            <div class="row justify-content-center">
                <div class="col-md-8 col-md-offset-2">
                    <div class="card">
                            <br>
                                <div style="font-size: 12px;border-bottom: 2px solid #37BF91;color: #37BF91;margin-bottom: 10px;">
                                    <b>Welcome back, {{ array_get($student, 'student_info.name')}}</b>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-12" style="font-size:12px">
                                        <form method="POST" id="ajax-form" action="/ajax-result">
                                        <div class="alert alert-info">
                                          <b>Fill in your result information </b>
                                          <p class="red">
                                              Only 2 sitting O Level is allowed
                                          </p>
                                        </div>
                                      <div class="panel-top">
                                            {{--  <button class="btn btn-sm btn-success" id="add-school">Add </button>  --}}
                                            <button class="btn btn-sm btn-info" style="color: #FFF" id="submit_btn">Add Another Result</button>
                                            {{--  <b>School Information</b>  --}}
                                        </div>
                                        <p></p>

                                        <div class="row">
                                            <div class="col-md-6">
                                                <label for="">Name of School Attended</label>
                                                <input type="text" class="form-control" name="school_name" required>
                                            </div>

                                            <div class="col-md-3">
                                                <label for="">From </label>
                                                <input type="text" class="form-control" placeholder="MM/YYYY" name="school_from" required>
                                            </div>
                                            <div class="col-md-3">
                                                <label for="">To</label>
                                                <input type="text" class="form-control" placeholder="MM/YYYY" name="school_to" required>
                                            </div>
                                        </div>
                                        <div class="row add-row" id="row">

                                        </div>
                                        <hr>
                                        <div class="panel-top">
                                            {{--  <button class="btn btn-sm btn-success">Add Sitting</button>  --}}
                                            <b>O Level Information</b>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-3">
                                                <label for="">Exam Type</label>
                                                <select name="exam_type" id="" class="form-control" required>
                                                    <option value="">select</option>
                                                    <option value="waec">WAEC</option>
                                                    <option value="neco">NECO</option>
                                                    <option value="gce">GCE</option>
                                                </select>
                                            </div>
                                            <div class="col-md-3">
                                                <label for="">Exam Center</label>
                                                <input type="text" class="form-control" name="exam_center" required>
                                            </div>
                                            <div class="col-md-3">
                                                <label for="">Exam No.</label>
                                                <input type="text" class="form-control" name="exam_no" required>
                                            </div>
                                            <div class="col-md-3">
                                                <label for="">Exam Date</label>
                                                <input type="text" class="form-control" name="exam_date" required>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row">

                                            <div class="col-md-7">
                                                <label for="">Subject</label>
                                                <select name="subject[]" id="" class="form-control" required>
                                                    <option value="">select</option>
                                                    @if( count( $subjects) > 0)
                                                        @foreach ($subjects as $subject)
                                                            <option value="{{$subject->name}}">{{ $subject->name}}</option>
                                                        @endforeach
                                                    @endif
                                                </select>
                                            </div>
                                            <div class="col-md-3">
                                                <label>Grade</label>
                                                <select name="grade[]" id="" class="form-control" required>
                                                    <option value="">select</option>
                                                    @if( ! empty( $grade ) )
                                                        @foreach ($grade as $g)
                                                            <option value="{{$g}}">{{ $g}}</option>
                                                        @endforeach
                                                    @endif
                                                </select>
                                            </div>
                                            <div class="col-md-1">
                                                <div style="padding: 5px;"> &nbsp;</div>
                                                <button class="btn btn-primary btn-sm" id="add-grade">Add</button>
                                            </div>
                                        </div>
                                        <div class="row grade-selection" id="row"></div>
                                        <p></p>
                                        <button class="btn btn-success btn-lg" id="submit_btn">Submit </button>
                                    </div>
                                    </form>
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
    <script>
            $(function() {
                $('#add-grade').on('click', function(e) {
                    const elem = $('.grade-selection')
                    let html = `<div class="col-md-7">
                            <label for="">Subject</label>
                            <select name="subject[]" id="" class="form-control">
                                <option value="">select</option>
                                @if( count( $subjects) > 0)
                                    @foreach ($subjects as $subject)
                                        <option value="{{$subject->name}}">{{ $subject->name}}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>`
                    html += `<div class="col-md-3">
                            <label>Grade</label>
                            <select name="grade[]" id="" class="form-control">
                                <option value="">select</option>
                                @if( ! empty( $grade ) )
                                    @foreach ($grade as $g)
                                        <option value="{{$g}}">{{ $g}}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>`

                    return Portal.add_row(elem, html);
                })
            })
    </script>
@stop