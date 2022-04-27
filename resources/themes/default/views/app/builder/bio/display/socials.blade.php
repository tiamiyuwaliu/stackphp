<div class="social-links-container">
    @foreach(\App\Repositories\Builder::repository()->getSocialWidgets() as $social)
        @if($settings[$social])
            <a href=""><i style="color: {{$settings['color']}}" class="bi bi-{{$social}}"></i></a>
        @endif

    @endforeach
</div>
