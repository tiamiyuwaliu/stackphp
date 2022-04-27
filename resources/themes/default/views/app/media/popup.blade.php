<div class="media-container row" >

    @foreach($medias as $media)
        <div class="each col-lg-3  col-md-3 col-sm-6 col-6 each-{{$media->id}}">
            <div class="each-inner" >
                @if($media->type == 'image')
                    <div  onclick="return App.openViewer(this)" data-id="{{$media->id}}" data-type="{{$media->type}}" data-path="{{url($media->path)}}" style="background-image: url({{url($media->thumbnail)}})" class="media"></div>
                @else
                    <div onclick="return App.openViewer(this)" data-type="{{$media->type}}" data-path="{{url($media->path)}}"  class="media">
                        <video src="{{url($media->path)}}"></video>
                    </div>
                @endif

                <div class="form-check">
                    <input onchange="App.markMedia(this)" data-id="{{$media->path}}" data-type="{{$media->type}}" data-path="{{url($media->path)}}" class="form-check-input" type="checkbox" value="" id="flexCheckIndeterminate">
                    <label class="form-check-label" for="flexCheckIndeterminate"></label>
                </div>
            </div>
        </div>

    @endforeach

    @if(count($medias) < 1)
        <div class="empty-result">
            <img  src="{{url('resources/themes/default/images/empty-result.png')}}"/>
        </div>
    @endif
</div>
