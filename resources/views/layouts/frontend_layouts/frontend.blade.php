<!DOCTYPE html>
<html lang="en">

    <head>

        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title>Teleco Tales</title>
        <link rel="icon" href="{{URL::asset('assets/img/fav_icon.png')}}" type="image/gif" sizes="16x16">
        <!-- CSS Section Include -->
            @include('layouts.frontend_layouts.allcss')
        <!-- End CSS Section Include -->
    </head>

    <body>
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