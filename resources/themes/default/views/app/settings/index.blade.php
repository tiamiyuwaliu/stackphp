<div class="content-padding scroll-inner-right modern-scroll pr-0">
    <div class="container-lg">
        <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{url('publish')}}">{{__('messages.home')}}</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{__('messages.account')}}</li>
            </ol>
        </nav>

        <h3>{{__('messages.my-account')}}</h3>

        <div class="account-menu-container">
            <a href="{{url('account/profile')}}" data-ajax="true" class="box shadow-lg d-block">
                <div class="icon"><i class="bi bi-person-circle"></i></div>
                <div class="info">
                    <h6>{{__('messages.profile')}}</h6>
                    <p>{{__('messages.update-profile-note')}}</p>
                </div>
                <i class="bi bi-arrow-right arrow"></i>
            </a>
            <a href="{{url('account/security')}}" data-ajax="true" class="box shadow-lg d-block">
                <div class="icon"><i class="bi bi-lock"></i></div>
                <div class="info">
                    <h6>{{__('messages.security')}}</h6>
                    <p>{{__('messages.update-security-note')}}</p>
                </div>
                <i class="bi bi-arrow-right arrow"></i>
            </a>
            <a href="{{url('account/notification')}}" data-ajax="true" class="box shadow-lg d-block">
                <div class="icon"><i class="bi bi-bell"></i></div>
                <div class="info">
                    <h6>{{__('messages.notifications')}}</h6>
                    <p>{{__('messages.update-notification-note')}}</p>
                </div>
                <i class="bi bi-arrow-right arrow"></i>
            </a>
            <a href="{{url('account/api')}}" data-ajax="true" class="box shadow-lg d-block">
                <div class="icon"><i class="bi bi-code-slash"></i></div>
                <div class="info">
                    <h6>{{__('messages.api')}}</h6>
                    <p>{{__('messages.update-api-note')}}</p>
                </div>
                <i class="bi bi-arrow-right arrow"></i>
            </a>

            <a href="{{url('account/cancel')}}" data-ajax="true" class="box shadow-lg d-block">
                <div class="icon"><i class="bi bi-trash"></i></div>
                <div class="info">
                    <h6>{{__('messages.delete')}}</h6>
                    <p>{{__('messages.cancel-account-note')}}</p>
                </div>
                <i class="bi bi-arrow-right arrow"></i>
            </a>
        </div>
    </div>
</div>


