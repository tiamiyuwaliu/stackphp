<div class="content-padding inner-container scroll-inner-right modern-scroll">
    <div class="inner-left">
        <div class="box box-padding">
            <h6 class="fw-bold">{{__('messages.hey')}} {{\App\Repositories\User::repository()->authUser->name}}</h6>
            <p class="m-0 color-grey">{{__('messages.scheduling-overview-note')}}</p>
        </div>

        <div class="box stat">
            <i class="bi bi-calendar-check"></i>
            <div class="info">
                <h4>{{\App\Repositories\Post::repository()->countPosts(1)}}</h4>
                <h6>{{__('messages.published')}}</h6>
            </div>
        </div>

        <div class="box stat">
            <i class="bi bi-calendar2-date"></i>
            <div class="info">
                <h4>{{\App\Repositories\Post::repository()->countPosts(2)}}</h4>
                <h6>{{__('messages.scheduled')}}</h6>
            </div>
        </div>


        <div class="box stat">
            <i class="bi bi-calendar2-x"></i>
            <div class="info">
                <h4>{{\App\Repositories\Post::repository()->countPosts(3)}}</h4>
                <h6>{{__('messages.unpublished')}}</h6>
            </div>
        </div>

        <div class="box stat">
            <i class="bi bi-calendar2-x"></i>
            <div class="info">
                <h4>{{\App\Repositories\Post::repository()->countPosts()}}</h4>
                <h6>{{__('messages.total')}}</h6>
            </div>
        </div>
    </div>
    <div class="inner-right ">
        <div class="box" id="schedule-calender-container" >
            <div class="calendar-filter">
                <ul class="clearfix">
                    <li><a class="{{$type == '2' ? 'active' : null}}" data-ajax="true" href="{{url('publish')}}">{{__('messages.scheduled')}}</a> </li>
                    <li><a class="{{$type == '1' ? 'active' : null}}" data-ajax="true" href="{{url('publish/published')}}">{{__('messages.published')}}</a> </li>
                    <li><a class="{{$type == '3' ? 'active' : null}}" data-ajax="true" href="{{url('publish/unpublished')}}"><i class="bi bi-filter-left"></i> {{__('messages.unpublished')}}</a> </li>
                </ul>
            </div>
            <div class="view-type-container dropdown">
                <a href="" class="dropdown-toggle" data-bs-toggle="dropdown">{{__('messages.'.$display)}}</a>
                <div class="dropdown-menu">
                    <a href="" onclick="return App.switchPostDisplay('month')" class="dropdown-item">{{__('messages.month')}}</a>
                    <a href="" onclick="return App.switchPostDisplay('list')" class="dropdown-item">{{__('messages.list')}}</a>
                </div>
            </div>
            @if($display == 'month')
                <div id="schedule-calender" data-url="{{url('calendar/data')}}?type={{$type}}"></div>
            @else
                <div class="box height-80px">
                </div>

            @endif
        </div>
        @if($display == 'list')
            @if($posts->items())
                <div class="post-list-container">
                    @foreach($posts->items() as $post)
                        {!! view('app/publish/display', ['post' => $post]) !!}
                    @endforeach
                </div>
                {{$posts->links()}}
            @else
                <div class="empty-result">
                    <img  src="{{url('resources/themes/default/images/empty-result.png')}}"/>
                </div>
            @endif
        @endif
    </div>
</div>
