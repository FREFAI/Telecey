<!DOCTYPE html>
<html lang="en">

    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no, user-scalable=no" />
        <meta charset="utf-8">
        <meta http-equiv="Content-type" content="text/html; charset=utf-8">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>Teleco Tales - @yield('title')</title>
        <link rel="icon" href="{{URL::asset('frontend/assets/img/logo-telco-tales.png')}}" type="image/gif" sizes="16x16">
        <!-- CSS Section Include -->
            @include('layouts.frontend_layouts.allcss')
        <!-- End CSS Section Include -->
    </head>

    <body>
        <div id="loader" class="ajaxloader">
            <div class="loader" id="loader-1"></div>
        </div>
        {{-- <div id="loader" class="ajaxloader">
            <div class="loader" id="loader-1"></div>
        </div> --}}
        <!-- Header Section Include -->
            @include('layouts.frontend_layouts.header')
        <!-- End Header Section Include -->
        <!-- Content Section Include -->
            @yield('content')
        <!-- End Content Section Include -->
        <!-- Footer Section Include -->
            @include('layouts.frontend_layouts.footer')
        <!-- End Footer Section Include -->
        <!-- Script Section  -->
            @include('layouts.frontend_layouts.alljquery')
        <!-- End Script Section  -->
      
    </body>


</html>