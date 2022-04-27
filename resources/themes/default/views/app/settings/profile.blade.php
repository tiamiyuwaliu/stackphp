<div class="content-padding scroll-inner-right modern-scroll pr-0">
    <div class="container-lg">
        <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{url('publish')}}" data-ajax="true">{{__('messages.home')}}</a></li>
                <li class="breadcrumb-item" ><a href="{{url('account')}}" data-ajax="true">{{__('messages.account')}}</a> </li>
                <li class="breadcrumb-item active"  aria-current="page">{{__('messages.profile')}}</li>
            </ol>
        </nav>

        <h3>{{__('messages.profile')}}</h3>

        <div class="box box-padding">
            <div class="row">
                <div class="col-2">
                    <h6 class="mt-4">{{__('messages.photo')}}</h6>
                </div>
                <div class="col-8">
                    <a href="" class="account-user-avatar user-avatar-round-sm upload-btn" style="background-image: url({{\App\Repositories\User::repository()->getAvatar()}})">
                        <div><i class="bi bi-camera"></i></div>
                        <form method="post"  data-upload="#upload-progress" action="<?php echo url('account/profile')?>" enctype="multipart/form-data" class="general-form filemanager-uploader">
                            <input type="hidden" name="val[action]" value="upload"/>
                            <input multiple onchange="App.validateFileSize(this, 'image-video','App.submitFileUpload')" type="file" name="file" class="upload-computer-input">

                        </form>
                    </a>
                </div>
            </div>
            <form action="{{url('account/profile')}}" method="post" class="general-form">
                <input type="hidden" name="val[action]" value="profile"/>
                <div class="row mt-3">
                    <div class="col-2">
                        <h6 class="mt-4">{{__('messages.full-name')}}</h6>
                    </div>
                    <div class="col-8">
                        <div class="form-floating mb-3">
                            <input required type="text" name="val[name]" value="{{\App\Repositories\User::repository()->authUser->name}}" class="form-control" id="floatingInputName" placeholder="{{__('messages.full-name')}}">
                            <label for="floatingInputName">{{__('messages.full-name')}}</label>
                        </div>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-2">
                        <h6 class="mt-4">{{__('messages.email-address')}}</h6>
                    </div>
                    <div class="col-8">
                        <div class="form-floating mb-3">
                            <input required type="text" name="val[email]" value="{{\App\Repositories\User::repository()->authUser->email}}" class="form-control" id="floatingInputEmail" placeholder="{{__('messages.email-address')}}">
                            <label for="floatingInputEmail">{{__('messages.email-address')}}</label>
                        </div>
                    </div>
                </div>

                <div class="row mt-3">
                    <div class="col-2">
                        <h6 class="mt-4">{{__('messages.gender')}}</h6>
                    </div>
                    <div class="col-8">
                        <div class="form-floating">
                            <?php $gender = \App\Repositories\User::repository()->authUser->gender;?>
                            <select name="val[gender]" class="form-select" id="floatingSelectGender" aria-label="{{__('messages.gender')}}">
                                <option value="male" {{($gender == 'male') ? 'selected' : null}}>{{__('messages.male')}}</option>
                                <option value="female" {{($gender == 'female') ? 'selected' : null}}>{{__('messages.female')}}</option>
                            </select>
                            <label for="floatingSelectGender">{{__('messages.gender')}}</label>
                        </div>
                    </div>
                </div>

                <div class="row mt-3">
                    <div class="col-2">
                        <h6 class="mt-4">{{__('messages.timezone')}}</h6>
                    </div>
                    <div class="col-8">
                        <div class="form-floating">
                            <?php $timezone = \App\Repositories\User::repository()->authUser->timezone;?>
                            <select name="val[timezone]" class="form-select" id="floatingSelectTimezone" aria-label="{{__('messages.timezone')}}">
                                @foreach(getTimezones() as $key => $value)
                                    <option value="{{$key}}" {{($key == $timezone) ? 'selected' : null}}>{{$value}}</option>
                                @endforeach

                            </select>
                            <label for="floatingSelectTimezone">{{__('messages.timezone')}}</label>
                        </div>
                    </div>
                </div>

                <div class="mt-4">
                    <button type="submit" class="btn btn-primary">{{__('messages.save-changes')}}</button>
                </div>
            </form>
        </div>
    </div>
</div>
