@extends('layouts.main')

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

                <div class="card-body">
                    <form method="POST" action="/login" aria-label="Login">
                        @csrf
                        <p style="color: #993300">
                                {{ $errors->first('email') }}
                                {{ $errors->first('password') }}
                        </p>

                        <div class="form-group row">
                            <label for="email" class="col-sm-4 col-form-label text-md-right">Full Name</label>

                            <div class="col-md-6">
                                <input id="email" type="text" class="form-control" name="name" value="" required>

                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="email" class="col-sm-4 col-form-label text-md-right">E-Mail Address</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" value="" required>

                            </div>
                        </div>


                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">Password</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password" required>

                                                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">Confirm Password</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="conf-password" required>

                                                            </div>
                        </div>

                      

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    Register
                                </button>
                                &nbsp;&nbsp;
                                <a href="#">Login </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
        </main>
    </div>


@stop