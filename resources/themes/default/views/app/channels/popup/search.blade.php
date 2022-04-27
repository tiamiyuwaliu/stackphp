@if(count($channels))
    @foreach($channels as $channel)
        {!! view('app/channels/popup/display', ['channel' => $channel]) !!}
        @endforeach
@else
    <div class="empty-result">
        <img  src="{{url('resources/themes/default/images/empty-result.png')}}"/>
    </div>
@endif
