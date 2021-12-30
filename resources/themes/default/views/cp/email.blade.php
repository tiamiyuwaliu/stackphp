<div class="header">
    <h3>{{__('messages.email-setup')}}</h3>
</div>
<ul class="nav nav-line">
    <li class="nav-item">
        <a class="nav-link active" data-bs-toggle="tab" data-bs-target="#general" aria-current="page" href="#">{{__('messages.email-settings')}}</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" data-bs-toggle="tab" data-bs-target="#templates" href="#">{{__('messages.email-templates')}}</a>
    </li>
</ul>
<div class="content-body">
    <div class="tab-content " id="justifiedTabContent">
        <div  class="tab-pane fade show active" id="general" role="tabpanel">
            <form class="general-form " action="{{url('cp/settings')}}" method="post">

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-floating mt-3">
                            <select class="form-control" name="val[email-driver]">
                                <option {{(config('email-driver',1) == 'mail') ? 'selected' : null}} value="mail">{{__('messages.mail')}}</option>
                                <option {{(config('email-driver',1) == 'smtp') ? 'selected' : null}} value="smtp">{{__('messages.smtp')}}</option>
                            </select>
                            <label>{{__('messages.email-driver')}}</label>
                        </div>

                        <div class="form-floating mt-3">
                            <input placeholder="{{__('messages.from_name')}}" type="text"  name="val[from_name]" class="form-control"  value="{{config('from_name', '')}}">
                            <label>{{__('messages.from_name')}}</label>
                        </div>

                        <div class="form-floating mt-3">
                            <input placeholder="{{__('messages.from_address') }}({{__('messages.site-email-address')}})" type="text"  name="val[from_address]" class="form-control"  value="{{config('from_address', '')}}">
                            <label>{{__('messages.from_address') }}({{__('messages.site-email-address')}})</label>
                        </div>


                        <div class="custom-control custom-checkbox mb-4 mt-4">
                            <input type="hidden" name="val[enable-welcome-mail]" value="0"/>
                            <input type="checkbox" name="val[enable-welcome-mail]" {{config('enable-welcome-mail', false) ? 'checked' : null}} class="custom-control-input" id="customCheck12">
                            <label class="custom-control-label" for="customCheck12">{{__('messages.enable-welcome-mail')}}</label>
                        </div>

                        <hr/>
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

                        <div class="mt-4">
                            <button class="btn btn-primary">{{__('messages.save-settings')}}</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>

        <div  class="tab-pane fade" id="templates" role="tabpanel">
            <form class="general-form mt-4" action="{{url('cp/settings')}}" method="post">

                <div class="row">


                    <div class="col-md-6">
                        <h6>{{__('messages.email-templates')}}</h6>
                        <div class="alert alert-dark" role="alert">
                            {{__('messages.you-can-template-info')}}:<br/>
                            {full_name} - {{__('messages.display-user-full-name-info')}},<br/>
                            {email} - {{__('messages.display-user-email-info')}},<br/>
                        </div>
                        <hr/>
                        <h6 class="colored">{{__('messages.activation-email')}}</h6>
                        <hr/>
                        <div class="form-floating mt-3">
                            <input placeholder="{{__('messages.subject')}}" type="text"  name="val[activation-subject]" class="form-control"  value="{{config('activation-subject')}}">
                            <label>{{__('messages.subject')}}</label>
                        </div>
                        <div class="form-floating mt-3">
                            <textarea placeholder="{{__('messages.content')}}" class="form-control" rows="5" name="val[activation-content]">{{config('activation-content', '')}}</textarea>
                            <label>{{__('messages.content')}}</label>
                        </div>
                        <hr/>
                        <h6 class="colored">{{__('messages.reset-password-email')}}</h6>
                        <hr/>
                        <div class="form-floating">
                            <input placeholder="{{__('messages.subject')}}" type="text"  name="val[reset-subject]" class="form-control"  value="{{config('reset-subject')}}">
                            <label>{{__('messages.subject')}}</label>
                        </div>
                        <div class="form-floating mt-3">
                            <textarea placeholder="{{__('messages.content')}}" class="form-control" rows="5" name="val[reset-content]">{{config('reset-content', '')}}</textarea>
                            <label>{{__('messages.content')}}</label>
                        </div>
                        <hr/>
                        <h6 class="colored">{{__('messages.welcome-email')}}</h6>
                        <hr/>
                        <div class="form-floating mt-3">
                            <input type="text" placeholder="{{__('messages.subject')}}"  name="val[welcome-subject]" class="form-control"  value="{{config('welcome-subject', '')}}">
                            <label>{{__('messages.subject')}}</label>
                        </div>
                        <div class="form-floating mt-3">
                            <textarea placeholder="{{__('messages.content')}}" class="form-control" rows="5" name="val[welcome-content]">{{config('welcome-content')}}</textarea>
                            <label>{{__('messages.content')}}</label>
                        </div>

                        <div class="mt-4">
                            <button class="btn btn-primary">{{__('messages.save-settings')}}</button>
                        </div>

                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
