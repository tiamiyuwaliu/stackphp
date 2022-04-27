<?php
    $medias = ($post->medias) ? json_decode($post->medias) : [];
    $caption = \App\Repositories\Emoji::repository()->toImage($post->caption);
    $channel = \App\Repositories\Channel::repository()->findById($post->account);

?>
<div class="each-post box d-flex">
    <div class="media">
        <div class="pane">
            @if(!$medias)
                <i class="bi bi-images"></i>
            @else
                <div id="carouselPostList{{$post->id}}" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-indicators">
                        <?php $i = 0;?>
                        @foreach($medias as $media)
                            <button type="button" data-bs-target="#carouselPostList{{$post->id}}" data-bs-slide-to="{{$i}}" class="{{$i == 0 ? 'active' : null}}" aria-current="true" aria-label="Slide 1"></button>
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

            @endif
        </div>
    </div>
    <div class="content flex-grow-1">
        <div class="d-flex user-media">
            <div class="flex-shrink-0">
                <div class="avatar" style="background-image:url({{url($channel->avatar)}})"></div>
            </div>
            <div class="flex-grow-1 ms-3">
                <h6 class="mt-1">{{$channel->username}}</h6>
            </div>

            <span class="time">{{date('F d, Y H:iA', $post->schedule_time)}}</span>
        </div>

        <div class="caption">{!! nl2br($caption) !!}</div>
    </div>
    <div class="">
        <div class="action">
            <a href="" class="btn btn-dark btn-sm" data-bs-target="#editPostModal{{$post->id}}" data-bs-toggle="modal" title="{{__('messages.edit')}}"><i class="bi bi-pencil"></i></a>
            <a href="" title="{{__('messages.duplicate')}}" class="btn btn-outline-secondary btn-sm" onclick="return App.duplicatePost(this, '{{$post->id}}')">
                <i class="bi bi-clipboard"></i>
            </a>
            <a href="{{url('publish')}}?action=delete-post&id={{$post->id}}" title="{{__('messages.delete')}}" class="btn btn-outline-danger btn-sm confirm" data-ajax-action="true"><i class="bi bi-trash"></i> </a>
        </div>
    </div>
</div>
<div class="hide duplicate-caption-{{$post->id}}">{{$post->caption}}</div>
<span class="hide duplicate-medias-{{$post->id}}" >
                    @foreach($medias as $media)
        <div
            @if(isImageName($media))
            style="background-image:url({{url($media)}})"
                            @endif
                        >
                            <input type='hidden' name='val[media][]' value='{{$media}}'/><a href='' onclick='return App.postRemoveSelectedMedia(this)'><i class="bi bi-x-lg"></i></a>
                            @if(!isImageName($media))
                <video src="{{url($media)}}"></video>
            @endif
                        </div>
    @endforeach
                </span>
<div class="modal fade post-modal" id="editPostModal{{$post->id}}" data-bs-backdrop="static">
    <div class="modal-dialog modal-dialog-centered ">
        <div class="modal-content composer-container">
            <a href="" class="close-btn" onclick="return App.closePostEditor('#editPostModal{{$post->id}}')"><i class="bi bi-x-lg"></i></a>
            <div class="compose-content each-pane" >
                <form action="{{url('publish')}}" method="post" id="postEditorForm{{$post->id}}" class="general-form">
                    <input type="hidden" name="val[action]" value="edit-post"/>
                    <input type="hidden" name="val[id]" value="{{$post->id}}"/>
                    <div class="modal-body">

                        <div class="box box-padding p-1">
                            <textarea placeholder="{{__('messages.write-a-caption')}}" name="val[caption]"  id="post-editor-textarea{{$post->id}}" class="emoji-text post-editor-textarea">{!! $post->caption !!}</textarea>
                        </div>

                        <div class="box post-media-list clearfix"
                        @if($medias)
                            style="display: block"
                            @endif>

                            @foreach($medias as $media)
                                <div
                                @if(isImageName($media))
                                    style="background-image:url({{url($media)}})"
                                    @endif
                                >
                                    <input type='hidden' name='val[media][]' value='{{$media}}'/><a href='' onclick='return App.postRemoveSelectedMedia(this)'><i class="bi bi-x-lg"></i></a>
                                    @if(!isImageName($media))
                                        <video src="{{url($media)}}"></video>
                                    @endif
                                </div>
                            @endforeach

                        </div>
                        <input type="hidden" name="val[post_type]" value="1" class="post-type-input"/>
                        <div class="box box-padding p-1 schedule-date-selector" style="display: block">
                            <div class="form-floating">
                                <input type="text" name="val[time]" id="scheduleDate" value="{{date('Y-m-d H:i', $post->schedule_time)}}" class="form-control date-time-picker" placeholder="{{__('messages.choose-a-custom-date')}}"/>
                                <label for="scheduleDate">{{__('messages.choose-a-custom-date')}}</label>
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer clearfix">
                        <div class="float-start">
                            <ul class="clearfix">
                                <li><a href="" data-bs-toggle="tooltip" data-bs-placement="top" title="{{__('messages.upload')}}"><i class="bi bi-camera"></i></a> </li>
                                <li><a href="" onclick="return App.postOpenMediaPicker()" data-bs-toggle="tooltip" data-bs-placement="top" title="{{__('messages.media-library')}}"><i class="bi bi-images"></i></a> </li>
                                <li><a data-bs-toggle="tooltip" data-bs-placement="top" title="{{__('messages.caption-picker')}}" onclick="return App.openTemplatePicker('caption')" href=""><i class="bi bi-layers"></i></a> </li>
                                <li><a data-bs-toggle="tooltip" data-bs-placement="top" title="{{__('messages.hashtag-picker')}}" onclick="return App.openTemplatePicker('hashtag')" href=""><i class="bi bi-hash"></i></a> </li>
                            </ul>
                        </div>
                        <div class="float-end">

                            <div class="btn-group dropup">
                                <button type="button" onclick="return App.validatePostSubmit('#editPostModal{{$post->id}}')" class="btn btn-primary btn-sm post-submit-btn">{{__('messages.save-changes')}}</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>

            <div class="templates-picker-container each-pane">
                <div class="modal-header">
                    <div class="form-group" style="width: 100%">
                        <input onkeyup="App.searchTemplates(this)" type="text" class="form-control" placeholder="{{__('messages.search-templates')}}"/>
                    </div>
                </div>
                <div class="modal-body modern-scroll">

                </div>
            </div>
            <div class="media-library each-pane">
                <div class="modal-header">
                    <h6>{{__('messages.pick-media-library')}}</h6>
                </div>
                <div class="modal-body modern-scroll">

                </div>
                <div class="modal-footer">
                    <button type="button" onclick="App.postAddSelectedMedia()" class="btn btn-primary"><i class="bi bi-check2"></i></button>
                </div>
            </div>
        </div>
    </div>
</div>
