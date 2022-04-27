<div class="auth-container row">
    <div class="auth-left col-md-4">
        <video autoplay muted loop id="myVideo">
            <source src="{{url('resources/themes/default/images/video-background.mp4')}}?a=2" type="video/mp4">
        </video>
        <div class="content">
            <img src="{{url('resources/themes/default/images/auth-bg.png')}}?a=3"/>
            <h6>{{__('messages.auth-note')}} </h6>

        </div>
    </div>
    <div class="auth-right col-md-8 modern-scroll">
        <div class="header clearfix">
            <div class="float-start">
                <img src="{{config('site_logo','resources/themes/default/images/logo.png')}}"/>
            </div>
            <div class="float-end">
                {{__('messages.language')}}: <a href="">English</a>
            </div>
        </div>
        {!! $content !!}

        <div class="footer">
            @if(app('request')->segment(1) == 'login')
                {{__('messages.dont-have-account')}} <a data-ajax="true" href="{{url('signup')}}">{{__('messages.create-new-account')}}</a>
            @else
                {{__('messages.already-have-account')}} <a data-ajax="true" href="{{url('login')}}">{{__('messages.login')}}</a>
            @endif
        </div>
    </div>
</div>
