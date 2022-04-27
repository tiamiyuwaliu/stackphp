<?php
$settings = perfectUnserialize($link->settings);
$gradients = \App\Repositories\Builder::repository()->availableGradients();
$fontWeight = 200;
if ($settings['text-saturation'] == 'light') $fontWeight = 'lighter';
if ($settings['text-saturation'] == 'medium') $fontWeight = '400';
if ($settings['text-saturation'] == 'bold') $fontWeight = '600';
$brandName = config('link-branding', 'By Social Box');
$brandUrl = url('/');
if ($settings['branding-name']) $brandName = $settings['branding-name'];
if ($settings['branding-url']) $brandUrl = $settings['branding-url'];
?>
<style>
    .viewer-container {
        background: #fff;
        @if($settings['solid-color'])
            background: {{$settings['solid-color']}};
        @endif
        @if($settings['background-type'] == 'custom-gradient')
            background-image: linear-gradient(43deg, {{$settings['gradient-color1']}} 0%, {{$settings['gradient-color2']}} 46%, #FFCC70 100%);
        @elseif($settings['background-type'] == 'gradient')
            background-image: {{$gradients[$settings['defined-gradient']]}};
        @elseif($settings['background-type'] == 'custom-image')
            background-image: url({{url($settings['background-image'])}});
            background-position:center;
            background-size:cover;
        @endif
        width: 100%;
        height: 100vh;
        font-size: {{$settings['font-size']}} !important;
        font-family: {{$settings['font']}};
        font-weight: {{$fontWeight}};
        overflow: auto;
        overflow-x: hidden;
        text-align: center;
        padding: 10px 15px;
    }
    .container {
        max-width:600px;
        padding: 30px 0;
    }
    .avatar {
        margin: 10px auto;
        background-position: center;
        background-size: cover;
    }
    .avatar.rounded {
        border-radius:100px !important;
    }
    .avatar.round  {
        border-radius:10px !important;
    }
    p{
        font-size: {{$settings['font-size']}} !important;
    }
    .social-links-container {
        margin: 10px;
    }
    .social-links-container a {
        font-size: 35px;
        margin: 5px;
    }
    .link-tag {
        display: block;
        padding: 13px 20px;
        margin-bottom: 15px;
        font-size: 17px;
    }
    .link-tag.large {
        padding: 25px 20px;
        font-size: 25px;
    }
    .link-tag.round{
        border-radius:10px;
    }
    .link-tag.rounded{
        border-radius:40px !important;
    }
    .brand-link {
        color: {{$settings['branding-color']}};
        display: block;
        margin-top: 40px;
    }
    .image-link {
        display: block;
        margin: 10px 0;
        text-align: center;
    }
    .image-link img {
        max-width: 100%;
    }

    @media(max-width: 768px) {
        .link-tag{
            padding: 13px 20px;
            font-size: 13px;
        }
        .link-tag.large {
            padding: 15px 20px;
            font-size: 18px;
        }
    }
</style>


<div class="viewer-container">
    <div class="container" >
        @foreach(\App\Repositories\Builder::repository()->getWidgets($link->id) as $widget)
            {!! view('app/builder/bio/display/'.$widget->block_title, ['link' => $link, 'settings' => perfectUnserialize($widget->settings)]) !!}
        @endforeach

        @if($settings['display-branding'])
            <a class="brand-link" href="{{$brandUrl}}">{{$brandName}}</a>
            @endif
    </div>
</div>
