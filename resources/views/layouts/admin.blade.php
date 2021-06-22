<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-Commerce | @yield('title')</title>
    <!-- Bootstrap -->
    <link rel="stylesheet" href="{{asset('css/admin/bootstrap.min.css')}}">
    <!-- Fontawesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <!-- Themify Icom -->
    <link rel="stylesheet" href="{{asset('css/admin/themify-icons.css')}}">
    <!-- Metis Menu -->
    <link rel="stylesheet" href="{{asset('css/admin/metisMenu.css')}}">
    <!-- Owl Caraousel -->
    <link rel="stylesheet" href="{{asset('css/admin/owl.carousel.min.css')}}">
    <!-- Slick Nav -->
    <link rel="stylesheet" href="{{asset('css/admin/slicknav.min.css')}}">
    <!-- Amchart CSS -->
    <link rel="stylesheet" href="https://www.amcharts.com/lib/3/plugins/export/export.css">
    <!-- Data Table -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.jqueryui.min.css">
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.5.2/css/buttons.dataTables.min.css">
    <!-- Others -->
    <link rel="stylesheet" href="{{asset('css/admin/typography.css')}}">
    <link rel="stylesheet" href="{{asset('css/admin/default-css.css')}}">
    <link rel="stylesheet" href="{{asset('css/admin/styles.css')}}">
    <link rel="stylesheet" href="{{asset('css/admin/responsive.css')}}">
    <!-- modernizr css -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.3/modernizr.min.js"></script> 
    <style>
        .pull-right{
            float: right !important;
        }
    </style>
    
    <!-- izitaost -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/izitoast/1.4.0/css/iziToast.min.css" integrity="sha512-O03ntXoVqaGUTAeAmvQ2YSzkCvclZEcPQu1eqloPaHfJ5RuNGiS4l+3duaidD801P50J28EHyonCV06CUlTSag==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/izitoast/1.4.0/js/iziToast.min.js"></script>
</head>
<body>
    <div class="page-container">  
        @include('partials.admin_sidebar')     
        <div class="main-content">
            @include('partials.admin_nav')
            @yield('content')
        </div>
        @include('partials.admin_footer')
    </div>
    <script src="{{asset('js/admin/vendor/jquery-2.2.4.min.js')}}"></script>
    <script src="{{asset('js/admin/popper.min.js')}}"></script>
    <script src="{{asset('js/admin/bootstrap.min.js')}}"></script>
    <script src="{{asset('js/admin/owl.carousel.min.js')}}"></script>
    <script src="{{asset('js/admin/metisMenu.min.js')}}"></script>
    <script src="{{asset('js/admin/jquery.slimscroll.min.js')}}"></script>
    <script src="{{asset('js/admin/jquery.slicknav.min.js')}}"></script>
    <!-- Data Table -->
    <script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.print.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.js"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.3/js/responsive.bootstrap.min.js"></script>
	<script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.html5.min.js"></script>
    <!-- Notifikasi Izitoast -->    
    <script>
        @if(Session::has('success'))
            iziToast.success({
                title: 'Berhasil',
                message: '{{ Session::get('success') }}',
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

    @yield('addJs')
    
     <!-- start chart js -->
     <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.min.js"></script>
    <!-- start highcharts js -->
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <!-- start zingchart js -->
    <script src="https://cdn.zingchart.com/zingchart.min.js"></script>
    <script>
    zingchart.MODULESDIR = "https://cdn.zingchart.com/modules/";
    ZC.LICENSE = ["569d52cefae586f634c54f86dc99e6a9", "ee6b7db5b51705a13dc2339db3edaf6d"];
    </script>

    <script src="{{asset('js/admin/line-chart.js')}}"></script>
    <script src="{{asset('js/admin/pie-chart.js')}}"></script>
    <script src="{{asset('js/admin/plugins.js')}}"></script>
    <script src="{{asset('js/admin/scripts.js')}}"></script>
</body>
</html>