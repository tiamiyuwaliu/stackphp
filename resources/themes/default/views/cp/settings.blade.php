<div class="header">
    <h3>{{__('messages.settings')}}</h3>
</div>
<ul class="nav nav-line">
    <li class="nav-item">
        <a class="nav-link active" data-bs-toggle="tab" data-bs-target="#general" aria-current="page" href="#">{{__('messages.general')}}</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" data-bs-toggle="tab" data-bs-target="#logos" href="#">{{__('messages.site-logos')}}</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" data-bs-toggle="tab" data-bs-target="#users" href="#">{{__('messages.users')}}</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" data-bs-toggle="tab" data-bs-target="#media" href="#">{{__('messages.media-manager')}}</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" data-bs-toggle="tab" data-bs-target="#payments" href="#">{{__('messages.payments')}}</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" data-bs-toggle="tab" data-bs-target="#others" href="#">{{__('messages.others')}}</a>
    </li>
</ul>
<div class="content-body">
    <div class="tab-content " id="justifiedTabContent">
        <div  class="tab-pane fade show active" id="general" role="tabpanel">
            <div class="row">
                <div class="col-md-6">
                    <form enctype="multipart/form-data" class="general-form " action="" method="post">

                        <div class="form-floating mt-3">
                            <input placeholder="{{__('messages.site-name')}}" type="text" class="form-control" id="siteTitleInput" value="<?php echo config('site-title','')?>" name="val[site-title]"/>
                            <label for="siteTitleInput">{{__('messages.site-name')}}</label>
                        </div>
                        <div class="form-floating mt-3">
                            <select id="siteTimezone"  class="form-select " name="val[language]">
                                <?php foreach(getAvailableLanguages() as $key => $name):?>
                                <option <?php echo config('language', 'en') == $key ? 'selected' : null?> value="<?php echo $key?>"><?php echo $name?></option>
                                <?php endforeach?>
                            </select>
                            <label for="siteTimezone">{{__('messages.default-language')}}</label>
                        </div>
                        <div class="form-floating mt-3">
                            <select id="siteTimezone"  class="form-select " name="val[timezone]">
                                <option value="">{{__('messages.select-timezone')}}</option>
                                <?php foreach(getTimezones() as $key => $name):?>
                                <option <?php echo config('timezone') == $key ? 'selected' : null?> value="<?php echo $key?>"><?php echo $name?></option>
                                <?php endforeach?>
                            </select>
                            <label for="siteTimezone">{{__('messages.default-timezone')}}</label>
                        </div>

                        <div class="form-floating mt-3">

                            <select class="form-select " id="defaultDateFormat" name="val[admin-date-format]">
                                @foreach(getDateFormats() as $key => $value)
                                <option {{(config('admin-date-format', 1) == $key) ? 'selected':null}} value="{{$key}}">{{$value}}</option>
                                @endforeach
                            </select>
                            <label for="defaultDateFormat">{{__('messages.default-date-format')}}</label>
                        </div>

                        <div class="form-floating mt-3">

                            <select id="calendarStartDay" class="form-select " name="val[calender-start-day]">
                                @foreach(array('0' => 'Sunday', '1' => 'Monday') as $key => $value)
                                <option {{(config('calender-start-day', 0) == $key) ? 'selected':null}} value="{{$key}}">{{$value}}</option>
                                @endforeach
                            </select>
                            <label for="calendarStartDay">{{__('messages.calendar-start-day')}}</label>
                        </div>


                        <h5 class="mt-3">SEO Settings</h5>
                        <hr/>
                        <div class="form-floating mt-3">
                            <textarea id="siteDescription" placeholder="{{__('messages.site-description')}}" class="form-control textarea-height-100" rows="10" name="val[site-description]"><?php echo config('site-description')?></textarea>
                            <label for="siteDescription">{{__('messages.site-description')}}</label>
                        </div>
                        <div class="form-floating mt-3">

                            <textarea id="" class="form-control textarea-height-100" rows="5" placeholder="{{__('messages.keywords')}}" name="val[site-keywords]"><?php echo config('site-keywords')?></textarea>
                            <label for="">{{__('messages.keywords')}}</label>
                        </div>

                        <div class="form-floating mt-3">
                            <input placeholder="{{__('messages.terms-and-condition-url')}}" type="text" class="form-control"  value="<?php echo config('terms-and-condition-url','')?>" name="val[terms-and-condition-url]"/>
                            <label >{{__('messages.terms-and-condition-url')}}</label>
                        </div>

                        <div class="form-floating mt-3">
                            <input placeholder="{{__('messages.privacy-policy-url')}}" type="text" class="form-control"  value="<?php echo config('privacy-policy-url','')?>" name="val[privacy-policy-url]"/>
                            <label >{{__('messages.privacy-policy-url')}}</label>
                        </div>


                        <div class="mt-4">
                            <button class="btn btn-float btn-primary">{{__('messages.save-settings')}}</button>

                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div  class="tab-pane fade " id="logos" role="tabpanel">
            <div class="row">
                <div class="col-md-6">
                    <form enctype="multipart/form-data" class="general-form " action="" method="post">
                        <input type="hidden" class="form-control" value="{{config('site-title')}}" name="val[site-title]"/>
                        <div class="form-group mt-3">
                            <div class="clearfix mb-3">
                                <div class="float-start"><label>{{__('messages.site-logo')}}</label></div>
                                <div class="float-end">
                                    <img src="{{url(config('site_logo','resources/themes/default/images/logo.png'))}}" class="width-200"/>
                                </div>
                            </div>

                            <input type="hidden" name="img[site_logo]" value="<?php echo config('site_logo','resources/themes/default/images/logo.png')?>"/>
                            <input type="file"  name="site_logo" class="form-control " />
                        </div>

                        <div class="form-group mt-3">
                            <div class="clearfix mb-3">
                                <div class="float-start"><label>{{__('messages.site-logo_light')}}</label></div>
                                <div class="float-end">
                                    <img src="{{url(config('site_logo_light','resources/themes/default/images/logo-light.png'))}}" class="width-200"/>
                                </div>
                            </div>

                            <input type="hidden" name="img[site_logo_light]" value="<?php echo config('site_logo','resources/themes/default/images/logo-light.png')?>"/>
                            <input type="file"  name="site_logo_light" class="form-control " />
                        </div>


                        <div class="form-group mt-3">
                            <div class="clearfix mb-3">
                                <div class="float-start"><label>{{__('messages.short-icon')}}</label></div>
                                <div class="float-end">
                                    <img src="{{url(config('site_logo','resources/themes/default/images/icon.png'))}}" class="width-50"/>
                                </div>
                            </div>

                            <input type="hidden" name="img[site_icon]" value="<?php echo config('site_icon','resources/themes/default/images/icon.png')?>"/>
                            <input type="file"  name="site_icon" class="form-control " />
                        </div>

                        <div class="form-group mt-3">
                            <div class="clearfix mb-3">
                                <div class="float-start"><label>{{__('messages.favicon')}}</label></div>
                                <div class="float-end">
                                    <img src="{{url(config('favicon','resources/themes/default/images/favicon.png'))}}" class="width-50"/>
                                </div>
                            </div>

                            <input type="hidden" name="img[favicon]" value="<?php echo config('favicon','resources/themes/default/images/favicon.png')?>"/>
                            <input type="file"  name="favicon" class="form-control " />
                        </div>



                        <div class="floating-button mt-4">
                            <button class="btn btn-float btn-primary">{{__('messages.save-settings')}}</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
        <div  class="tab-pane fade " id="users" role="tabpanel">
            <div class="row">
                <div class="col-md-6">
                    <form class="general-form short-form" action="{{url('')}}" method="post">
                        <div class="custom-control custom-checkbox mt-4 mb-4">
                            <input type="hidden" name="val[user-signup]" value="0"/>
                            <input type="checkbox" name="val[user-signup]" {{config('user-signup', true) ? 'checked' : null}} class="custom-control-input" id="customCheck1">
                            <label class="custom-control-label" for="customCheck1">{{__('messages.enable-signup')}}</label>
                        </div>

                        <hr/>
                        <div class="custom-control custom-checkbox mb-4">
                            <input type="hidden" name="val[enable-captcha]" value="0"/>
                            <input type="checkbox" name="val[enable-captcha]" {{config('enable-captcha', false) ? 'checked' : null}} class="custom-control-input" id="customCheck3">
                            <label class="custom-control-label" for="customCheck3">Google reCaptcha V2</label>
                        </div>

                        <div class="form-floating mt-3">
                            <input placeholder="{{__('messages.captcha-site-key')}}" type="text" class="form-control" value="{{config('captcha-site-key')}}" name="val[captcha-site-key]"/>
                            <label>{{__('messages.captcha-site-key')}}</label>
                        </div>

                        <div class="form-floating mt-3">
                            <input placeholder="{{__('messages.captcha-site-secret-key')}}" type="text" class="form-control" value="{{config('captcha-site-secret-key')}}" name="val[captcha-site-secret-key]"/>
                            <label>{{__('messages.captcha-site-secret-key')}}</label>
                        </div>
                        <hr/>
                        <div class="custom-control custom-checkbox mb-4">
                            <input type="hidden" name="val[facebook-login]" value="0"/>
                            <input type="checkbox" name="val[facebook-login]" {{config('facebook-login', false) ? 'checked' : null}} class="custom-control-input" id="customCheck4">
                            <label class="custom-control-label" for="customCheck4">{{__('messages.enable-facebook-login')}}</label>
                        </div>


                        <div class="form-floating mt-3">
                            <input placeholder="{{__('messages.app-id')}}" type="text" class="form-control" value="{{config('facebook-app-id')}}" name="val[facebook-app-id]"/>
                            <label>{{__('messages.app-id')}}</label>
                        </div>

                        <div class="form-floating mt-3">
                            <input placeholder="{{__('messages.app-secret')}}" type="text" class="form-control" value="{{config('facebook-app-secret')}}" name="val[facebook-app-secret]"/>
                            <label>{{__('messages.app-secret')}}</label>
                        </div>

                        <hr/>
                        <div class="custom-control custom-checkbox mb-4">
                            <input type="hidden" name="val[twitter-login]" value="0"/>
                            <input type="checkbox" name="val[twitter-login]" {{config('twitter-login', false) ? 'checked' : null}} class="custom-control-input" id="customCheck5">
                            <label class="custom-control-label" for="customCheck5">{{__('messages.enable-twitter-login')}}</label>
                        </div>


                        <div class="form-floating mt-3 ">
                            <input placeholder="{{__('messages.consumer-key')}}" type="text" class="form-control" value="{{config('twitter-consumer-key')}}" name="val[twitter-consumer-key]"/>
                            <label>{{__('messages.consumer-key')}}</label>
                        </div>

                        <div class="form-floating mt-3">
                            <input placeholder="{{__('messages.consumer-secret')}}" type="text" class="form-control" value="{{config('twitter-consumer-secret')}}" name="val[twitter-consumer-secret]"/>
                            <label>{{__('messages.consumer-secret')}}</label>
                        </div>


                        <div class="mt-4">
                            <button class="btn btn-float btn-primary">{{__('messages.save-settings')}}</button>
                        </div>

                    </form>

                </div>
            </div>
        </div>
        <div  class="tab-pane fade " id="media" role="tabpanel">
            <div class="row">
                <div class="col-md-6">
                    <form class="general-form short-form" action="{{url('')}}" method="post">
                        <h6 class="mt-4">Google Drive</h6>
                        <hr/>
                        <div class="custom-control custom-checkbox">
                            <input type="hidden" name="val[enable-google-drive]" value="0"/>
                            <input type="checkbox" value="1" class="custom-control-input" name="val[enable-google-drive]" {{config('enable-google-drive') ? 'checked' : null}} id="customCheckGoogleDrive">
                            <label class="custom-control-label" for="customCheckGoogleDrive">{{__('messages.enable')}}</label>
                        </div>
                        <div class="form-floating mt-3">
                            <input placeholder="{{__('messages.google-api-key')}}" type="text" class="form-control" value="{{config('google-drive-api-key', '')}}" name="val[google-drive-api-key]"/>
                            <label>{{__('messages.google-api-key')}}</label>
                        </div>
                        <div class="form-floating mt-3">
                            <input placeholder="{{__('messages.google-client-id')}}" type="text" class="form-control" value="{{config('google-drive-client-id', '')}}" name="val[google-drive-client-id]"/>
                            <label>{{__('messages.google-client-id')}}</label>
                        </div>

                        <hr/>
                        <h6>Dropbox</h6>
                        <hr/>
                        <div class="custom-control custom-checkbox">
                            <input type="hidden" name="val[enable-dropbox]" value="0"/>
                            <input type="checkbox" value="1" class="custom-control-input" name="val[enable-dropbox]" {{config('enable-dropbox') ? 'checked' : null}} id="customCheckdropbox">
                            <label class="custom-control-label" for="customCheckdropbox">{{__('messages.enable')}}</label>
                        </div>
                        <div class="form-floating mt-3">
                            <input placeholder="__('messages.dropbox-api-key')" type="text" class="form-control" value="{{config('dropbox-api-key', '')}}" name="val[dropbox-api-key]"/>
                            <label>{{__('messages.dropbox-api-key')}}</label>
                        </div>

                        <h6 class="mt-3">{{__('messages.ffmpeg-configuration')}}</h6>
                        <div class="form-floating mt-3">
                            <input placeholder="{{__('messages.ffmpeg-path')}}" type="text" class="form-control" value="{{config('ffmpeg-path', '')}}" name="val[ffmpeg-path]"/>
                            <label>{{__('messages.ffmpeg-path')}}</label>
                        </div>

                        <div class="form-floating mt-3">
                            <input placeholder="{{__('messages.ffprobe-path')}}" type="text" class="form-control" value="{{config('ffprobe-path', '')}}" name="val[ffprobe-path]"/>
                            <label>{{__('messages.ffprobe-path')}}</label>
                        </div>

                        <div class="floating-button mt-4">
                            <button class="btn btn-float btn-primary">{{__('messages.save-settings')}}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div  class="tab-pane fade " id="payments" role="tabpanel">
            <div class="row">
                <div class="col-md-6">
                    <form class="general-form short-form" action="{{url('')}}" method="post">
                        <div class="custom-control custom-checkbox mt-4">
                            <input type="hidden" name="val[force-credit-card]" value="0"/>
                            <input type="checkbox" value="1" class="custom-control-input" name="val[force-credit-card]" {{config('force-credit-card', false) ? 'checked' : null}} id="customCheckforce-credit-card">
                            <label class="custom-control-label" for="customCheckforce-credit-card">{{__('messages.enable-payment-signup')}}</label>
                        </div>
                        <hr/>
                        <h6>PayPal</h6>
                        <hr/>
                        <div class="custom-control custom-checkbox">
                            <input type="hidden" name="val[enable-paypal]" value="0"/>
                            <input type="checkbox" value="1" class="custom-control-input" name="val[enable-paypal]" {{config('enable-paypal', true) ? 'checked' : null}} id="customCheckPaypal">
                            <label class="custom-control-label" for="customCheckPaypal">{{__('messages.enable')}}</label>
                        </div>
                        <div class="custom-control custom-checkbox">
                            <input type="hidden" name="val[paypal-sandbox]" value="0"/>
                            <input type="checkbox" value="1" class="custom-control-input" name="val[paypal-sandbox]" {{config('paypal-sandbox', false) ? 'checked' : null}} id="customCheckPaypalpaypal-sandbox">
                            <label class="custom-control-label" for="customCheckPaypalpaypal-sandbox">{{__('messages.enable-sandbox')}}</label>
                        </div>
                        <div class="form-floating mt-3">
                            <input placeholder="{{__('messages.paypal-client-id')}}" type="text" class="form-control" value="{{config('paypal-client-id', '')}}" name="val[paypal-client-id]"/>
                            <label>{{__('messages.paypal-client-id')}}</label>
                        </div>
                        <div class="form-floating mt-3">
                            <input placeholder="{{__('messages.paypal-client-key')}}" type="text" class="form-control" value="{{config('paypal-client-key', '')}}" name="val[paypal-client-key]"/>
                            <label>{{__('messages.paypal-client-key')}}</label>
                        </div>


                        <h6 class="mt-4">Stripe</h6>
                        <hr/>
                        <div class="custom-control custom-checkbox">
                            <input type="hidden" name="val[enable-stripe]" value="0"/>
                            <input type="checkbox" value="1" class="custom-control-input" name="val[enable-stripe]" {{config('enable-stripe', true) ? 'checked' : null}} id="customCheckStripe">
                            <label class="custom-control-label" for="customCheckStripe">{{__('messages.enable')}}</label>
                        </div>
                        <div class="form-floating mt-3">
                            <input placeholder="{{__('messages.stripe-client-id')}}" type="text" class="form-control" value="{{config('stripe-client-id', '')}}" name="val[stripe-client-id]"/>
                            <label>{{__('messages.stripe-client-id')}}</label>
                        </div>
                        <div class="form-floating mt-3">
                            <input placeholder="{{__('messages.stripe-client-key')}}" type="text" class="form-control" value="{{config('stripe-client-key', '')}}" name="val[stripe-client-key]"/>
                            <label>{{__('messages.stripe-client-key')}}</label>
                        </div>
                        <div class="floating-button mt-4">
                            <button class="btn btn-float btn-primary">{{__('messages.save-settings')}}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div  class="tab-pane fade " id="others" role="tabpanel">
            <div class="row">
                <div class="col-md-6">
                    <form class="general-form short-form" action="{{url('')}}" method="post">

                        <div class="custom-control custom-checkbox mb-4 mt-4">
                            <input type="hidden" name="val[enable-gdpr]" value="0"/>
                            <input type="checkbox" name="val[enable-gdpr]" {{config('enable-gdpr', true) ? 'checked' : null}} class="custom-control-input" id="customCheck15">
                            <label class="custom-control-label" for="customCheck15">{{__('messages.enable-gdpr')}}</label>
                        </div>

                        <div class="custom-control custom-checkbox mb-4">
                            <input type="hidden" name="val[disable-landing]" value="0"/>
                            <input type="checkbox" name="val[disable-landing]" {{config('disable-landing', false) ? 'checked' : null}} class="custom-control-input" id="customCheck16">
                            <label class="custom-control-label" for="customCheck16">{{__('messages.disable-landing-page')}}</label>
                        </div>

                        <hr/>


                        <div class="form-floating mt-3">
                            <input placeholder="{{__('messages.google-analytics-id')}}" type="text" class="form-control" value="{{config('google-analytics-id', '')}}" name="val[google-analytics-id]"/>
                            <label>{{__('messages.google-analytics-id')}}</label>
                        </div>

                        <hr/>

                        <h6 class="mt-4">{{__('messages.social-links')}}</h6>
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
                        <hr/>


                        <div class="form-floating mt-4">
                            <textarea placeholder="{{__('messages.embed-code')}}" class="form-control"  name="val[embed-code]">{{config('embed-code')}}</textarea>
                            <label>{{__('messages.embed-code')}}</label>
                        </div>

                        <div class="floating-button mt-4">
                            <button class="btn btn-float btn-primary">{{__('messages.save-settings')}}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
