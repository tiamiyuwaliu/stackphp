<header class="header_area {{(isset($className) ? $className : '')}}">
    <nav class="navbar navbar-expand-lg menu_one menu_four">
        <div class="container">
            <a class="navbar-brand sticky_logo" href="#">
                <img  src="{{url('resources/themes/default/images/logo.png')}}"  alt="logo">
                <img  src="{{url('resources/themes/default/images/logo-dark.png')}}"  alt="logo">
            </a>
            <button class="navbar-toggler collapsed" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="menu_toggle">
                            <span class="hamburger">
                                <span></span>
                                <span></span>
                                <span></span>
                            </span>
                            <span class="hamburger-cross">
                                <span></span>
                                <span></span>
                            </span>
                        </span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav menu w_menu ml-auto">

                    <li class="nav-item">
                        <a class="nav-link " href="#" >
                            {{__('messages.products')}}
                        </a>

                    </li>
                    <li class="nav-item">
                        <a class="nav-link " href="#" >
                            {{__('messages.blog')}}
                        </a>

                    </li>

                    <li class="nav-item dropdown submenu">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            {{__('messages.support')}}
                        </a>
                        <ul class="dropdown-menu">
                            <li class="nav-item"><a href="" class="nav-link">Support ticket</a></li>
                            <li class="nav-item"><a href="" class="nav-link">Documentations</a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link " href="#" >
                            {{__('messages.contact')}}
                        </a>

                    </li>

                    @if(!\App\Repositories\User::repository()->isLoggedIn())
                        <li class="nav-item">
                            <a class="nav-link " href="{{url('signup')}}" >
                                {{__('messages.join-us')}}
                            </a>

                        </li>
                    @endif



                </ul>
                @if(!\App\Repositories\User::repository()->isLoggedIn())
                    <a class="btn_get btn_hover menu_cus" href="{{url('login')}}">{{__('messages.sign-in')}}</a>
                @else
                    <a class="btn_get btn_hover menu_cus" href="{{url('home')}}">{{__('messages.dashboard')}}</a>
                    @endif

            </div>
        </div>
    </nav>
</header>
