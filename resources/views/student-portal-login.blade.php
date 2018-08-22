@extends('layouts.main')

@section('content')

	<!-- about -->
	<div class="banner-bottom-w3l" id="about">
		<div class="container">
			<div class="title-div">
				<h3 class="tittle">

					<span>Student</span> Login
				</h3>
				<div class="tittle-style">

				</div>
			</div>
			<div class="welcome-sub-wthree">

                <!-- Stats-->
                <div class="col-md-4 col-md-offset-4">
                    <form action="">
                        <div class="form-group">
                            <label for="">Email Address</label>
                            <input type="text" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="">Password</label>
                            <input type="password" class="form-control">
                        </div>
                        <div class="form-group">
                            <button class="btn-lg btn btn-danger" style="width: 100%;">
                                Login
                            </button>
                            @if( array_get($_GET, 'rel') == 'prospective')
                                <br><br>
                                <p style="text-align: center">
                                    <a href="/register">[ Click Here to Start Fresh Application ]</a>
                                </p>
                            @endif
                        </div>
                    </form>
                </div>

				<!-- //Stats -->
                <div class="clearfix"> </div>
                <div>&nbsp;</div>
			</div>
		</div>
	</div>


@stop