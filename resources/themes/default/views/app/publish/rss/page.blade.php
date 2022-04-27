<div class="content-padding  scroll-inner-right modern-scroll">
    <div class="container">
        <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a data-ajax="true" href="{{url('publish/rss')}}">{{__('messages.rss-feed')}}</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{$rss->title}}</li>
            </ol>
        </nav>
        <div class="box box-padding d-flex">
            <h6 class="flex-grow-1">{{$rss->title}}</h6>
            <div class="">
                <a href="{{url('publish/rss?action=delete&id='.$rss->id)}}"   class="btn btn-secondary btn-sm confirm" data-ajax-action="true">{{__('messages.delete-feed')}}</a>
            </div>
        </div>


        <div class="row">
            <div class="col-md-4">
                <div class="box stat">
                    <i class="bi bi-calendar-check"></i>
                    <div class="info">
                        <h4>{{\App\Repositories\Post::repository()->countRssPosts($rss->id,1)}}</h4>
                        <h6>{{__('messages.scheduled')}}</h6>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="box stat">
                    <i class="bi bi-calendar-check"></i>
                    <div class="info">
                        <h4>{{\App\Repositories\Post::repository()->countRssPosts($rss->id,0)}}</h4>
                        <h6>{{__('messages.unscheduled')}}</h6>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="box stat">
                    <i class="bi bi-calendar-check"></i>
                    <div class="info">
                        <h4>{{\App\Repositories\Post::repository()->countRssPosts($rss->id)}}</h4>
                        <h6>{{__('messages.total')}}</h6>
                    </div>
                </div>
            </div>
        </div>
            <div class="empty-result">
                <img  src="{{url('resources/themes/default/images/empty-result.png')}}"/>
            </div>

    </div>
</div>
