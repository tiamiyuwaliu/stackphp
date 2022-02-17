<div class="header">
    <h4>{{__('messages.website-information')}}</h4>
    <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a data-ajax="true" href="{{url('cp/dashboard')}}">{{__('messages.home')}}</a></li>
            <li class="breadcrumb-item"><a data-ajax="true" href="{{url('cp/settings')}}">{{__('messages.settings')}}</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{__('messages.website-information')}}</li>
        </ol>
    </nav>
</div>

<form enctype="multipart/form-data" class="general-form form-auto-submit" data-no-loader="true" action="" method="post">
    <div class="row">
        <div class="col-md-6">
            <div class="box shadow-sm">
                <h5>{{__('messages.site')}}</h5>
                <div class="form-floating mt-3">
                    <input placeholder="{{__('messages.site-name')}}" type="text" class="form-control" id="siteTitleInput" value="<?php echo config('site-title','')?>" name="val[site-title]"/>
                    <label for="siteTitleInput">{{__('messages.site-name')}}</label>
                </div>
            </div>

            <div class="box shadow-sm mt-3">
                <h5>{{__('messages.seo-details')}}</h5>

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
            </div>
        </div>
        <div class="col-md-6">
            <div class="box shadow-sm ">
                <h5>{{__('messages.logo-favicon')}}</h5>

                <div class="form-group mt-3">
                    <div class="clearfix mb-3">
                        <div class="float-start"><label>{{__('messages.site-logo')}}</label></div>
                        <div class="float-end">
                            <img src="{{url(config('site_logo','resources/themes/default/images/logo.png'))}}" class="width-100"/>
                        </div>
                    </div>

                    <input type="hidden" name="img[site_logo]" value="<?php echo config('site_logo','resources/themes/default/images/logo.png')?>"/>
                    <input type="file"  name="site_logo" class="form-control " />
                </div>

                <div class="form-group mt-3">
                    <div class="clearfix mb-3">
                        <div class="float-start"><label>{{__('messages.site-logo_light')}}</label></div>
                        <div class="float-end">
                            <img src="{{url(config('site_logo_light','resources/themes/default/images/logo-light.png'))}}" class="width-100"/>
                        </div>
                    </div>

                    <input type="hidden" name="img[site_logo_light]" value="<?php echo config('site_logo','resources/themes/default/images/logo-light.png')?>"/>
                    <input type="file"  name="site_logo_light" class="form-control " />
                </div>


                <div class="form-group mt-3">
                    <div class="clearfix mb-3">
                        <div class="float-start"><label>{{__('messages.short-icon')}}</label></div>
                        <div class="float-end">
                            <img src="{{url(config('site_icon','resources/themes/default/images/icon.png'))}}" class="width-30"/>
                        </div>
                    </div>

                    <input type="hidden" name="img[site_icon]" value="<?php echo config('site_icon','resources/themes/default/images/icon.png')?>"/>
                    <input type="file"  name="site_icon" class="form-control " />
                </div>

                <div class="form-group mt-3">
                    <div class="clearfix mb-3">
                        <div class="float-start"><label>{{__('messages.favicon')}}</label></div>
                        <div class="float-end">
                            <img src="{{url(config('favicon','resources/themes/default/images/favicon.png'))}}" class="width-30"/>
                        </div>
                    </div>

                    <input type="hidden" name="img[favicon]" value="<?php echo config('favicon','resources/themes/default/images/favicon.png')?>"/>
                    <input type="file"  name="favicon" class="form-control " />
                </div>
            </div>
        </div>
    </div>
</form>

