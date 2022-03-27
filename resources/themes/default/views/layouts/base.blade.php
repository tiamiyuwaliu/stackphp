<!doctype html>
<html lang="en" {{($rtl) ? 'dir="rtl"' : null}}>
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @if($pageType == 'frontend')
        <link href="{{url('resources/themes/default/css/plugin.min.css')}}?time={{filemtime(base_path('resources/themes/default/css/plugin.min.css'))}}" rel="stylesheet"  >

        <link rel="stylesheet" href="{{url('resources/themes/default/css/custom.css')}}?11">
        <!--icon font css-->
        <link rel="stylesheet" href="{{url('resources/themes/default/vendors/themify-icon/themify-icons.css')}}">
        <link rel="stylesheet" href="{{url('resources/themes/default/vendors/simple-line-icon/simple-line-icons.css')}}">
        <link rel="stylesheet" href="{{url('resources/themes/default/vendors/font-awesome/css/all.css')}}">
        <link rel="stylesheet" href="{{url('resources/themes/default/vendors/flaticon/flaticon.css')}}">
        <link rel="stylesheet" href="{{url('resources/themes/default/vendors/animation/animate.css')}}">
        <link rel="stylesheet" href="{{url('resources/themes/default/vendors/owl-carousel/assets/owl.carousel.min.css')}}">
        <link rel="stylesheet" href="{{url('resources/themes/default/vendors/animation/animate.css')}}">
        <link rel="stylesheet" href="{{url('resources/themes/default/vendors/magnify-pop/magnific-popup.css')}}">
        <link rel="stylesheet" href="{{url('resources/themes/default/vendors/elagent/style.css')}}">
        <link rel="stylesheet" href="{{url('resources/themes/default/vendors/scroll/jquery.mCustomScrollbar.min.css')}}">

        <link href="{{url('resources/themes/default/css/'.$pageType.'.css')}}?time={{filemtime(base_path('resources/themes/default/css/'.$pageType.'.css'))}}" rel="stylesheet"  >

    @else
        @if($rtl)
            <link href="{{url('resources/themes/default/css/plugin-rtl.min.css')}}?time={{filemtime(base_path('resources/themes/default/css/plugin-rtl.min.css'))}}" rel="stylesheet"  >
        @else
            <link href="{{url('resources/themes/default/css/plugin.min.css')}}?time={{filemtime(base_path('resources/themes/default/css/plugin.min.css'))}}" rel="stylesheet"  >
        @endif
        <link href="{{url('resources/themes/default/css/'.$pageType.'.css')}}?time={{filemtime(base_path('resources/themes/default/css/'.$pageType.'.css'))}}" rel="stylesheet"  >

    @endif
            <title>{{$title}}</title>
</head>
<body>
    @if($pageType == 'frontend')
        {!! $content !!}
    @else
        <div id="cover-loader"><img src="{{url('resources/themes/default/images/loader.gif')}}"/> </div>
        <div id="top-loading"></div>
        <div id="page-container">
            {!! $content !!}
        </div>
    @endif
<script>
    var baseUrl = '{{url('')}}/';
    var isLoggedIn = {{(\App\Repositories\User::repository()->isLoggedIn()) ? 1 : 0}};
    var strings = {
        are_your_sure: '{{__('messages.are-you-sure')}}',
        yes: '{{__('messages.yes')}}',
        cancel: '{{__('messages.cancel')}}'
    };
</script>

    @if($pageType == 'frontend')
        <script src="{{url('resources/themes/default/js/plugin.min.js')}}?time={{filemtime(base_path('resources/themes/default/js/plugin.min.js'))}}" ></script>

        <script src="{{url('resources/themes/default/vendors/wow/wow.min.js')}}"></script>
        <script src="{{url('resources/themes/default/vendors/sckroller/jquery.parallax-scroll.js')}}"></script>
        <script src="{{url('resources/themes/default/vendors/owl-carousel/owl.carousel.min.js')}}"></script>
        <script src="{{url('resources/themes/default/vendors/imagesloaded/imagesloaded.pkgd.min.js')}}"></script>
        <script src="{{url('resources/themes/default/vendors/isotope/isotope-min.js')}}"></script>
        <script src="{{url('resources/themes/default/vendors/magnify-pop/jquery.magnific-popup.min.js')}}"></script>
        <script src="{{url('resources/themes/default/vendors/counterup/jquery.counterup.min.js')}}"></script>
        <script src="{{url('resources/themes/default/vendors/counterup/jquery.waypoints.min.js')}}"></script>
        <script src="{{url('resources/themes/default/vendors/counterup/appear.js')}}"></script>
        <script src="{{url('resources/themes/default/vendors/circle-progress/circle-progress.js')}}"></script>
        <script src="{{url('resources/themes/default/vendors/stellar/jquery.stellar.js')}}"></script>
        <script src="{{url('resources/themes/default/vendors/scroll/jquery.mCustomScrollbar.concat.min.js')}}"></script>
        <script src="{{url('resources/themes/default/js/plugins.js')}}"></script>
        <script src="{{url('resources/themes/default/vendors/red-countdown/knob.js')}}"></script>
        <script src="{{url('resources/themes/default/vendors/red-countdown/throttle.js')}}"></script>
        <script src="{{url('resources/themes/default/vendors/red-countdown/moment.js')}}"></script>
        <script src="{{url('resources/themes/default/vendors/red-countdown/redcountdown.js')}}"></script>
        <script src="{{url('resources/themes/default/vendors/red-countdown/red-countdown-settings.js')}}"></script>
        <script src="{{url('resources/themes/default/js/plugins.js')}}"></script>
        <script src="{{url('resources/themes/default/js/main.js')}}"></script>
        <script src="{{url('resources/themes/default/js/app.js')}}?time={{filemtime(base_path('resources/themes/default/js/app.js'))}}" ></script>
    @else
        <script src="{{url('resources/themes/default/js/plugin.min.js')}}?time={{filemtime(base_path('resources/themes/default/js/plugin.min.js'))}}" ></script>
        <script src="{{url('resources/themes/default/js/app.js')}}?time={{filemtime(base_path('resources/themes/default/js/app.js'))}}" ></script>
    @endif


</body>
</html>
