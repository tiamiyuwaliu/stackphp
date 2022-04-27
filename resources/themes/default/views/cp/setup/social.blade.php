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
                <h5>{{__('Facebook')}}</h5>

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

                <div class="clearfix mt-3 mb-3">
                    <div class="float-start">
                        <h6>{{__('messages.enable-channel')}}</h6>
                        <small>{{__('messages.enable-channel-note')}}</small>
                    </div>
                    <div class="float-end">
                        <div class="form-check form-switch">
                            <input type="hidden" name="val[facebook-channel]" value="0"/>
                            <input name="val[facebook-channel]" {{config('facebook-channel', false) ? 'checked' : null}} class="form-check-input " type="checkbox" id="flexSwitchCheckCheckedFacebookChannel" >
                            <label class="form-check-label" for="flexSwitchCheckCheckedFacebookChannel"></label>
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

                <h5 class="mt-4">{{__('Twitter')}}</h5>
                <div class="clearfix mt-2 mb-3">
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

                <div class="clearfix mt-3 mb-3">
                    <div class="float-start">
                        <h6>{{__('messages.enable-channel')}}</h6>
                        <small>{{__('messages.enable-channel-note')}}</small>
                    </div>
                    <div class="float-end">
                        <div class="form-check form-switch">
                            <input type="hidden" name="val[twitter-channel]" value="0"/>
                            <input name="val[twitter-channel]" {{config('twitter-channel', false) ? 'checked' : null}} class="form-check-input " type="checkbox" id="flexSwitchCheckCheckedTwitterChannel" >
                            <label class="form-check-label" for="flexSwitchCheckCheckedTwitterChannel"></label>
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

                <h5 class="mt-4">{{__('Instagram')}}</h5>
                <div class="clearfix mt-3 mb-3">
                    <div class="float-start">
                        <h6>{{__('messages.enable-channel')}}</h6>
                        <small>{{__('messages.enable-channel-note')}}</small>
                    </div>
                    <div class="float-end">
                        <div class="form-check form-switch">
                            <input type="hidden" name="val[instagram-channel]" value="0"/>
                            <input name="val[instagram-channel]" {{config('instagram-channel', false) ? 'checked' : null}} class="form-check-input " type="checkbox" id="flexSwitchCheckCheckedInstagramChannel" >
                            <label class="form-check-label" for="flexSwitchCheckCheckedInstagramChannel"></label>
                        </div>
                    </div>
                </div>

                <h5 class="mt-4">{{__('LinkedIn')}}</h5>
                <div class="clearfix mt-3 mb-3">
                    <div class="float-start">
                        <h6>{{__('messages.enable-channel')}}</h6>
                        <small>{{__('messages.enable-channel-note')}}</small>
                    </div>
                    <div class="float-end">
                        <div class="form-check form-switch">
                            <input type="hidden" name="val[linkedin-channel]" value="0"/>
                            <input name="val[linkedin-channel]" {{config('linkedin-channel', false) ? 'checked' : null}} class="form-check-input " type="checkbox" id="flexSwitchCheckCheckedlinkedinChannel" >
                            <label class="form-check-label" for="flexSwitchCheckCheckedlinkedinChannel"></label>
                        </div>
                    </div>
                </div>
                <div class="clearfix mt-3 mb-3">
                    <div class="float-start">
                        <h6>{{__('messages.enable-linkedin-business-page')}}</h6>
                        <small>{{__('messages.enable-linkedin-business-page-note')}}</small>
                    </div>
                    <div class="float-end">
                        <div class="form-check form-switch">
                            <input type="hidden" name="val[linkedin-channel-page]" value="0"/>
                            <input name="val[linkedin-channel-page]" {{config('linkedin-channel-page', false) ? 'checked' : null}} class="form-check-input " type="checkbox" id="flexSwitchCheckCheckedlinkedinChannelPage" >
                            <label class="form-check-label" for="flexSwitchCheckCheckedlinkedinChannelPage"></label>
                        </div>
                    </div>
                </div>

                <div class="form-floating mt-3 ">
                    <input placeholder="{{__('messages.app-id')}}" type="text" class="form-control" value="{{config('linkedin-client-id')}}" name="val[linkedin-client-id]"/>
                    <label>{{__('messages.client-id')}}</label>
                </div>

                <div class="form-floating mt-3">
                    <input placeholder="{{__('messages.app-secret')}}" type="text" class="form-control" value="{{config('linkedin-client-secret')}}" name="val[linkedin-client-secret]"/>
                    <label>{{__('messages.client-secret')}}</label>
                </div>

                <h5 class="mt-4">{{__('Pinterest')}}</h5>
                <div class="clearfix mt-3 mb-3">
                    <div class="float-start">
                        <h6>{{__('messages.enable-channel')}}</h6>
                        <small>{{__('messages.enable-channel-note')}}</small>
                    </div>
                    <div class="float-end">
                        <div class="form-check form-switch">
                            <input type="hidden" name="val[pinterest-channel]" value="0"/>
                            <input name="val[pinterest-channel]" {{config('pinterest-channel', false) ? 'checked' : null}} class="form-check-input " type="checkbox" id="flexSwitchCheckCheckedpinterestChannel" >
                            <label class="form-check-label" for="flexSwitchCheckCheckedpinterestChannel"></label>
                        </div>
                    </div>
                </div>
                <div class="form-floating mt-3 ">
                    <input placeholder="{{__('messages.app-id')}}" type="text" class="form-control" value="{{config('pinterest-client-id')}}" name="val[pinterest-client-id]"/>
                    <label>{{__('messages.client-id')}}</label>
                </div>

                <div class="form-floating mt-3">
                    <input placeholder="{{__('messages.app-secret')}}" type="text" class="form-control" value="{{config('pinterest-client-secret')}}" name="val[pinterest-client-secret]"/>
                    <label>{{__('messages.client-secret')}}</label>
                </div>

                <h5 class="mt-4">{{__('Tiktok')}}</h5>
                <div class="clearfix mt-3 mb-3">
                    <div class="float-start">
                        <h6>{{__('messages.enable-channel')}}</h6>
                        <small>{{__('messages.enable-channel-note')}}</small>
                    </div>
                    <div class="float-end">
                        <div class="form-check form-switch">
                            <input type="hidden" name="val[tiktok-channel]" value="0"/>
                            <input name="val[tiktok-channel]" {{config('tiktok-channel', false) ? 'checked' : null}} class="form-check-input " type="checkbox" id="flexSwitchCheckCheckedtiktokChannel" >
                            <label class="form-check-label" for="flexSwitchCheckCheckedtiktokChannel"></label>
                        </div>
                    </div>
                </div>
                <div class="form-floating mt-3 ">
                    <input placeholder="{{__('messages.app-id')}}" type="text" class="form-control" value="{{config('tiktok-client-id')}}" name="val[tiktok-client-id]"/>
                    <label>{{__('messages.client-id')}}</label>
                </div>

                <div class="form-floating mt-3">
                    <input placeholder="{{__('messages.app-secret')}}" type="text" class="form-control" value="{{config('tiktok-client-secret')}}" name="val[tiktok-client-secret]"/>
                    <label>{{__('messages.client-secret')}}</label>
                </div>

                <h5 class="mt-4">{{__('Reddit')}}</h5>
                <div class="clearfix mt-3 mb-3">
                    <div class="float-start">
                        <h6>{{__('messages.enable-channel')}}</h6>
                        <small>{{__('messages.enable-channel-note')}}</small>
                    </div>
                    <div class="float-end">
                        <div class="form-check form-switch">
                            <input type="hidden" name="val[reddit-channel]" value="0"/>
                            <input name="val[reddit-channel]" {{config('reddit-channel', false) ? 'checked' : null}} class="form-check-input " type="checkbox" id="flexSwitchCheckCheckedredditChannel" >
                            <label class="form-check-label" for="flexSwitchCheckCheckedredditChannel"></label>
                        </div>
                    </div>
                </div>
                <div class="form-floating mt-3 ">
                    <input placeholder="{{__('messages.app-id')}}" type="text" class="form-control" value="{{config('reddit-client-id')}}" name="val[reddit-client-id]"/>
                    <label>{{__('messages.client-id')}}</label>
                </div>

                <div class="form-floating mt-3">
                    <input placeholder="{{__('messages.app-secret')}}" type="text" class="form-control" value="{{config('reddit-client-secret')}}" name="val[reddit-client-secret]"/>
                    <label>{{__('messages.client-secret')}}</label>
                </div>

                <h5 class="mt-4">{{__('Tumblr')}}</h5>
                <div class="clearfix mt-3 mb-3">
                    <div class="float-start">
                        <h6>{{__('messages.enable-channel')}}</h6>
                        <small>{{__('messages.enable-channel-note')}}</small>
                    </div>
                    <div class="float-end">
                        <div class="form-check form-switch">
                            <input type="hidden" name="val[tumblr-channel]" value="0"/>
                            <input name="val[tumblr-channel]" {{config('tumblr-channel', false) ? 'checked' : null}} class="form-check-input " type="checkbox" id="flexSwitchCheckCheckedtumblrChannel" >
                            <label class="form-check-label" for="flexSwitchCheckCheckedtumblrChannel"></label>
                        </div>
                    </div>
                </div>
                <div class="form-floating mt-3 ">
                    <input placeholder="{{__('messages.app-id')}}" type="text" class="form-control" value="{{config('tumblr-client-id')}}" name="val[tumblr-client-id]"/>
                    <label>{{__('messages.client-id')}}</label>
                </div>

                <div class="form-floating mt-3">
                    <input placeholder="{{__('messages.app-secret')}}" type="text" class="form-control" value="{{config('tumblr-client-secret')}}" name="val[tumblr-client-secret]"/>
                    <label>{{__('messages.client-secret')}}</label>
                </div>

                <h5 class="mt-4">{{__('Telegram')}}</h5>
                <div class="clearfix mt-3 mb-3">
                    <div class="float-start">
                        <h6>{{__('messages.enable-channel')}}</h6>
                        <small>{{__('messages.enable-channel-note')}}</small>
                    </div>
                    <div class="float-end">
                        <div class="form-check form-switch">
                            <input type="hidden" name="val[telegram-channel]" value="0"/>
                            <input name="val[telegram-channel]" {{config('telegram-channel', false) ? 'checked' : null}} class="form-check-input " type="checkbox" id="flexSwitchCheckCheckedtelegramChannel" >
                            <label class="form-check-label" for="flexSwitchCheckCheckedtelegramChannel"></label>
                        </div>
                    </div>
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

