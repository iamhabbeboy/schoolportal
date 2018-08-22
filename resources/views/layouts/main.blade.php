
<!DOCTYPE html>
<html lang="zxx">

<head>
	<title>Kebbi State School of Nursing and Midwifery  | Home </title>
	<!-- meta-tags -->
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="keywords" content="Soft Responsive web template, Bootstrap Web Templates, Flat Web Templates, Android Compatible web template,
Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyEricsson, Motorola web design" />
<meta name="csrf-token" content="{{ csrf_token() }}">
<script>
		addEventListener("load", function () {
			setTimeout(hideURLbar, 0);
		}, false);

		function hideURLbar() {
			window.scrollTo(0, 1);
		}
	</script>

	<style>
		.card-header {
			background: rgba(0, 0, 0, 0.03);
			padding: 10px;
			margin-top: 10px;
			margin-bottom: 30px;
			color: 000;
		}
	</style>
	<!-- //meta-tags -->
	<link href="css/bootstrap.css" rel="stylesheet" type="text/css" media="all" />
	<link href="css/style.css" rel="stylesheet" type="text/css" media="all" />
	<!-- font-awesome -->
	<link href="css/font-awesome.css" rel="stylesheet">
	<!-- fonts -->
	<link href="//fonts.googleapis.com/css?family=Raleway:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i"
	    rel="stylesheet">
	<link href="//fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i" rel="stylesheet">

</head>

<body>
<!-- header -->
	<div class="header-top">
		<div class="container">
			<div class="bottom_header_left">
				<p>
					<span class="fa fa-map-marker" aria-hidden="true"></span>Birnin Kebbi, Kebbi State, NIGERIA
				</p>
			</div>
			<div class="bottom_header_right">
				<div class="bottom-social-icons">
					<a class="facebook" href="#">
						<span class="fa fa-facebook"></span>
					</a>
					<a class="twitter" href="#">
						<span class="fa fa-twitter"></span>
					</a>
					<a class="pinterest" href="#">
						<span class="fa fa-pinterest-p"></span>
					</a>
					<a class="linkedin" href="#">
						<span class="fa fa-linkedin"></span>
					</a>
				</div>
				<div class="header-top-righ">
					<a href="/panel">
						<span class="fa fa-sign-out" aria-hidden="true"></span>Login</a>
				</div>
				<div class="clearfix"> </div>
			</div>
			<div class="clearfix"> </div>
		</div>
	</div>
	<div class="header">
		<div class="content white">
			<nav class="navbar navbar-default">
				<div class="container">
					<div class="navbar-header">
						<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
							<span class="sr-only">Toggle navigation</span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
						</button>
						<a class="navbar-brand" href="index.php">
							<h1>
								<span class="" aria-hidden="true"><img src="images/SCHOOL OF NURSING CORP. 20180405_064859.jpg" width="70" height="68">KEBBI STATE</span>
							  <label> SCHOOL OF NURSING AND MIDWIFERY</label>
							</h1>
					  </a>
					</div>
					<!--/.navbar-header-->
					<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
						<nav class="link-effect-2" id="link-effect-2">
							<ul class="nav navbar-nav">
							@guest
								<li>
									<a href="/" class="effect-3">Home</a>
								</li>
								<li>
									<a href="/about" class="effect-3">About Us</a>
								</li>
								<li>
									<a href="#" class="effect-3">Admission</a>
								</li>
								<li>
									<a href="/gallery" class="effect-3">Gallery</a>
								</li>
								<li>
									<a href="/contact" class="effect-3">Contact</a>
                                </li>

								<li class="dropdown">
									<a href="#" class="dropdown-toggle" data-toggle="dropdown">Student Portal
										<span class="caret"></span>
									</a>
									<ul class="dropdown-menu" role="menu">
                                    <li>
											<a href="/login">Prospective Student</a>
									</li>
										<li>
											<a href="/register">Fresh Application </a>
										</li>
										<li>
											<a href="/register?rel=old">Old Student Application </a>
										</li>
									</ul>
								</li>
							@elseif(isset($payment_status))
								<li>
									<a href="/dashboard" >Dashboard</a>
								</li>
								<li>
									<a href="/home">Profile</a>
								</li>
								<li>
									<a href="/admission">Admission</a>
								</li>
								<li>
									<a href="/payment-history">Payment</a>
								</li>
								<li>
									<a href="{{ route('logout') }}"
									onclick="event.preventDefault();
												  document.getElementById('logout-form').submit();">
									 {{ __('Logout') }}</a>
								</li>

							@else
							<li>
								<a href="{{ route('logout') }}"
									onclick="event.preventDefault();
												  document.getElementById('logout-form').submit();">
									 {{ __('Logout') }}</a>
								</li>
							@endif
							<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
									@csrf
								</form>
							</ul>
						</nav>
					</div>
					<!--/.navbar-collapse-->
					<!--/.navbar-->
				</div>
			</nav>
		</div>
    </div>

    @yield('content')

	<div class="footer-copy-right" style="text-align: center;">
        <div class="container">
            <div class="allah-copy">
                <p style="font-size: 12px;">&nbsp;
                </p>
            </div>
            <div class="footercopy-social">
                {{--  <ul>
                    <li>
                        <a href="#">
                            <span class="fa fa-facebook"></span>
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <span class="fa fa-twitter"></span>
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <span class="fa fa-rss"></span>
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <span class="fa fa-vk"></span>
                        </a>
                    </li>
                </ul>  --}}
            </div>
            <div class="clearfix"></div>
        </div>
    </div>
</div>
<!--/footer -->

<!-- js files -->
<!-- js -->
<script src="js/jquery-2.1.4.min.js"></script>
<!-- bootstrap -->
<script src="js/bootstrap.js"></script>
<!-- smooth scrolling -->
<script src="js/SmoothScroll.min.js"></script>
<script src="js/move-top.js"></script>
<script src="js/easing.js"></script>
<!-- here stars scrolling icon -->
<script>
    $(document).ready(function () {
        /*
            var defaults = {
            containerID: 'toTop', // fading element id
            containerHoverID: 'toTopHover', // fading element hover id
            scrollSpeed: 1200,
            easingType: 'linear'
            };
        */

        $().UItoTop({
            easingType: 'easeOutQuart'
        });

    });
</script>
<!-- //here ends scrolling icon -->
<!-- smooth scrolling -->
<!-- //js-files -->
 <script src="{{ asset('js/portal.js')}}" ></script>
@yield('javascript')
</body>

</html>