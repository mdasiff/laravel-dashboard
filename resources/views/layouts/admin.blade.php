<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }} | Dashboard</title>

    <!-- favicon -->
    <link rel="shortcut icon" href="{{asset('images/logo/logo.png')}}">
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{asset('plugins/fontawesome-free/css/all.min.css')}}">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Tempusdominus Bootstrap 4 -->
    <link rel="stylesheet" href="{{asset('plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css')}}">
    <!-- iCheck -->
    <link rel="stylesheet" href="{{asset('plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}">
    <!-- JQVMap -->
    <link rel="stylesheet" href="{{asset('plugins/jqvmap/jqvmap.min.css')}}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{asset('dist/css/adminlte.min.css')}}">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="{{asset('plugins/overlayScrollbars/css/OverlayScrollbars.min.css')}}">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="{{asset('plugins/daterangepicker/daterangepicker.css')}}">
    <!-- summernote -->
    <link rel="stylesheet" href="{{asset('plugins/summernote/summernote-bs4.min.css')}}">

    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.3/css/dataTables.bootstrap5.css">
    <link rel="stylesheet" href="{{asset('admin/css/style.css')}}">

    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.20/jquery.datetimepicker.min.css" />


    <style type="text/css">
      fieldset {
        border: solid 1px #ccc !important;
        padding: 15px !important;
        margin-bottom: 20px;
      }
      legend {
        display: inline !important;
        width: auto !important;
      }
      .btn-group>.btn-group:not(:last-child)>.btn, .btn-group>.btn:not(:last-child):not(.dropdown-toggle) {
        border-right: 2px solid #fff3f3;
      }
      .nav-link {
        padding: 3px 1rem !important;
      }
      .nav-sidebar .nav-link p {
        font-size: 14px !important;
      }
      .nav-sidebar>.nav-item .nav-icon.fa, .nav-sidebar>.nav-item .nav-icon.fab, .nav-sidebar>.nav-item .nav-icon.fad, .nav-sidebar>.nav-item .nav-icon.fal, .nav-sidebar>.nav-item .nav-icon.far, .nav-sidebar>.nav-item .nav-icon.fas, .nav-sidebar>.nav-item .nav-icon.ion, .nav-sidebar>.nav-item .nav-icon.svg-inline--fa {
        font-size: 14px !important;
      }
      .brand-link {
        padding-top: 5px !important;
        padding-bottom: 5px !important;
        text-align: center !important;
      }
    </style>
    @stack('css')
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">
        
        
  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Navbar Search -->
     
      <!-- Messages Dropdown Menu -->
      
      <!-- Notifications Dropdown Menu -->
      <li class="nav-item pt-2"><p> Logged In As 
      @php $logout = 'admin.logout' @endphp
      
      @auth("admin")
        {{ Auth::guard('admin')->user()->name }}
        @php $logout = 'admin.logout' @endphp
      @endauth

      </p></li>
      
      <li class="nav-item">
        <form id="logout-form" action="{{ route($logout) }}" method="POST" style="display: none;">
            @csrf
        </form>
        <a href="#" class="nav-link" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
            <i class="nav-icon fas fa-power-off"></i> Logout
        </a>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ route('admin.dashboard') }}" class="brand-link border-bottom-0 mb-1 pt-4 pl-4">
      <img src="{{asset('images/logo/logo.png')}}" width="80" height="34" class="h-auto" alt="{{ config('app.name', 'Laravel') }}">
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      
      <!-- SidebarSearch Form -->
      

      <!-- Sidebar Menu -->
      <nav class="mt-2">

        @auth('admin')
        @component('layouts.nav.admin')
        @endcomponent
        @endauth


      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
            @yield('content')
        
    
<!-- /.content-wrapper -->
<footer class="main-footer">
    <strong>Copyright &copy; {{date('Y')}}</strong>
    All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
      <b>Version</b> 3.2.0
    </div>
  </footer>

</div>
<!-- jQuery -->
<script src="{{asset('plugins/jquery/jquery.min.js')}}"></script>
<!-- jQuery UI 1.11.4 -->
<script src="{{asset('plugins/jquery-ui/jquery-ui.min.js')}}"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="{{asset('plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>

<!-- JQVMap -->
<script src="{{asset('plugins/jqvmap/jquery.vmap.min.js')}}"></script>
<script src="{{asset('plugins/jqvmap/maps/jquery.vmap.usa.js')}}"></script>
<!-- jQuery Knob Chart -->
<script src="{{asset('plugins/jquery-knob/jquery.knob.min.js')}}"></script>
<!-- daterangepicker -->
<script src="{{asset('plugins/moment/moment.min.js')}}"></script>
<script src="{{asset('plugins/daterangepicker/daterangepicker.js')}}"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="{{asset('plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js')}}"></script>
<!-- Summernote -->
<script src="{{asset('plugins/summernote/summernote-bs4.min.js')}}"></script>
<!-- overlayScrollbars -->
<script src="{{asset('plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{asset('dist/js/adminlte.js')}}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{asset('dist/js/demo.js')}}"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="{{asset('dist/js/pages/dashboard.js')}}"></script>
<script src="{{asset('admin/js/myscript.js')}}"></script>

<script src="https://cdn.datatables.net/2.0.3/js/dataTables.js"></script>
<script src="https://cdn.datatables.net/2.0.3/js/dataTables.bootstrap5.js"></script>

<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>

<script src=
"https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.20/jquery.datetimepicker.full.min.js">
    </script>


<script>
$('#example').DataTable();
$('.select2').select2();
$('.summernote').summernote({
        placeholder: 'Write Here...',
        tabsize: 2,
        height: 200
      });
$(function() {
  $('.datepicker').daterangepicker({
    singleDatePicker: true,
    timePicker: true,
    locale: {
      format: 'YYYY-MM-DD hh:mm a'
    }
    
  });
});

</script>
@stack('js')
</body>
</html>
