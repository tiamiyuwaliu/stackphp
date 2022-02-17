<div id="admin-container">
    <div class="left-pane shadow-sm">
        <a href="" class="logo"><img src="<?php echo url(config('site_logo'))?>?v=1"/></a>

        <div class=" user-menu">
            <ul>
                <li class="{{($controller->activeMenu == 'dashboard' ? 'active' : '')}}"><a data-ajax="true" href="{{url('cp')}}" ><i class="bi bi-house" ></i>
                    {{__('messages.dashboard')}}</a> </li>

            </ul>

            <h4>{{__('messages.setup')}}</h4>
            <ul>
                <li class="has-sub-menus {{($controller->activeSubMenu == 'settings' ? 'opened' : '')}} ">
                    <a  href="" class="" onclick="return App.openMenu(this)"><i class="bi bi-gear" ></i> {{__('messages.settings')}}</a>
                    <i class="bi bi-plus plus"></i>
                    <i class="bi bi-dash dash"></i>

                    <ul>
                        <li class="{{($controller->activeMenu == 'settings' ? 'active' : '')}}"><a data-ajax="true" href="{{url('cp/settings')}}">{{__('messages.general-configuration')}} </a> </li>
                        <li class="{{($controller->activeMenu == 'information' ? 'active' : '')}}"><a href="{{url('cp/settings/information')}}" data-ajax="true">{{__('messages.website-information')}} </a> </li>
                        <li class="{{($controller->activeMenu == 'email' ? 'active' : '')}}"><a href="{{url('cp/settings/email')}}" data-ajax="true">{{__('messages.email-setup')}} </a> </li>
                        <li class="{{($controller->activeMenu == 'social' ? 'active' : '')}}"><a href="{{url('cp/settings/social')}}" data-ajax="true">{{__('messages.social-login-settings')}} </a> </li>
                        <li class="{{($controller->activeMenu == 'upload' ? 'active' : '')}}"><a href="{{url('cp/settings/upload')}}" data-ajax="true">{{__('messages.upload-configuration')}} </a> </li>
                    </ul>
                </li>
                <li class="{{($controller->activeMenu == 'themes' ? 'active' : '')}}"><a data-ajax="true" href="{{url('cp/themes')}}" ><i class="bi bi-palette" ></i> {{__('messages.themes')}}</a> </li>

            </ul>
            <h4>{{__('messages.management')}}</h4>
            <ul>
                <li class="has-sub-menus {{($controller->activeSubMenu == 'users' ? 'opened' : '')}}">
                    <a  href="" onclick="return App.openMenu(this)"><i class="bi bi-people" ></i> {{__('messages.users-manager')}}</a>
                    <i class="bi bi-plus plus"></i>
                    <i class="bi bi-dash dash"></i>

                    <ul>
                       <li class="{{($controller->activeMenu == 'users' ? 'active' : '')}}">
                           <a data-ajax="true" href="{{url('cp/users')}}" >{{__('messages.users-manager')}}</a>
                           <a data-ajax="true" href="{{url('cp/users')}}" >{{__('messages.add-user')}}</a>
                       </li>
                    </ul>
                </li>
                <li class="{{($controller->activeMenu == 'modules' ? 'active' : '')}}">
                    <a data-ajax="true" href="{{url('cp/modules')}}" ><i class="bi bi-box" ></i> {{__('messages.modules-manager')}}</a>
                </li>
                <li class="{{($controller->activeMenu == 'pages' ? 'active' : '')}}">
                    <a data-ajax="true" href="{{url('cp/pages')}}"  ><i class="bi bi-clipboard-plus" ></i> {{__('messages.pages')}}</a>
                </li>
            </ul>
            <h4>{{__('messages.others')}}</h4>
            <ul>
                <li class="has-sub-menus {{($controller->activeSubMenu == 'languages' ? 'opened' : '')}}">
                    <a  href="" onclick="return App.openMenu(this)"><i class="bi bi-people" ></i> {{__('messages.users-manager')}}</a>
                    <i class="bi bi-plus plus"></i>
                    <i class="bi bi-dash dash"></i>

                    <ul>
                        <li class="{{($controller->activeMenu == 'users' ? 'active' : '')}}">
                            <a data-ajax="true" href="{{url('cp/users')}}" >{{__('messages.users-manager')}}</a>
                            <a data-ajax="true" href="{{url('cp/users')}}" >{{__('messages.add-user')}}</a>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>


        <div class="support-btn dropup">
            <a href="" class="shadow-lg btn-primary" data-bs-toggle="dropdown"><i class="bi bi-question-lg"></i></a>
            <ul class="dropdown-menu shadow-lg border-0">
                <li><h6 class="dropdown-header">Need Help?</h6></li>
                <li><a class="dropdown-item" href="#">Visit support center</a></li>
                <li><a class="dropdown-item" href="#">Forum</a></li>
            </ul>
        </div>
    </div>
    <div class="right-pane">
        <div class="main-header   ">
            <a href="" onclick="return App.toggleAdminMenu()" class="menu-toggle"><i class="bi bi-list"></i></a>

            <form class="search" action="" method="post">
                <input placeholder="Search control panel..." type="text" name="term"/>
                <select>
                    <option value="{{url('cp/users')}}">{{__('messages.users')}}</option>
                </select>
                <i class="bi bi-search"></i>
            </form>

            <ul class="clearfix">
                <li class="dropdown user-menu">
                    <a data-bs-toggle="dropdown" href="" class="dropdown-toggle">
                        <img src="{{\App\Repositories\User::repository()->getAvatar()}}"/>
                        {{\App\Repositories\User::repository()->getUser()->name}}
                    </a>
                    <div class="dropdown-menu">
                        <a href="" class="dropdown-item">Logout </a>
                    </div>
                </li>
            </ul>
        </div>
        <div class="main-content">
            {!! $content !!}
        </div>
    </div>
</div>

