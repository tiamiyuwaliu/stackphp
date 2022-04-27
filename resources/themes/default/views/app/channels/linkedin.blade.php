<div class="content-padding modern-scroll scroll-inner-right-top">
    <div class="container">
        <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a data-ajax="true" href="{{url('channels')}}">{{__('messages.channels')}}</a></li>
                <li class="breadcrumb-item active" aria-current="page">LinkedIn</li>
            </ol>
        </nav>

        <div class="row social-change-page-container">
            <div class="col-sm-2">
                <div class="icon linkedin-bg">
                    <i class="bi bi-linkedin"></i>
                </div>
                <h4>LinkedIn</h4>
            </div>
            <div class="col-sm-10">
                <div class="box box-padding clearfix">
                    <div class="float-start">
                        {{__('messages.connect-linkedin-note')}}
                    </div>
                    <div class="float-end">
                        <a href="{{url('channel/linkedin')}}?auth=true" class="btn btn-outline-secondary ajax-action"><i class="bi bi-person-plus"></i> {{__('messages.connect')}}</a>
                    </div>
                </div>

                @if(count($profiles))
                    <div class="box box-padding">
                        <div class="channels-list">
                            @foreach($profiles as $channel)
                                {!! view('app/channels/display', ['channel' => $channel]) !!}
                            @endforeach
                        </div>
                    </div>
                @endif
                @if(count($pages))
                    <div class="box box-padding mt-5">
                        <h6>Connected Pages</h6>
                        <hr/>
                        <div class="channels-list">
                            @foreach($pages as $channel)
                                {!! view('app/channels/display', ['channel' => $channel]) !!}
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
