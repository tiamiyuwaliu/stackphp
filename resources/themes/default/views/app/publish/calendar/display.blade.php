<div class="d-flex flex-row {{$channel->social}}-bg">
    <i class="bi bi-{{$channel->social}}"></i> {{$channel->username}}

    @if($medias)
        <?php $media = $medias[0];?>
        @if(isImageName($media))
                <div class="media" style="background-image:url({{url($media)}})"></div>
            @else
                <div class="media"><video src="{{url($media)}}"></video> </div>
            @endif
        @endif
</div>

