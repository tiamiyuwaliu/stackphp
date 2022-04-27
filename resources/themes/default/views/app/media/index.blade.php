<div class="content-padding">
    <div class="box inner-head">
        <h5>{{__('messages.media-manager')}}</h5>

        <div class="action">
            <ul class="clearfix">
                <li class="dropdown">
                    <a href="" data-bs-toggle="dropdown" class="btn btn-outline-secondary dropdown-toggle"><i class="bi bi-cloud-upload-fill"></i> {{__('messages.upload')}}</a>
                    <div class="dropdown-menu dropdown-menu-end">
                        <a href="" class="dropdown-item upload-btn">
                            <form method="post"  data-upload="#upload-progress" action="<?php echo url('media')?>" enctype="multipart/form-data" class="general-form filemanager-uploader">
                                <input type="hidden" name="val[action]" value="upload"/>
                                <input multiple onchange="App.validateFileSize(this, 'image-video','App.submitFileUpload')" type="file" name="file[]" class="upload-computer-input">
                                {{__('messages.upload-from-computer')}}
                            </form>
                        </a>
                        <a href="" class="dropdown-item" data-bs-target="#importImageModal" data-bs-toggle="modal">{{__('messages.import-from-url')}}</a>

                        <div class="dropdown-divider"></div>
                        @if(config('enable-google-drive', false))
                            <a href="" onclick="return App.openDropboxPicker()" class="dropdown-item">{{__('messages.import-from-dropbox')}}</a>
                            @endif
                        @if(config('enable-dropbox', false))
                            <a href="" onclick="return App.openGoogleDrivePicker()"  class="dropdown-item">{{__('messages.import-from-google-drive')}}</a>
                            @endif
                    </div>
                </li>
                @if(config('enable-canva', false))
                    <li class="dropdown">
                        <a href="" data-bs-toggle="dropdown" class="btn btn-outline-secondary dropdown-toggle"><img src="{{url('resources/themes/default/images/canva.png')}}"/></a>
                        <div class="dropdown-menu">
                            <a href="" onclick="return App.openCanva('FacebookPost')" class="dropdown-item font-15 color-grey">{{__('messages.facebook-post')}}</a>
                            <a href="" onclick="return App.openCanva('InstagramPost')" class="dropdown-item">{{__('messages.instagram-post')}}</a>
                            <a href="" onclick="return App.openCanva('TwitterPost')" class="dropdown-item font-15 color-grey">{{__('messages.twitter-post')}}</a>
                            <a href="" onclick="return App.openCanva('LinkedInBanner')" class="dropdown-item font-15 color-grey">{{__('messages.linkedin-post')}}</a>
                            <a href="" onclick="return App.openCanva('PinterestGraphic')" class="dropdown-item font-15 color-grey">{{__('messages.pinterest-post')}}</a>

                            <a href="" onclick="return App.openCanva('SocialMedia')" class="dropdown-item font-15 color-grey">{{__('messages.custom-post')}}</a>
                        </div>
                    </li>
                    @endif
                <li class="select-btn"><a onclick="return App.selectAllMedia();" href="" class="btn btn-secondary"><i class="bi bi-check2"></i> {{__('messages.select-all')}}</a> </li>
                <li class="deselect-btn"><a onclick="return App.deselectAllMedia()" href="" class="btn btn-secondary"><i class="bi bi-check2"></i> {{__('messages.deselect-all')}}</a> </li>
                <li><a href="" onclick="return App.deleteSelectedMedia('{{url('media')}}')" class="btn btn-secondary"><i class="bi bi-trash"></i></a> </li>
            </ul>
        </div>
    </div>
</div>
<div class="content-padding modern-scroll scroll-inner-right-top" >
    <div class="media-container row" id="filemanager-container">

        @foreach($medias as $media)
            <div class="each col-lg-2  col-md-3 col-sm-6 col-6 each-{{$media->id}}">
                <div class="each-inner" >
                    @if($media->type == 'image')
                        <div  onclick="return App.openViewer(this)" data-id="{{$media->id}}" data-type="{{$media->type}}" data-path="{{url($media->path)}}" style="background-image: url({{url($media->thumbnail)}})" class="media"></div>
                    @else
                        <div onclick="return App.openViewer(this)" data-type="{{$media->type}}" data-path="{{url($media->path)}}"  class="media">
                            <video src="{{url($media->path)}}"></video>
                        </div>
                    @endif

                        <div class="form-check">
                            <input onchange="App.markMedia(this)" class="form-check-input" type="checkbox" value="" id="flexCheckIndeterminate">
                            <label class="form-check-label" for="flexCheckIndeterminate"></label>
                        </div>
                    <a href="{{url('media')}}?action=delete&id={{$media->id}}" data-ajax-action="true" class="delete confirm"><i class="bi bi-trash"></i></a>
                </div>
            </div>

        @endforeach


        @if(count($medias) < 1)
            <div class="empty-result">
                <img  src="{{url('resources/themes/default/images/empty-result.png')}}"/>
            </div>
        @endif
    </div>
</div>


<div class="modal" tabindex="-1" id="importImageModal">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">{{__('messages.import-from-url')}}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{url('media')}}" method="post" class="general-form">
                <input type="hidden" name="val[action]" value="import"/>
                <div class="modal-body">
                    <div class="form-floating">
                        <input type="text" class="form-control" name="link" id="importImageInput" placeholder="{{__('messages.enter-valid-link')}}"/>
                        <label for="floatingInput">{{__('messages.enter-valid-link')}}</label>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary"><i class="bi bi-check2"></i></button>
                </div>
            </form>
        </div>
    </div>
</div>

