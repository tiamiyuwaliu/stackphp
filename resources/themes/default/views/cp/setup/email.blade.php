<div class="header">
    <h4>{{__('messages.email-setup')}}</h4>
    <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a data-ajax="true" href="{{url('cp/dashboard')}}">{{__('messages.home')}}</a></li>
            <li class="breadcrumb-item"><a data-ajax="true" href="{{url('cp/settings')}}">{{__('messages.settings')}}</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{__('messages.email-setup')}}</li>
        </ol>
    </nav>
</div>

<div class="row">
    <div class="col-md-6">
        <form enctype="multipart/form-data" class="general-form form-auto-submit" data-no-loader="true" action="" method="post">
            <div class="box shadow-sm">
            <h5>{{__('messages.email-settings')}}</h5>

            <div class="form-floating mt-3">
                <select class="form-control" name="val[email-driver]">
                    <option {{(config('email-driver',1) == 'mail') ? 'selected' : null}} value="mail">{{__('messages.mail')}}</option>
                    <option {{(config('email-driver',1) == 'smtp') ? 'selected' : null}} value="smtp">{{__('messages.smtp')}}</option>
                </select>
                <label>{{__('messages.email-driver')}}</label>
            </div>

           <div class="row">
               <div class="col-md-6">
                   <div class="form-floating mt-3">
                       <input placeholder="{{__('messages.from_name')}}" type="text"  name="val[from_name]" class="form-control"  value="{{config('from_name', '')}}">
                       <label>{{__('messages.from_name')}}</label>
                   </div>
               </div>
               <div class="col-md-6">
                   <div class="form-floating mt-3">
                       <input placeholder="{{__('messages.from_address') }}({{__('messages.site-email-address')}})" type="text"  name="val[from_address]" class="form-control"  value="{{config('from_address', '')}}">
                       <label>{{__('messages.from_address') }}({{__('messages.site-email-address')}})</label>
                   </div>
               </div>
           </div>

            <div class="form-floating mt-3 ">
                <input placeholder="{{__('messages.smtp-host')}}" type="text"  name="val[smtp-host]" class="form-control "  value="{{config('smtp-host', '')}}">
                <label >{{__('messages.smtp-host')}}</label>
            </div>
            <div class="form-floating mt-3">
                <input type="text" placeholder="{{__('messages.smtp-username')}}"  name="val[smtp-username]" class="form-control"  value="{{config('smtp-username', '')}}">
                <label >{{__('messages.smtp-username')}}</label>
            </div>
            <div class="form-floating mt-3">
                <input placeholder="{{__('messages.smtp-password')}}" type="text"  name="val[smtp-password]" class="form-control "  value="{{config('smtp-password', '')}}">
                <label>{{__('messages.smtp-password')}}</label>
            </div>
            <div class="form-floating mt-3 ">
                <input placeholder="{{__('messages.smtp-port')}}" type="text"  name="val[smtp-port]" class="form-control"  value="{{config('smtp-port', '')}}">
                <label >{{__('messages.smtp-port')}}</label>
            </div>
            <div class="form-floating mt-3">
                <input  placeholder="{{__('messages.email-charset')}}" type="text"  name="val[email-charset]" class="form-control"  value="{{config('email-charset', 'utf-8')}}">
                <label>{{__('messages.email-charset')}}</label>
            </div>

        </div>
        </form>
    </div>
    <div class="col-md-6">
        <div class="box shadow-sm">
            <h5>{{__('messages.email-templates')}}</h5>

            <form enctype="multipart/form-data" class="general-form form-auto-submit" data-no-loader="true" action="" method="post">
                <div class="clearfix mt-3 mb-3">
                    <div class="float-start">
                        <h6>{{__('messages.enable-welcome-mail')}}</h6>
                        <small>{{__('messages.enable-welcome-mail-note')}}</small>
                    </div>
                    <div class="float-end">
                        <div class="form-check form-switch">
                            <input type="hidden" name="val[enable-welcome-mail]" value="0"/>
                            <input name="val[enable-welcome-mail]" {{config('enable-welcome-mail', false) ? 'checked' : null}} class="form-check-input " type="checkbox" id="flexSwitchCheckCheckedenable-welcome-mail" >
                            <label class="form-check-label" for="flexSwitchCheckCheckedenable-welcome-mail"></label>
                        </div>
                    </div>
                </div>

            </form>



            <ul class="list-group">
                <li class="list-group-item">
                    <div class="d-flex w-100 justify-content-between">
                        <h6>{{__('messages.welcome-email')}}</h6>
                        <a href="" data-bs-toggle="modal"  data-bs-target="#welcomeEmailModal" class="btn "><i class="bi bi-pen"></i></a>
                    </div>
                    <p class="text-muted">{{__('messages.welcome-email-note')}}</p>
                </li>
                <li class="list-group-item">
                    <div class="d-flex w-100 justify-content-between">
                        <h6>{{__('messages.reset-password-email')}}</h6>
                        <a href="" class="btn " data-bs-target="#resetEmailModal" data-bs-toggle="modal"><i class="bi bi-pen"></i></a>
                    </div>
                    <p class="text-muted">{{__('messages.reset-password-note')}}</p>
                </li>
                <li class="list-group-item">
                    <div class="d-flex w-100 justify-content-between">
                        <h6>{{__('messages.activation-email')}}</h6>
                        <a href="" class="btn " data-bs-target="#activateEmailModal" data-bs-toggle="modal"><i class="bi bi-pen"></i></a>
                    </div>
                    <p class="text-muted">{{__('messages.activation-email-note')}}</p>
                </li>


            </ul>
        </div>
    </div>
</div>


<div class="modal" id="welcomeEmailModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form enctype="multipart/form-data" class="general-form"  action="" method="post">
                <div class="modal-header">
                    <h5 class="modal-title">{{__('messages.edit-template')}}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="form-floating mt-3">
                        <input type="text" placeholder="{{__('messages.subject')}}"  name="val[welcome-subject]" class="form-control"  value="{{config('welcome-subject', '')}}">
                        <label>{{__('messages.subject')}}</label>
                    </div>
                    <div class="form-floating mt-3">
                        <textarea placeholder="{{__('messages.content')}}" class="form-control min-textarea-height"  name="val[welcome-content]">{{config('welcome-content')}}</textarea>
                        <label>{{__('messages.content')}}</label>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{__('messages.close')}}</button>
                    <button type="submit" class="btn btn-primary">{{__('messages.save')}}</button>
                </div>
            </form>

        </div>
    </div>
</div>

<div class="modal" id="activateEmailModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form enctype="multipart/form-data" class="general-form"  action="" method="post">
                <div class="modal-header">
                    <h5 class="modal-title">{{__('messages.edit-template')}}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="form-floating mt-3">
                        <input placeholder="{{__('messages.subject')}}" type="text"  name="val[activation-subject]" class="form-control"  value="{{config('activation-subject')}}">
                        <label>{{__('messages.subject')}}</label>
                    </div>
                    <div class="form-floating mt-3">
                        <textarea placeholder="{{__('messages.content')}}" class="form-control min-textarea-height" rows="5" name="val[activation-content]">{{config('activation-content', '')}}</textarea>
                        <label>{{__('messages.content')}}</label>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{__('messages.close')}}</button>
                    <button type="submit" class="btn btn-primary">{{__('messages.save')}}</button>
                </div>
            </form>

        </div>
    </div>
</div>
<div class="modal" id="resetEmailModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form enctype="multipart/form-data" class="general-form"  action="" method="post">
                <div class="modal-header">
                    <h5 class="modal-title">{{__('messages.edit-template')}}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="form-floating">
                        <input placeholder="{{__('messages.subject')}}" type="text"  name="val[reset-subject]" class="form-control"  value="{{config('reset-subject')}}">
                        <label>{{__('messages.subject')}}</label>
                    </div>
                    <div class="form-floating mt-3">
                        <textarea placeholder="{{__('messages.content')}}" class="form-control min-textarea-height" rows="5" name="val[reset-content]">{{config('reset-content', '')}}</textarea>
                        <label>{{__('messages.content')}}</label>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{__('messages.close')}}</button>
                    <button type="submit" class="btn btn-primary">{{__('messages.save')}}</button>
                </div>
            </form>

        </div>
    </div>
</div>

