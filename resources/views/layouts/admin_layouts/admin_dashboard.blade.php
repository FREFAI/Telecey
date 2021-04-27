<!DOCTYPE html>
<html>

  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="author" content="Creative Tim">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Telecey - @yield('title')</title>
    <!-- Favicon -->
    <link href="{{URL::asset('frontend/assets/img/logo-telco-tales.png')}}" rel="icon" type="image/png">
    <!-- CSS Section Include -->
        @include('layouts.admin_layouts.allcss')
    <!-- End CSS Section Include -->
  </head>

  <body>
    <!-- Header Section Include -->
        @include('layouts.admin_layouts.header')
    <!-- End Header Section Include -->
    <!-- Content Section Include -->
        @yield('content')
    <!-- End Content Section Include -->
    <!-- Script Section  -->
        @include('layouts.admin_layouts.alljquery')
    <!-- End Script Section  -->
    <!-- Custome Script Section  -->
        @include('layouts.admin_layouts.js.settings_js')
    <!-- Custome Script Section  -->

    <div class="sendEmailModalOverLay"></div>
  </body>

</html>