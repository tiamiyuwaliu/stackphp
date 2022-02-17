<!doctype html>
<html lang="en" {{($rtl) ? 'dir="rtl"' : null}}>
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Bootstrap CSS -->
    @if($rtl)
        <link href="{{url('resources/themes/default/css/plugin-rtl.min.css')}}?time={{filemtime(base_path('resources/themes/default/css/plugin-rtl.min.css'))}}" rel="stylesheet"  >
    @else
        <link href="{{url('resources/themes/default/css/plugin.min.css')}}?time={{filemtime(base_path('resources/themes/default/css/plugin.min.css'))}}" rel="stylesheet"  >
    @endif
    <link href="{{url('resources/themes/default/css/'.$pageType.'.css')}}?time={{filemtime(base_path('resources/themes/default/css/'.$pageType.'.css'))}}" rel="stylesheet"  >
        <title>{{$title}}</title>
</head>
<body>
    <div id="cover-loader"><img src="{{url('resources/themes/default/images/loader.gif')}}"/> </div>
    <div id="top-loading"></div>
    <div id="page-container">
        {!! $content !!}
    </div>

<script>
    var baseUrl = '{{url('')}}/';
    var isLoggedIn = {{(\App\Repositories\User::repository()->isLoggedIn()) ? 1 : 0}};
    var strings = {
        are_your_sure: '{{__('messages.are-you-sure')}}',
        yes: '{{__('messages.yes')}}',
        cancel: '{{__('messages.cancel')}}'
    };
</script>
<script src="{{url('resources/themes/default/js/plugin.min.js')}}?time={{filemtime(base_path('resources/themes/default/js/plugin.min.js'))}}" ></script>
<script src="{{url('resources/themes/default/js/app.js')}}?time={{filemtime(base_path('resources/themes/default/js/app.js'))}}" ></script>

</body>
</html>
