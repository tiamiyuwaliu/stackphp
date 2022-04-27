<div class="popup-templates">
    @foreach($templates as $template)
        <a href="" onclick="return App.useTemplate(this)" class="box d-block">
            <div>{{$template->content}}</div>
            <h6>{{$template->title}}</h6>
        </a>
    @endforeach
</div>
@if(count($templates) < 1)
    <div class="empty-result">
        <img  src="{{url('resources/themes/default/images/empty-result.png')}}"/>
    </div>
@endif
