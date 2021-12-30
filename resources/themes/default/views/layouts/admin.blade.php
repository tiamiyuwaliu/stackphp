<div id="admin-container">
    <div class="left-pane shadow-sm">
        <a href="" class="logo"><img src="<?php echo url('resources/themes/default/images/logo.png')?>?v=1"/></a>

        <div class="dropdown user-menu">
            <a href="" class="" data-bs-toggle="dropdown" >
                <img src="{{\App\Repositories\User::repository()->getAvatar()}}"/> {{\App\Repositories\User::repository()->authUser->name}}
                <i class="bi bi-chevron-down" ></i>
            </a>
            <div class="dropdown-menu shadow-lg border-0">
                <a class="dropdown-item" href="#">Visit Website</a>
                <a class="dropdown-item" href="#">Edit Profile</a>
                <hr class="dropdown-divider">
                <a class="dropdown-item" href="#">Logout</a>
            </div>

            <ul>
                <li><a data-ajax="true" href="{{url('cp')}}" class="{{($controller->activeMenu == 'dashboard' ? 'active' : '')}}"><i class="bi bi-house" ></i> Dashboard</a> </li>
                <li><a data-ajax="true" href="{{url('cp/users')}}" class="{{($controller->activeMenu == 'users' ? 'active' : '')}}"><i class="bi bi-people" ></i> User Manager</a> </li>
                <li><a data-ajax="true" href="{{url('cp/settings')}}" class="{{($controller->activeMenu == 'settings' ? 'active' : '')}}"><i class="bi bi-gear" ></i> Website settings</a> </li>
                <li><a data-ajax="true" href="{{url('cp/email')}}" class="{{($controller->activeMenu == 'email' ? 'active' : '')}}"><i class="bi bi-envelope-check" ></i> Email setup</a> </li>
                <li><a data-ajax="true" href="{{url('cp/modules')}}" class="{{($controller->activeMenu == 'modules' ? 'active' : '')}}"><i class="bi bi-box" ></i> Module Manager</a> </li>
                <li><a data-ajax="true" href="{{url('cp/pages')}}"  class="{{($controller->activeMenu == 'pages' ? 'active' : '')}}"><i class="bi bi-clipboard-plus" ></i> Pages</a> </li>
                <li><a data-ajax="true" href="{{url('cp/themes')}}" class="{{($controller->activeMenu == 'themes' ? 'active' : '')}}"><i class="bi bi-palette" ></i> Themes</a> </li>
            </ul>
        </div>


        <div class="support-btn dropup">
            <a href="" class="shadow-lg btn-dark" data-bs-toggle="dropdown"><i class="bi bi-question-lg"></i></a>
            <ul class="dropdown-menu shadow-lg border-0">
                <li><h6 class="dropdown-header">Need Help?</h6></li>
                <li><a class="dropdown-item" href="#">Visit support center</a></li>
                <li><a class="dropdown-item" href="#">Forum</a></li>
            </ul>
        </div>
    </div>
    <div class="right-pane">
        <a href="" onclick="return App.toggleAdminMenu()" class="menu-toggle"><i class="bi bi-list"></i></a>
        {!! $content !!}
    </div>
</div>

