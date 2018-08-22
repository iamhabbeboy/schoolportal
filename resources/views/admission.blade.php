@extends('layouts.main')
@section('content')
<br>
<div class="card-header">
        <div class="container">
            <h3>Admission Status</h3>
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
                                    <div class="col-md-8" style="font-size:12px">
                                        <div class="alert-success alert"><b>Admission Status</b></div>

                                        @if( array_get($student, 'admission_status') == '1')
                                            <h4>Congratulations, </h4>
                                            <br>
                                            <p style="font-size: 13px">
                                                You have been offered an Admission
                                            </p>
                                            <p>
                                                <a href="/admission-letter" target="_blank">[ click to print admission letter ]</a>
                                            </p>
                                        @else
                                            <h4>No Admission Offered yet </h4>
                                            <br>
                                            <p style="font-size: 13px;">
                                                please check back as soon as possible,
                                            </p>
                                            <p> we are still processing your information
                                            </p>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
<br><br><br><br><br><br>
@stop