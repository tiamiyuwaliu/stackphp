<div class="header">
    <h4>{{__('messages.links')}}</h4>
    <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a data-ajax="true" href="{{url('cp/dashboard')}}">{{__('messages.home')}}</a></li>
            <li class="breadcrumb-item"><a data-ajax="true" href="{{url('cp/settings')}}">{{__('messages.settings')}}</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{__('messages.links')}}</li>
        </ol>
    </nav>
</div>

<form enctype="multipart/form-data" class="general-form form-auto-submit" data-no-loader="true" action="" method="post">

    <div class="row">
        <div class="col-md-6">
           <div class="box shadow-sm">
               <div class="form-floating mt-3">
                   <input placeholder="{{__('messages.branding')}}" type="text" class="form-control" value="{{config('link-branding', 'by Social Box')}}" name="val[link-branding]"/>
                   <label>{{__('messages.branding')}}</label>
               </div>

               <div class="form-floating mt-3">
                   <input placeholder="{{__('messages.base-domain')}}" type="text" class="form-control" value="{{config('link-base-domain', url('/'))}}" name="val[link-base-domain]"/>
                   <label>{{__('messages.base-domain')}}</label>
               </div>
           </div>

            <div class="box shadow-sm mt-4">
                <h6>{{__('messages.google-safe-api')}}</h6>
                <small>{{__('messages.google-safe-api-note')}}</small>

                <div class="clearfix mt-3 mb-3">
                    <div class="float-start">
                        <h6>{{__('messages.enable')}}</h6>

                    </div>
                    <div class="float-end">
                        <div class="form-check form-switch">
                            <input type="hidden" name="val[enable-google-safe]" value="0"/>
                            <input name="val[enable-google-safe]" {{config('enable-google-safe', false) ? 'checked' : null}} class="form-check-input " type="checkbox" id="flexSwitchCheckCheckedenable-google-safe" >
                            <label class="form-check-label" for="flexSwitchCheckCheckedenable-google-safe"></label>
                        </div>
                    </div>
                </div>

                <div class="form-floating mt-3">
                    <input placeholder="{{__('messages.google-safe-key')}}" type="text" class="form-control" value="{{config('google-safe-key', '')}}" name="val[google-safe-key]"/>
                    <label>{{__('messages.google-safe-key')}}</label>
                </div>
            </div>
        </div>
    </div>

</form>
