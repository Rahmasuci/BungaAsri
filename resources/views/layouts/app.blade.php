<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-Commerce | @yield('title')</title>

    <!-- css -->
    <link rel="stylesheet" href="{{asset('css/bootstrap.css')}}">
    <link rel="stylesheet" href="{{asset('css/shop.css')}}">
    <link rel="stylesheet" href="{{asset('css/style7.css')}}">

    <!-- OWL caraousel -->
    <link rel="stylesheet" href="{{asset('css/jquery-ui1.css')}}">
    <link rel="stylesheet" href="{{asset('css/style.css')}}">

    <!-- font awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

    <!-- font -->
    <link href="//fonts.googleapis.com/css?family=Montserrat:100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800"
	    rel="stylesheet">
	<link href="//fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i,800" rel="stylesheet">

</head>
<body>
    <!-- content page -->
    @include('partials.banner')

    @yield('content')

    @include('partials.footer')
    <a href="#home" id="toTop" class="scroll" style="display: block;"> <span id="toTopHover" style="opacity: 1;"> </span></a>
    <!-- jquery -->
    <script src="{{asset('js/jquery-2.1.4.min.js')}}"></script>

    <!-- bootstrap -->
    <script src="{{asset('js/bootstrap-3.1.1.min.js')}}"></script>

    <!-- nav -->
    <script src="{{asset('js/modernizr-2.6.2.min.js')}}"></script>
    <script src="{{asset('js/classie.js')}}"></script>
    <script src="{{asset('js/demo1.js')}}"></script>

    <!-- slide -->
    <script src="{{asset('js/responsiveslides.min.js')}}"></script>
    <script>
	  $(function () {
			$("#slider4").responsiveSlides({
				auto: true,
				pager: true,
				nav: true,
				speed: 1000,
				namespace: "callbacks",
				before: function () {
					$('.events').append("<li>before event fired.</li>");
				},
				after: function () {
					$('.events').append("<li>after event fired.</li>");
				}
			});
		});
	</script>

    <!-- search bar -->
    <script src="{{asset('js/search.js')}}"></script>

    <!-- smooth scrolling -->
    <script src="{{asset('js/move-top.js')}}"></script>
    <script src="{{asset('js/easing.js')}}"></script>
    <script type="text/javascript">
		jQuery(document).ready(function ($) {
			$(".scroll").click(function (event) {
				event.preventDefault();
				$('html,body').animate({
					scrollTop: $(this.hash).offset().top
				}, 1000);
			});
		});
	</script>
</body>
</html>