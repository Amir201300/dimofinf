<!DOCTYPE html>
<html dir="ltr" lang="en">


<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="{{asset('Admin/assets/images/favicon.png')}}">
    <title>@yield('title')</title>
    <!-- Custom CSS -->
    <link href="{{asset('Admin/assets/extra-libs/c3/c3.min.css')}}" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="{{asset('Admin/dist/css/style.min.css')}}" rel="stylesheet">
    <link href="{{asset('Admin/toast/jquery.toast.css')}}" rel="stylesheet"/>
    @yield('style')
</head>

<body>
<div class="preloader">
    <div class="lds-ripple">
        <div class="lds-pos"></div>
        <div class="lds-pos"></div>
    </div>
</div>
<div id="main-wrapper">

    @include('Admin.includes.layouts.header')
    @include('Admin.includes.layouts.sidebar')
    @yield('header')

    @yield('content')

</div>

{{--@include('include.Admin.DeleteModel')--}}


<script src="{{asset('Admin/assets/libs/jquery/dist/jquery.min.js')}}"></script>

<!-- Bootstrap tether Core JavaScript -->
<script src="{{asset('Admin/assets/libs/popper.js/dist/umd/popper.min.js')}}"></script>
<script src="{{asset('Admin/assets/libs/bootstrap/dist/js/bootstrap.min.js')}}"></script>
<!-- apps -->
<script src="{{asset('Admin/dist/js/app.min.js')}}"></script>
<!-- Theme settings -->
<script src="{{asset('Admin/dist/js/app.init.js')}}"></script>
<script src="{{asset('Admin/dist/js/app-style-switcher.js')}}"></script>
<!-- slimscrollbar scrollbar JavaScript -->
<script src="{{asset('Admin/assets/libs/perfect-scrollbar/dist/perfect-scrollbar.jquery.min.js')}}"></script>
<script src="{{asset('Admin/assets/extra-libs/sparkline/sparkline.js')}}"></script>
<!--Wave Effects -->
<script src="{{asset('Admin/dist/js/waves.js')}}"></script>
<!--Menu sidebar -->
<script src="{{asset('Admin/dist/js/sidebarmenu.js')}}"></script>
<!--Custom JavaScript -->
<script src="{{asset('Admin/dist/js/custom.min.js')}}"></script>
<!--This page JavaScript -->
<!--c3 JavaScript -->
<script src="{{asset('Admin/assets/extra-libs/c3/d3.min.js')}}"></script>
<script src="{{asset('Admin/assets/extra-libs/c3/c3.min.js')}}"></script>
<script src="{{asset('Admin/dist/js/pages/dashboards/dashboard3.js')}}"></script>
<script src="{{asset('Admin/toast/jquery.toast.js')}}"></script>
@yield('script')


</body>
</html>
