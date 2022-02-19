<div class="header">
    <h4>{{__('messages.general-configuration')}}</h4>
    <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a data-ajax="true" href="{{url('cp/dashboard')}}">{{__('messages.home')}}</a></li>
            <li class="breadcrumb-item"><a data-ajax="true" href="{{url('cp/settings')}}">{{__('messages.settings')}}</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{__('messages.general-configuration')}}</li>
        </ol>
    </nav>
</div>

<form enctype="multipart/form-data" class="general-form form-auto-submit" data-no-loader="true" action="" method="post">
    <div class="row">
        <div class="col-md-6">
            <div class="box shadow-sm">
                <h5>{{__('messages.general')}}</h5>

                <div class="clearfix mt-3 mb-3">
                    <div class="float-start">
                        <h6>{{__('messages.maintenance-mode')}}</h6>
                        <small>{{__('messages.maintenance-mode-note')}}</small>
                    </div>
                    <div class="float-end">
                        <div class="form-check form-switch">
                            <input type="hidden" name="val[enable-maintenance]" value="0"/>
                            <input name="val[enable-maintenance]" {{config('enable-maintenance', false) ? 'checked' : null}} class="form-check-input " type="checkbox" id="flexSwitchCheckCheckedMode" >
                            <label class="form-check-label" for="flexSwitchCheckCheckedMode"></label>
                        </div>
                    </div>
                </div>

                <div class="clearfix mt-3 mb-3">
                    <div class="float-start">
                        <h6>{{__('messages.enable-gdpr')}}</h6>
                        <small>{{__('messages.enable-gdpr-note')}}</small>
                    </div>
                    <div class="float-end">
                        <div class="form-check form-switch">
                            <input type="hidden" name="val[enable-maintenance]" value="0"/>
                            <input name="val[enable-gdpr]" {{config('enable-gdpr', true) ? 'checked' : null}} class="form-check-input " type="checkbox" id="flexSwitchCheckCheckedgdpr" >
                            <label class="form-check-label" for="flexSwitchCheckCheckedgdpr"></label>
                        </div>
                    </div>
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
            </div>

            <div class="box shadow-sm mt-3">
                <h5>{{__('messages.google-analytic-code')}}</h5>

                <div class="form-floating mt-3">
                    <input placeholder="{{__('messages.google-analytics-id')}}" type="text" class="form-control" value="{{config('google-analytics-id', '')}}" name="val[google-analytics-id]"/>
                    <label>{{__('messages.google-analytics-id')}}</label>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="box shadow-sm">
                <h5>{{__('messages.login-registration')}}</h5>

                <div class="clearfix mt-3 mb-3">
                    <div class="float-start">
                        <h6>{{__('messages.enable-registration')}}</h6>
                        <small>{{__('messages.enable-registration-note')}}</small>
                    </div>
                    <div class="float-end">
                        <div class="form-check form-switch">
                            <input type="hidden" name="val[enable-signup]" value="0"/>
                            <input name="val[enable-signup]" {{config('enable-signup', false) ? 'checked' : null}} class="form-check-input " type="checkbox" id="flexSwitchCheckCheckedSignup" >
                            <label class="form-check-label" for="flexSwitchCheckCheckedSignup"></label>
                        </div>
                    </div>
                </div>

                <div class="clearfix mt-3 mb-3">
                    <div class="float-start">
                        <h6>{{__('messages.enable-social-login')}}</h6>
                        <small>{{__('messages.enable-social-login-note')}}</small>
                    </div>
                    <div class="float-end">
                        <div class="form-check form-switch">
                            <input type="hidden" name="val[enable-social-login]" value="0"/>
                            <input name="val[enable-social-login]" {{config('enable-social-login', false) ? 'checked' : null}} class="form-check-input " type="checkbox" id="flexSwitchCheckCheckedLogin" >
                            <label class="form-check-label" for="flexSwitchCheckCheckedLogin"></label>
                        </div>
                    </div>
                </div>
            </div>

            <div class="box shadow-sm mt-3">
                <h5>Google reCaptcha V2</h5>
                <div class="clearfix mt-3 mb-3">
                    <div class="float-start">
                        <h6>{{__('messages.enable')}}</h6>
                    </div>
                    <div class="float-end">
                        <div class="form-check form-switch">
                            <input type="hidden" name="val[enable-captcha]" value="0"/>
                            <input name="val[enable-captcha]" {{config('enable-captcha', false) ? 'checked' : null}} class="form-check-input " type="checkbox" id="flexSwitchCheckCheckedCaptcha" >
                            <label class="form-check-label" for="flexSwitchCheckCheckedCaptcha"></label>
                        </div>
                    </div>
                </div>

                <div class="form-floating mt-3">
                    <input placeholder="{{__('messages.captcha-site-key')}}" type="text" class="form-control" value="{{config('captcha-site-key')}}" name="val[captcha-site-key]"/>
                    <label>{{__('messages.captcha-site-key')}}</label>
                </div>

                <div class="form-floating mt-3">
                    <input placeholder="{{__('messages.captcha-site-secret-key')}}" type="text" class="form-control" value="{{config('captcha-site-secret-key')}}" name="val[captcha-site-secret-key]"/>
                    <label>{{__('messages.captcha-site-secret-key')}}</label>
                </div>
            </div>
        </div>
    </div>
</form>

