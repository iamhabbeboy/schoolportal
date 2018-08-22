@extends('layouts.app')
@section('content')
        <div class="flex-center position-ref full-height">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-8 col-md-offset-3">
                        <div class="card">
                            <div class="card-header">
                                Welcome...
                            </div>
                            <div class="card-body">
                                <p>
                                    You are officially welcome to Kebbi state portal
                                </p>
                                <a href="/register" class="btn btn-primary btn-sm">Fresh Application</a>
                                &nbsp;
                                <a href="/login" class="btn btn-info btn-sm">Returning Student</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
@stop