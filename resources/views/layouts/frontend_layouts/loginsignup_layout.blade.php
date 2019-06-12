<!DOCTYPE html>
<html lang="en">

    <head>

        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title>Teleco Tales - @yield('title')</title>
        <link rel="icon" href="{{URL::asset('frontend/assets/img/logo-telco-tales.png')}}" type="image/gif" sizes="16x16">
        <!-- CSS Section Include -->
            @include('layouts.frontend_layouts.allcss')
        <!-- End CSS Section Include -->
    </head>

    <body>
        <!-- Content Section Include -->
            @yield('content')
        <!-- End Content Section Include -->
        <!-- Script Section  -->
            @include('layouts.frontend_layouts.alljquery')
        <!-- End Script Section  -->
    </body>


</html>