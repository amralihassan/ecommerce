<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="rtl">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
  <meta name="description" content="Modern admin is super flexible, powerful, clean &amp; modern responsive bootstrap 4 admin template with unlimited possibilities with bitcoin dashboard.">
  <meta name="keywords" content="admin template, modern admin template, dashboard template, flat admin template, responsive admin template, web app, crypto dashboard, bitcoin dashboard">
  <meta name="author" content="PIXINVENT">
  <title>Crypto Dashboard - Modern Admin - Clean Bootstrap 4 Dashboard HTML Template + Bitcoin
    Dashboard
  </title>
  <link rel="apple-touch-icon" href="../../../app-assets/images/ico/apple-icon-120.png">
  <link rel="shortcut icon" type="image/x-icon" href="../../../app-assets/images/ico/favicon.ico">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Quicksand:300,400,500,700"
  rel="stylesheet">
  <link href="https://maxcdn.icons8.com/fonts/line-awesome/1.1/css/line-awesome.min.css"
  rel="stylesheet">
  <!-- BEGIN VENDOR CSS-->
  <link rel="stylesheet" type="text/css" href="{{asset('cpanel/app-assets/css-rtl/vendors.css')}}">
  <!-- END VENDOR CSS-->
  <!-- BEGIN MODERN CSS-->
  <link rel="stylesheet" type="text/css" href="{{asset('cpanel/app-assets/css-rtl/app.css')}}">
  <link rel="stylesheet" type="text/css" href="{{asset('cpanel/app-assets/css-rtl/custom-rtl.css')}}">
  <!-- END MODERN CSS-->
  <!-- BEGIN Page Level CSS-->

  <link rel="stylesheet" type="text/css" href="{{asset('cpanel/app-assets/css-rtl/core/menu/menu-types/vertical-overlay-menu.css')}}">
  <link rel="stylesheet" type="text/css" href="{{asset('cpanel/app-assets/css-rtl/core/colors/palette-gradient.css')}}">
  <link rel="stylesheet" type="text/css" href="{{asset('cpanel/app-assets/vendors/css/cryptocoins/cryptocoins.css')}}">
  <link rel="stylesheet" type="text/css" href="{{asset('cpanel/app-assets/fonts/line-awesome/css/line-awesome.min.css')}}">
  <!-- END Page Level CSS-->
  <!-- BEGIN Custom CSS-->
  <link rel="stylesheet" type="text/css" href="{{asset('cpanel/app-assets/fonts/simple-line-icons/style.min.css')}}">
  <link rel="stylesheet" type="text/css" href="{{asset('cpanel/assets/css/style-rtl.css')}}">
  <!-- END Custom CSS-->
    <!-- END Custom CSS-->
    <link href="https://fonts.googleapis.com/css?family=Cairo&display=swap" rel="stylesheet">

    <style>
        body,h1,h2,h3,h4,h5,h6,a,li,p,span {
            font-family: 'Cairo', sans-serif;
        }
    </style>
</head>
<body class="vertical-layout vertical-overlay-menu 2-columns   menu-expanded fixed-navbar"
data-open="click" data-menu="vertical-overlay-menu" data-col="2-columns">
  <!-- fixed-top-->
  @include('layouts.frontEnd.includes._nav')
  {{-- sidebar --}}
  @include('layouts.frontEnd.includes._sidebar')

  <div class="app-content content">
    <div class="content-wrapper">
      <div class="content-header row">
      </div>
      <div class="content-body">

      </div>
    </div>
  </div>
  {{-- footer --}}
  @include('layouts.frontEnd.includes._footer')

  <!-- BEGIN VENDOR JS-->
  <script src="{{asset('cpanel/app-assets/vendors/js/vendors.min.js')}}" type="text/javascript"></script>
  <!-- BEGIN VENDOR JS-->
  <!-- BEGIN PAGE VENDOR JS-->
  <script src="{{asset('cpanel/app-assets/vendors/js/charts/chart.min.js')}}" type="text/javascript"></script>
  <script src="{{asset('cpanel/app-assets/vendors/js/charts/echarts/echarts.js')}}" type="text/javascript"></script>
  <!-- END PAGE VENDOR JS-->
  <!-- BEGIN MODERN JS-->
  <script src="{{asset('cpanel/app-assets/js/core/app-menu.js')}}" type="text/javascript"></script>
  <script src="{{asset('cpanel/app-assets/js/core/app.js')}}" type="text/javascript"></script>
  {{-- <script src="{{asset('cpanel/app-assets/js/scripts/customizer.js')}}" type="text/javascript"></script> --}}

</body>
</html>
