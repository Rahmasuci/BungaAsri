<div class="banner_top innerpage" id="home">
	<div class="wrapper_top_w3layouts">
		<div class="header_agileits">
			<div class="logo inner_page_log">
				<h1><a class="navbar-brand" href="{{route('index')}}"><span>Bungaasri</span> <i>Official</i></a></h1>
			</div>
			<div class="overlay overlay-contentpush">
				<button type="button" class="overlay-close"><i class="fa fa-times" aria-hidden="true"></i></button>

				<nav>
					<ul>
						<li><a href="{{route('index')}}" class="active">Home</a></li>
						<!-- Cek apa user sudah login -->
						@if(Auth::check())
						<!-- jika user sudah login -->
							<!-- cek apakah user adalah customer  -->
							@if(Auth()->user()->role == 1)			
							<!-- jika benar maka akan tampil menu customer  -->
								<li><a href="{{route('products')}}">Shop Now</a></li>
								<li><a href="{{route('customer.order.index')}}">List Order</a></li>
								<li><a href="{{route('customer.payment.index')}}">Waiting Payment</a></li> 
							<!-- jika salah -->
							@else 
							<!-- maka akan muncul menu admin -->
							<li><a href="{{route('admin.index')}}">Admin Panel</a></li>
							@endif
						<!-- jika user belum melakukan login -->
						@else
							<!-- maka muncul menu -->
							<li><a href="{{route('products')}}">Shop Now</a></li>
						@endif

						<li><a href="about.php">About</a></li>
						<li><a href="contact.php">Contact</a></li>

						<!-- Cek apakah user sudah login -->
						@if(Auth::check())
						<!-- jika benar, maka terdapat menu logout -->
						<li><a href="{{ route('logout') }}"
							onclick="event.preventDefault();
							document.getElementById('logout-form').submit();"  class="dropdown-item has-icon text-danger">
							Logout
						</a></li>
						<form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
							@csrf
						</form>
						@else						
						<!-- jika salah, maka terdapat menu login dan register -->
						<li><a href="{{route('login')}}">Login</a></li>
						<li><a href="{{route('register')}}">Register</a></li>
						@endif

					</ul>
				</nav>
			</div>
			<div class="mobile-nav-button">
				<button id="trigger-overlay" type="button"><i class="fa fa-bars" aria-hidden="true"></i></button>
			</div>
			<!-- cart details -->
			<div class="top_nav_right">
				<div class="shoecart shoecart2 cart cart box_1">
					<a href="{{route('customer.cart.index')}}" class="btn btn-default"><i class="fa fa-cart-arrow-down" aria-hidden="true"></i></a>
					
				</div>
			</div>
		</div>
	</div>
	<!-- //cart details -->
	<!-- search -->
	<div class="search_w3ls_agileinfo">
		<div class="cd-main-header">
			<ul class="cd-header-buttons">
				<li><a class="cd-search-trigger" href="#cd-search"> <span></span></a></li>
			</ul>
		</div>
		<div id="cd-search" class="cd-search">
			<form action="#" method="post">
				<input name="Search" type="search" placeholder="Click enter after typing...">
			</form>
		</div>
	</div>
	<!-- //search -->
	<div class="clearfix"></div>
	<!-- /banner_inner -->
	<div class="services-breadcrumb_w3ls_agileinfo">
		<div class="inner_breadcrumb_agileits_w3">

			<ul class="short">
				<li><a href="{{route('index')}}">Home</a><i>|</i></li>
				<li>Registered</li>
			</ul>
		</div>
	</div>
	<!-- //banner_inner -->
</div>