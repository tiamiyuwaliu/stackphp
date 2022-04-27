<div class="header">
    <h4>{{__('messages.upload-configuration')}}</h4>
    <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a data-ajax="true" href="{{url('cp/dashboard')}}">{{__('messages.home')}}</a></li>
            <li class="breadcrumb-item"><a data-ajax="true" href="{{url('cp/settings')}}">{{__('messages.settings')}}</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{__('messages.upload-configuration')}}</li>
        </ol>
    </nav>
</div>
<form enctype="multipart/form-data" class="general-form form-auto-submit" data-no-loader="true" action="" method="post">
    <div class="row">
        <div class="col-md-6">
            <div class="box shadow-sm">
                <h5>{{__('messages.third-party-import')}}</h5>


                <div class="clearfix mt-3 mb-3">
                    <div class="float-start">
                        <h6>{{__('messages.google-drive')}}</h6>
                        <small>{{__('messages.google-drive-note')}}</small>
                    </div>
                    <div class="float-end">
                        <div class="form-check form-switch">
                            <input type="hidden" name="val[enable-google-drive]" value="0"/>
                            <input name="val[enable-google-drive]" {{config('enable-google-drive', false) ? 'checked' : null}} class="form-check-input " type="checkbox" id="flexSwitchCheckCheckedGoogle" >
                            <label class="form-check-label" for="flexSwitchCheckCheckedGoogle"></label>
                        </div>
                    </div>
                </div>

                <div class="form-floating mt-3">
                    <input placeholder="{{__('messages.google-api-key')}}" type="text" class="form-control" value="{{config('google-drive-api-key', '')}}" name="val[google-drive-api-key]"/>
                    <label>{{__('messages.google-api-key')}}</label>
                </div>
                <div class="form-floating mt-3">
                    <input placeholder="{{__('messages.google-client-id')}}" type="text" class="form-control" value="{{config('google-drive-client-id', '')}}" name="val[google-drive-client-id]"/>
                    <label>{{__('messages.google-client-id')}}</label>
                </div>


                <div class="clearfix mt-3 mb-3">
                    <div class="float-start">
                        <h6>{{__('messages.dropbox')}}</h6>
                        <small>{{__('messages.dropbox-note')}}</small>
                    </div>
                    <div class="float-end">
                        <div class="form-check form-switch">
                            <input type="hidden" name="val[enable-dropbox]" value="0"/>
                            <input name="val[enable-dropbox]" {{config('enable-dropbox', false) ? 'checked' : null}} class="form-check-input " type="checkbox" id="flexSwitchCheckCheckedDropbox" >
                            <label class="form-check-label" for="flexSwitchCheckCheckedDropbox"></label>
                        </div>
                    </div>
                </div>
                <div class="form-floating mt-3">
                    <input placeholder="__('messages.dropbox-api-key')" type="text" class="form-control" value="{{config('dropbox-api-key', '')}}" name="val[dropbox-api-key]"/>
                    <label>{{__('messages.dropbox-api-key')}}</label>
                </div>

                <div class="clearfix mt-3 mb-3">
                    <div class="float-start">
                        <h6>{{__('messages.canva')}}</h6>
                        <small>{{__('messages.canva-note')}}</small>
                    </div>
                    <div class="float-end">
                        <div class="form-check form-switch">
                            <input type="hidden" name="val[enable-canva]" value="0"/>
                            <input name="val[enable-canva]" {{config('enable-canva', false) ? 'checked' : null}} class="form-check-input " type="checkbox" id="flexSwitchCheckCheckedCanvas" >
                            <label class="form-check-label" for="flexSwitchCheckCheckedCanvas"></label>
                        </div>
                    </div>
                </div>
                <div class="form-floating mt-3">
                    <input placeholder="__('messages.canva-api-key')" type="text" class="form-control" value="{{config('canva-api-key', '')}}" name="val[canva-api-key]"/>
                    <label>{{__('messages.canva-api-key')}}</label>
                </div>


            </div>

            <div class="box shadow-sm mt-4">
                <h6 class="mt-3">{{__('messages.ffmpeg-configuration')}}</h6>
                <div class="clearfix mt-3 mb-3">
                    <div class="float-start">
                        <h6>{{__('messages.enable-ffmpeg')}}</h6>
                        <small>{{__('messages.enable-ffmpeg-note')}}</small>
                    </div>
                    <div class="float-end">
                        <div class="form-check form-switch">
                            <input type="hidden" name="val[enable-ffmpeg]" value="0"/>
                            <input name="val[enable-google-drive]" {{config('enable-ffmpeg', false) ? 'checked' : null}} class="form-check-input " type="checkbox" id="flexSwitchCheckCheckedenable-ffmpeg" >
                            <label class="form-check-label" for="flexSwitchCheckCheckedenable-ffmpeg"></label>
                        </div>
                    </div>
                </div>
                <div class="form-floating mt-3">
                    <input placeholder="{{__('messages.ffmpeg-path')}}" type="text" class="form-control" value="{{config('ffmpeg-path', '')}}" name="val[ffmpeg-path]"/>
                    <label>{{__('messages.ffmpeg-path')}}</label>
                </div>

                <div class="form-floating mt-3">
                    <input placeholder="{{__('messages.ffprobe-path')}}" type="text" class="form-control" value="{{config('ffprobe-path', '')}}" name="val[ffprobe-path]"/>
                    <label>{{__('messages.ffprobe-path')}}</label>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="box shadow-sm">
                <h5>{{__('messages.upload-file-limits')}}</h5>

                <div class="form-floating mt-3">
                    <input placeholder="{{__('messages.allowed-extensions')}}" type="text" class="form-control" value="{{config('allowed-extensions', 'jpg,png,jpeg,gif,mkv,docx,zip,rar,pdf,doc,mp3,mp4,flv,wav,txt,mov,avi,webm,wav,mpeg')}}" name="val[allowed-extensions]"/>
                    <label>{{__('messages.allowed-extensions')}}</label>
                </div>

                <div class="form-floating mt-3">
                    <input placeholder="{{__('messages.allowed-image-extensions')}}" type="text" class="form-control" value="{{config('allowed-image-extensions', 'jpg,png,jpeg,gif')}}" name="val[allowed-image-extensions]"/>
                    <label>{{__('messages.allowed-image-extensions')}}</label>
                </div>

                <div class="form-floating mt-3">
                    <input placeholder="{{__('messages.allowed-video-extensions')}}" type="text" class="form-control" value="{{config('allowed-video-extensions', 'mp4,flv,wav,mov,avi,webm,wav,mpeg')}}" name="val[allowed-video-extensions]"/>
                    <label>{{__('messages.allowed-video-extensions')}}</label>
                </div>

                <div class="mt-4">
                    <label>{{__('messages.max-upload-size')}}</label>
                    <div class="input-group">
                        <input name="val[upload-size]" value="{{config('upload-size', 10)}}" type="text" class="form-control" placeholder="10" />
                        <span class="input-group-text" id="basic-addon2">MB</span>
                    </div>
                </div>
            </div>

            <div class="box shadow-sm mt-4">
                <h5>{{__('messages.storage')}}</h5>

                <div class="form-floating">
                    <select name="val[storage-disk]" class="form-select" id="floatingSelect" >
                        <option {{(config('storage-disk', 1) == 1) ? 'selected':null}} value="1">{{__('messages.local-storage')}}</option>
                    </select>
                    <label for="floatingSelect">{{__('messages.storage-disk')}}</label>
                </div>
            </div>
        </div>
    </div>
</form>

