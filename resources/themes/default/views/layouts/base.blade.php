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
        cancel: '{{__('messages.cancel')}}',
        notImageError: '{{__('messages.not-image-file')}}',
        notImageVideoError: '{{__('messages.not-image-or-video-file')}}',
        allowFileSizeError: '{{__('messages.file-size-limit-reach')}}',
        empty_post_content: '{{__('messages.empty-post-content')}}',
        empty_post_account: '{{__('messages.empty-post-account')}}'
    };
    var allowImage = '{{config('allowed-image-extensions', 'jpg,png,jpeg,gif')}}';
    var allowVideo = '{{config('allowed-video-extensions', 'mp4,flv,wav,mov,avi,webm,wav,mpeg')}}';
    var allowFiles = '{{config('allowed-extensions', 'jpg,png,jpeg,gif,mkv,docx,zip,rar,pdf,doc,mp3,mp4,flv,wav,txt,mov,avi,webm,wav,mpeg')}}';
    var allowFileSize = {{config('upload-size', 10)  * 1024 * 1000}};
    var googleDriveClientId = '{{config('google-drive-client-id')}}';
    var scope = ['https://www.googleapis.com/auth/drive.file'];
    var pickerApiLoaded = false;
    var googleDriveDeveloperKey = '{{config('google-drive-api-key')}}';
</script>

    @if($pageType == 'app')
        @if(config('enable-google-drive', false))
            <script  defer type="text/javascript" src="https://apis.google.com/js/api.js"></script>
            @endif
        @if(config('enable-dropbox', false))
            <script defer type="text/javascript" src="https://www.dropbox.com/static/api/2/dropins.js" id="dropboxjs" data-app-key="{{config('dropbox-api-key', '')}}"></script>
            @endif

        @if(config('enable-canva', false))
            <script type="text/javascript">
                (function (document, url) {
                    var script = document.createElement('script');
                    script.src = url;
                    script.onload = function () {
                        // API initialization
                        if (window.Canva && window.Canva.DesignButton) {

                            window.Canva.DesignButton.initialize({
                                apiKey: '{{config('canva-api-key')}}',
                            }).then(function (api) {
                                window.canvaAPI = api;
                            })

                        }
                    };
                    document.body.appendChild(script);
                })(document, 'https://sdk.canva.com/designbutton/v2/api.js');
            </script>
            @endif
    @endif
<script src="{{url('resources/themes/default/js/plugin.min.js')}}?time={{filemtime(base_path('resources/themes/default/js/plugin.min.js'))}}" ></script>
<script src="{{url('resources/themes/default/js/app.js')}}?time={{filemtime(base_path('resources/themes/default/js/app.js'))}}" ></script>

</body>
</html>
