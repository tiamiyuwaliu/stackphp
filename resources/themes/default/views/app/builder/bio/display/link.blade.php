<a
    @if($settings['type'] == 'url')
    href="{{$settings['link']}}"
        @elseif($settings['type'] == 'tel')
    href="tel:{{$settings['link']}}"
        @else
    href="mailto:{{$settings['link']}}"
        @endif
            @if($settings['tab'])
            target="_blank"
            @endif
    class="link-tag {{$settings['radius']}} {{$settings['size']}}"
   style="
       background: {{$settings['bgcolor']}};color:{{$settings['color']}};border:{{$settings['border-style']}} {{$settings['border-width']}}px #fff">
   @if($settings['icon'])
        <i class="{{$settings['icon']}}"></i>
    @endif
        {{$settings['title']}}
</a>
