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
    <link rel="stylesheet" href="{{asset('css/checkout.css')}}">
    <link rel="stylesheet" href="{{asset('css/flexslider.css')}}">
    <link rel="stylesheet" href="{{asset('css/easy-responsive-tabs.css')}}">

    <!-- OWL caraousel -->
    <link rel="stylesheet" href="{{asset('css/jquery-ui1.css')}}">
    <link rel="stylesheet" href="{{asset('css/style.css')}}">

    <!-- izitaost -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/izitoast/1.4.0/css/iziToast.min.css" integrity="sha512-O03ntXoVqaGUTAeAmvQ2YSzkCvclZEcPQu1eqloPaHfJ5RuNGiS4l+3duaidD801P50J28EHyonCV06CUlTSag==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/izitoast/1.4.0/js/iziToast.min.js"></script>

    <!-- font awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

    <!-- font -->
    <link href="//fonts.googleapis.com/css?family=Montserrat:100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800"
	    rel="stylesheet">
	  <link href="//fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i,800" rel="stylesheet">

</head>
<body>
    <!-- content page -->
    @include('partials.navbar')
    @yield('content')
    @include('partials.footer')
    <!-- jquery -->
    <script src="{{asset('js/jquery-2.1.4.min.js')}}"></script>

    <!-- bootstrap -->
    <script src="{{asset('js/bootstrap-3.1.1.min.js')}}"></script>

    <!-- nav -->
    <script src="{{asset('js/modernizr-2.6.2.min.js')}}"></script>
    <script src="{{asset('js/classie.js')}}"></script>
    <script src="{{asset('js/demo1.js')}}"></script>

    <!-- single -->
    <script src="{{asset('js/imagezoom.js')}}"></script>
  

    @yield('checkout')

    <!-- responsive tab -->
    <script src="{{asset('js/easy-responsive-tabs.js')}}"></script>
    <script>
		$(document).ready(function () {
			$('#horizontalTab').easyResponsiveTabs({
				type: 'default', //Types: default, vertical, accordion           
				width: 'auto', //auto or any width like 600px
				fit: true, // 100% fit in a container
				closed: 'accordion', // Start closed if in accordion view
				activate: function (event) { // Callback function if tab is switched
					var $tab = $(this);
					var $info = $('#tabInfo');
					var $name = $('span', $info);
					$name.text($tab.text());
					$info.show();
				}
			});
			$('#verticalTab').easyResponsiveTabs({
				type: 'vertical',
				width: 'auto',
				fit: true
			});
		});
	</script>

  <!-- Notifikasi Izitoast -->    
  <script>
    @if(Session::has('success'))
        iziToast.success({
            title: 'Berhasil',
            message: '{{ Session::get('success') }}',
            position: 'topRight'
        });
    @elseif(Session::has('gagal'))
        iziToast.error({
            title: 'Gagal',
            message: '{{ Session::get('gagal') }}',
            position: 'topRight'
        });
    @endif

      @if ($errors->any())
          @foreach ($errors->all() as $error)
              iziToast.error({
                  title: 'Gagal',
                  message: '{{ $error }}',
                  position: 'topRight'
              });
          @endforeach
      @endif
  </script>

    <!-- Flexslider -->
    <script src="{{asset('js/jquery.flexslider.js')}}"></script>
    <script>
		// Can also be used with $(document).ready()
		$(window).load(function () {
			$('.flexslider').flexslider({
				animation: "slide",
				controlNav: "thumbnails"
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