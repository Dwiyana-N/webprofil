<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>@yield('title')</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="{{asset('backend/img/favicon.png')}}" rel="icon">
  @yield('meta')
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{asset('backend/plugins/fontawesome-free/css/all.min.css')}}">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="{{asset('backend/plugins/overlayScrollbars/css/OverlayScrollbars.min.css')}}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{asset('backend/css/adminlte.min.css')}}">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
  @yield('top-resource')
  <link href="{{asset('backend/plugins/jquery-slimScroll/libs/prettify/prettify.css')}}" type="text/css" rel="stylesheet" />
  <style>
  .pagination {
    display: -ms-flexbox;
    flex-wrap: wrap;
    display: flex;
    padding-left: 0;
    list-style: none;
    border-radius: 0.25rem;
  }
  </style>
  <style>
    .preloader {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        z-index: 9999;
        background-color: rgb(0, 0, 0);
        opacity: 0.9;
    }
    .preloader .loading {
        position: absolute;
        left: 50%;
        top: 50%;
        transform: translate(-50%, -50%);
        font: 14px arial;
    }
  </style>
</head>
<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed">
<!-- preloader -->
<div class="preloader">
  <div class="loading">
    <img src="{{asset('assets/img/loader.gif')}}" width="240">
    <center> <strong><h3 class="text-white">Harap Tunggu</h3></strong> </center>
  </div>
</div>

<!-- Site wrapper -->
<div id="">
  <div class="wrapper">
    @include('admin.layouts.sidebar')
    <div id="body">
    @include('admin.layouts.navbar')
    @yield('content')
    @include('admin.layouts.footer')
    </div>
  </div>
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="{{asset('backend/plugins/jquery/jquery.min.js')}}"></script>
<!-- jQuery UI 1.11.4 -->
<script src="{{asset('backend/plugins/jquery-ui/jquery-ui.min.js')}}"></script>
<!-- Bootstrap 4 -->
<script src="{{asset('backend/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- overlayScrollbars -->
<script src="{{asset('backend/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js')}}"></script>
<!-- slimScroll -->
<script src="{{asset('backend/plugins/jquery-slimScroll/jquery.slimscroll.js')}}"></script>
<script src="{{asset('backend/plugins/jquery-slimScroll/libs/prettify/prettify.js')}}" type="text/javascript" ></script>
<!-- AdminLTE App -->
<script src="{{asset('backend/js/adminlte.min.js')}}"></script>
<!-- SweetAlert -->
<script src="{{asset('backend/js/sweetalert.min.js')}}"></script>
@yield('bottom-resource')
<script type="text/javascript">
    $(function(){
      $("#body").slimScroll({
        size: '7px',
        width: '100%',
        height: '100vh',
        color: '#6c757d',
        distance: '3px',
        wheelStep: 11,
        disableFadeOut: false,
        allowPageScroll: true
      });
    });
</script>
<script>
  $(window).on('load', function () {
      setTimeout(removeLoader, 2000); //wait for page load PLUS two seconds.
  });
  function removeLoader() {
      $(".preloader").fadeOut(500, function () {
          // fadeOut complete. Remove the loading div
          $(".preloader").remove(); //makes page Selengkapnya lightweight
      });
  }
</script>
<script>
    //sweetalert for success or error message
    @if(session()->has('success'))
        swal({
            type: "success",
            icon: "success",
            title: "BERHASIL!",
            text: "{{ session('success') }}",
            timer: 2200,
            showConfirmButton: false,
            showCancelButton: false,
            buttons: false,
        });
        @elseif(session()->has('error'))
        swal({
            type: "error",
            icon: "error",
            title: "GAGAL!",
            text: "{{ session('error') }}",
            timer: 9900,
            showConfirmButton: false,
            showCancelButton: true,
            buttons: true,
        });
        @endif
</script>
</body>
</html>
