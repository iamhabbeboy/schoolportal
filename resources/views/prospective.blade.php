@extends('layouts.main')

<style>
    p > b{
        color: #666 !important;
    }


</style>
@section('content')
<div class="card-header">
    <div class="container">
        <h3>Dashboard</h3>
    </div>
</div>
<div class="container" style="padding: 10px;">
        <div class="row justify-content-center">
            <div class="col-md-8 col-md-offset-2">
                <div class="card">
                        <br>
                            <div style="font-size: 12px;border-bottom: 2px solid #37BF91;color: #37BF91;margin-bottom: 10px;">
                                <b>Welcome back, Abiodun</b>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-8" style="font-size:12px">

                                        @if($payment_status)
                                            @if( ! array_get($students, 'dob'))
                                                <div class="alert-info alert"><b>Please complete your information  </b></div>
                                            @endif
                                        @else
                                            <div class="alert-danger alert"><b>Click below to obtain your form </b></div>
                                        @endif
                                        <p>
                                            <b>Name: </b> {{ array_get($students, 'student_info.name') }}
                                        </p>
                                        <p>
                                            <b> Email Address: </b> {{ array_get($students, 'student_info.email') }}
                                        </p>

                                            <p>
                                                <a href="{{ route('admission')}}">&raquo; Admission Status</a>
                                            </p>
                                            <p>
                                                <a href="#">&raquo; Payment History</a>
                                            </p>
                                            <p>
                                                <a href="{{ route('course-register') }}">&raquo; Course Registration</a>
                                            </p>
                                        @else
                                            <p>
                                                <a href="{{ route('form') }}" class="btn btn-info btn-sm" style="color: #FFF;font-size:12px;">Obtain Form</a>
                                            </p>
                                        @endif
                                    </div>
                                    <div class="col-md-3">
                                        <div class="profile-holder">
                                            @if( array_get($students, 'picture') )
                                                <img src="{{ array_get($students, 'picture')}}" width="200" height="199">
                                            @else
                                                <img src="/images/avatar.png" width="200">
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
        <br><br><br>
@stop