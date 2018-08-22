@extends('layouts.data')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    @if( $login == false )
                        Login
                    @else
                        Dashboard
                    @endif
                </div>

                <div class="card-body">

                    <div class="row">
                        <div class="col-md-12">

                            @if( $login == false )

                                @if(array_get($_GET,'rel') == 'failed')
                                    <div class="alert-danger alert">Invalid information supplied </div>
                                @endif
                                <form action="{{ route('auth') }}" method="POST">
                                    @csrf
                                    <label for="">Email Address</label>
                                    <input type="text" class="form-control" name="email" required>
                                    <label for="">Password</label>
                                    <input type="password" class="form-control" name="password" required>
                                    <p></p>
                                    <br>
                                    <button class="btn btn-success btn-lg">Submit</button>
                                </form>
                            @else
                                <div class="alert alert-info">
                                    You are welcome to Kebbi State School of Nursing &amp; Midwifery Admin Dashboard
                                </div>

                                <a href="/panel/students" class="btn btn-lg btn-primary"> Get Started Here </a>
                            @endif
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
        /*$(function() {
            const elem = $('#profile')
            elem.click(function() {
                const photo = $('#photo').click();
            })
        })*/

        {{--  @if($params == 'success')
            alert('Updated Successfully ');
            window.location = '/home'
        @endif  --}}
    </script>
@stop
