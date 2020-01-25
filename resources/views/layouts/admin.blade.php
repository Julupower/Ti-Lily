<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title', 'Ti and Lily Admin Dashboard')</title>
    <link rel="stylesheet" href="{{asset('admin/assets/vendor/simple-line-icons/css/simple-line-icons.css')}}">
    <link rel="stylesheet" href="{{asset('admin/assets/vendor/font-awesome/css/fontawesome-all.min.css')}}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="{{asset('admin/assets/css/styles.css')}}">
    <!-- summernote WYSIWYG editor -->
    <link rel="stylesheet" type="text/css" href="{{ asset('/assets/summernote/summernote-lite.css') }} "/>
    @yield('links')
</head>
<body class="sidebar-fixed header-fixed">
<div class="page-wrapper">
    <!-- Header Navigation Bar -->
   @include('includes.admin.headerNavigation')

    <div class="main-container">
        <!-- Side Bar Navigation -->
        @include('includes.admin.sidebarNavigation')

        <!-- Main Content -->
        @yield('content')
       
    </div>
</div>
<script src="{{asset('admin/assets/vendor/jquery/jquery.min.js')}}"></script>
<script src="{{asset('admin/assets/vendor/popper.js/popper.min.js')}}"></script>
<script src="{{asset('admin/assets/vendor/bootstrap/js/bootstrap.min.js')}}"></script>
<script src="{{asset('admin/assets/vendor/chart.js/chart.min.js')}}"></script>
<script src="{{asset('admin/assets/js/carbon.js')}}"></script>
<script src="{{asset('admin/assets/js/demo.js')}}"></script>
<!-- summernote WYSIWYG editor -->
<script src="{{ asset('/assets/summernote/summernote-lite.js') }}"></script>
<script type="text/javascript">
    //summernote script
      $('.summernote').summernote({
      tabsize: 2,
      height: 200
    });
</script>
@yield('scripts')
</body>
</html>
