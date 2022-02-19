<div class="header">
    <h4>{{__('messages.social-settings')}}</h4>
    <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a data-ajax="true" href="{{url('cp/dashboard')}}">{{__('messages.home')}}</a></li>
            <li class="breadcrumb-item"><a data-ajax="true" href="{{url('cp/settings')}}">{{__('messages.settings')}}</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{__('messages.social-settings')}}</li>
        </ol>
    </nav>
</div>
<form enctype="multipart/form-data" class="general-form form-auto-submit" data-no-loader="true" action="" method="post">
    <div class="row">
        <div class="col-md-6">
            <div class="box shadow-sm">
                <h5>{{__('messages.social-login')}}</h5>

                <div class="clearfix mt-3 mb-3">
                    <div class="float-start">
                        <h6>{{__('messages.enable-facebook-login')}}</h6>
                        <small>{{__('messages.enable-facebook-login-note')}}</small>
                    </div>
                    <div class="float-end">
                        <div class="form-check form-switch">
                            <input type="hidden" name="val[facebook-login]" value="0"/>
                            <input name="val[facebook-login]" {{config('facebook-login', false) ? 'checked' : null}} class="form-check-input " type="checkbox" id="flexSwitchCheckCheckedFacebook" >
                            <label class="form-check-label" for="flexSwitchCheckCheckedFacebook"></label>
                        </div>
                    </div>
                </div>


                <div class="form-floating mt-3">
                    <input placeholder="{{__('messages.app-id')}}" type="text" class="form-control" value="{{config('facebook-app-id')}}" name="val[facebook-app-id]"/>
                    <label>{{__('messages.app-id')}}</label>
                </div>

                <div class="form-floating mt-3">
                    <input placeholder="{{__('messages.app-secret')}}" type="text" class="form-control" value="{{config('facebook-app-secret')}}" name="val[facebook-app-secret]"/>
                    <label>{{__('messages.app-secret')}}</label>
                </div>


                <div class="clearfix mt-5 mb-3">
                    <div class="float-start">
                        <h6>{{__('messages.enable-twitter-login')}}</h6>
                        <small>{{__('messages.enable-twitter-login-note')}}</small>
                    </div>
                    <div class="float-end">
                        <div class="form-check form-switch">
                            <input type="hidden" name="val[twitter-login]" value="0"/>
                            <input name="val[twitter-login]" {{config('twitter-login', false) ? 'checked' : null}} class="form-check-input " type="checkbox" id="flexSwitchCheckCheckedTwitter" >
                            <label class="form-check-label" for="flexSwitchCheckCheckedTwitter"></label>
                        </div>
                    </div>
                </div>




                <div class="form-floating mt-3 ">
                    <input placeholder="{{__('messages.consumer-key')}}" type="text" class="form-control" value="{{config('twitter-consumer-key')}}" name="val[twitter-consumer-key]"/>
                    <label>{{__('messages.consumer-key')}}</label>
                </div>

                <div class="form-floating mt-3">
                    <input placeholder="{{__('messages.consumer-secret')}}" type="text" class="form-control" value="{{config('twitter-consumer-secret')}}" name="val[twitter-consumer-secret]"/>
                    <label>{{__('messages.consumer-secret')}}</label>
                </div>

            </div>
        </div>
        <div class="col-md-6">
            <div class="box shadow-sm">
                <h5>{{__('messages.social-links')}}</h5>

                <div class="form-floating mt-3">
                    <input placeholder="{{__('messages.facebook-page')}}" type="text" class="form-control" value="{{ config('facebook-page', 'https://facebook.com')}}" name="val[facebook-page]"/>
                    <label>{{__('messages.facebook-page')}}</label>
                </div>
                <div class="form-floating mt-3">
                    <input placeholder="{{__('messages.google-page')}}" type="text" class="form-control" value="{{config('google-page', 'https://google.com')}}" name="val[google-page]"/>
                    <label>{{__('messages.google-page')}}</label>
                </div>
                <div class="form-floating mt-3">
                    <input placeholder="{{ __('messages.twitter-page')}}" type="text" class="form-control" value="{{config('twitter-page', 'https://twitter.com')}}" name="val[twitter-page]"/>
                    <label>{{__('messages.twitter-page')}}</label>
                </div>
                <div class="form-floating mt-3">
                    <input placeholder="{{__('messages.pinterest-page')}}" type="text" class="form-control" value="{{config('pinterest-page', 'https://pinterest.com')}}" name="val[pinterest-page]"/>
                    <label>{{__('messages.pinterest-page')}}</label>
                </div>
                <div class="form-floating mt-3">
                    <input placeholder="{{__('messages.instagram-page')}}" type="text" class="form-control" value="{{config('instagram-page', 'https://instagram.com')}}" name="val[instagram-page]"/>
                    <label>{{__('messages.instagram-page')}}</label>
                </div>
            </div>
        </div>
    </div>
</form>

