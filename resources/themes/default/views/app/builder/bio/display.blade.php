<div class="box box-padding d-flex">
    <div class="left">
        <div class="icon"><i class="bi bi-link-45deg"></i></div>
    </div>
    <div class="flex-grow-1 middle">
        <a href="{{url('builder/bio/'.$link->slug)}}" data-ajax="true"><h6>{{$link->title}}</h6></a>
        <p><a target="_blank" href="{{config('link-base-domain', url('/'))}}/{{$link->slug}}">{{config('link-base-domain', url('/'))}}/{{$link->slug}}</a> </p>
    </div>
    <div class="info">
        <a href=""><i class="bi bi-bar-chart-line"></i> 4</a>
    </div>
    <div class="info"><span class="text-muted">{{date('F d, Y H:iA', $link->created_at)}}</span></div>
    <div class=" right">
        <div class="form-check form-switch form-check-lg display-inline">
            <input data-url="{{url('builder/bio')}}" {{$link->status ? 'checked':null}} onchange="return App.changeStatus(this, '{{$link->id}}')" class="form-check-input" type="checkbox" id="flexSwitchCheckDefault{{$link->id}}">
            <label class="form-check-label" for="flexSwitchCheckDefault{{$link->id}}"></label>
        </div>
        <a href="{{url('builder/bio/'.$link->slug)}}" data-ajax="true"><i class="bi bi-pencil"></i></a>
    </div>
</div>
