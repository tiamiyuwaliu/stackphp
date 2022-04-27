@if($settings['url'])
    <a href="" class="image-link"><img src="{{url($settings['image'])}}" alt="{{$settings['alt']}}"/></a>
@else
    <div class="image-link "><img src="{{url($settings['image'])}}" alt="{{$settings['alt']}}"/></div>
@endif
