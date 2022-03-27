<div class="app-container">
    <div class="nav-pane">
        <a href="" class="logo"><img src="{{url(config('site_icon'))}}"/> </a>

        <ul>
            <li><a class="{{$controller->activeMenu == 'home' ? 'active': null}}" href="{{url('home')}}" data-ajax="true" title="{{__('messages.home')}}" data-bs-toggle="tooltip" data-bs-placement="right"><i class="bi bi-house"></i></a> </li>
            <li><a class="{{$controller->activeMenu == 'products' ? 'active': null}}" href="{{url('products')}}"  title="{{__('messages.products')}}" data-bs-toggle="tooltip" data-bs-placement="right"><i class="bi bi-cart3"></i></a> </li>
            <li><a class="{{$controller->activeMenu == 'account' ? 'active': null}}" data-ajax="true" href="{{url('account')}}" title="{{__('messages.my-account')}}" data-bs-toggle="tooltip" data-bs-placement="right"><i class="bi bi-person-circle"></i></a> </li>
            <li><a class="{{$controller->activeMenu == 'contact' ? 'active': null}}" href="{{url('contact-us')}}" title="{{__('messages.contact-us')}}" data-bs-toggle="tooltip" data-bs-placement="right"><i class="bi bi-envelope-check"></i></a> </li>

            @if(\App\Repositories\User::repository()->isAdmin())
                <li><a href="{{url('cp')}}" title="{{__('messages.control-panel')}}" data-bs-toggle="tooltip" data-bs-placement="right"><i class="bi bi-gear"></i></a> </li>
            @endif
        </ul>

        <a href="" class="doc-btn" title="{{__('messages.documentation')}}" data-bs-toggle="tooltip" data-bs-placement="right"><i class="bi bi-question-circle"></i></a>
    </div>
    <div class="content">
        <div class="header">
            <div class="container">
                <div class="clearfix">
                    <div class="float-start">
                        <div class="d-flex">
                            <div class="flex-shrink-0">
                                <img src="{{\App\Repositories\User::repository()->getAvatar()}}" alt="...">
                            </div>
                            <div class="flex-grow-1 ms-3">
                                {{\App\Repositories\User::repository()->getUser()->name}}
                                <h5>Welcome back!!</h5>
                            </div>
                        </div>
                    </div>
                    <div class="float-end">
                        <div class="mt-3">
                            <a href="{{url('logout')}}" class="btn btn-outline-secondary btn-sm hide-mobile"> {{__('messages.logout')}}</a>
                            <a href="{{url('account')}}" data-ajax="true" class="btn btn-primary btn-sm"><i class="bi bi-person-circle show-mobile"></i> <span class="hide-mobile">{{__('messages.my-account')}}</span></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="page-content">
            <div class="container">
                {!! $content !!}
            </div>
        </div>
    </div>
</div>

