<!DOCTYPE html>
<html>

  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Start your development with a Dashboard for Bootstrap 4.">
    <meta name="author" content="Creative Tim">
    <title>Argon Dashboard - Free Dashboard for Bootstrap 4</title>
    <!-- Favicon -->
    <link href="{{URL::asset('frontend/assets/img/fav_icon.png')}}" rel="icon" type="image/png">
    <!-- CSS Section Include -->
        @include('layouts.admin_layouts.allcss')
    <!-- End CSS Section Include -->
  </head>

  <body class="bg-default">
      <!-- Content Section Include -->
          @yield('content')
      <!-- End Content Section Include -->

    <!-- Argon Scripts -->
    <!-- Script Section  -->
        @include('layouts.admin_layouts.alljquery')
    <!-- End Script Section  -->
  </body>

</html>