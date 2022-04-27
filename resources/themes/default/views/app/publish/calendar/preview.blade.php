<div class="modal calendar-post-preview" data-bs-backdrop="false" id="calendarPostModal{{$post->id}}" tabindex="3">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-white">
                <h5 class="modal-title">{{__('messages.post-details')}}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="d-flex media">
                    <div class="flex-shrink-0">
                        <div class="avatar" style="background-image:url({{url($channel->avatar)}})"></div>
                    </div>
                    <div class="flex-grow-1 ms-3">
                        <h6 class="mt-1">{{$channel->username}}</h6>
                    </div>

                    <span class="time">{{date('F d, Y H:iA', $post->schedule_time)}}</span>
                </div>

                <div class="caption">
                    {!! \App\Repositories\Emoji::repository()->toImage($post->caption) !!}
                </div>
                @if($medias)
                    <div class="medias-container">
                        <div id="carouselPost{{$post->id}}" class="carousel slide" data-bs-ride="carousel">
                            <div class="carousel-indicators">
                                <?php $i = 0;?>
                                @foreach($medias as $media)
                                        <button type="button" data-bs-target="#carouselPost{{$post->id}}" data-bs-slide-to="{{$i}}" class="{{$i == 0 ? 'active' : null}}" aria-current="true" aria-label="Slide 1"></button>
                                        <?php $i++;?>
                                    @endforeach
                            </div>
                            <div class="carousel-inner">
                                <?php $i = 0;?>
                                @foreach($medias as $media)
                                        <div class="carousel-item {{$i == 0 ? 'active' : null}}"
                                             @if(isImageName($media))
                                                 style="background-image:url({{url($media)}})"
                                                 @endif
                                        >
                                            @if(!isImageName($media))
                                                <video src="{{url($media)}}"></video>
                                                @endif
                                        </div>
                                    <?php $i++;?>
                                    @endforeach

                            </div>

                        </div>
                    </div>
                    @endif

                <ul class="d-flex flex-row justify-content-evenly">
                    <li><i class="bi bi-hand-thumbs-up"></i> {{__('messages.like')}}</li>
                    <li><i class="bi bi-chat-left"></i> {{__('messages.comment')}}</li>
                    <li><i class="bi bi-arrow-return-right"></i> {{__('messages.share')}}</li>
                </ul>
            </div>
            @if($post->status == 2)
                <div class="d-flex flex-row p-3">
                    <div class="flex-grow-1">
                        <a href="{{url('publish')}}?action=delete-post&id={{$post->id}}" type="button" class="btn btn-secondary confirm" data-ajax-action="true" >{{__('messages.delete')}}</a>
                    </div>
                    <div class="">
                        <button type="button" class="btn btn-primary">{{__('messages.edit-post')}}</button>
                    </div>
                </div>
                @endif
        </div>
    </div>
</div>
