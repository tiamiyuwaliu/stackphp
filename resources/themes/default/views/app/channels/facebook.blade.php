<div class="content-padding modern-scroll scroll-inner-right-top">
    <div class="container">
        <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a data-ajax="true" href="{{url('channels')}}">{{__('messages.channels')}}</a></li>
                <li class="breadcrumb-item active" aria-current="page">Facebook</li>
            </ol>
        </nav>

        <div class="row social-change-page-container">
            <div class="col-sm-2">
                <div class="icon facebook-bg">
                    <i class="bi bi-facebook"></i>
                </div>
                <h4>Facebook</h4>
            </div>
            <div class="col-sm-10">
                <div class="box box-padding clearfix">
                    <div class="float-start">
                        {{__('messages.connect-facebook-note')}}
                    </div>
                    <div class="float-end">
                        <a href="{{url('channel/facebook')}}?auth=true" class="btn btn-outline-secondary ajax-action"><i class="bi bi-person-plus"></i> {{__('messages.connect')}}</a>
                    </div>
                </div>

                @if($pages)
                    <div class="box box-padding">
                        <h6>Connected Page</h6>
                        <hr/>

                        <div class="channels-list">
                            @foreach($pages as $channel)
                                {!! view('app/channels/display', ['channel' => $channel]) !!}
                            @endforeach
                        </div>
                    </div>
                    @endif
                @if($groups)
                    <div class="box box-padding mt-5">
                        <h6>Connected Group</h6>
                        <hr/>
                        <div class="channels-list">
                            @foreach($groups as $channel)
                                {!! view('app/channels/display', ['channel' => $channel]) !!}
                            @endforeach
                        </div>
                    </div>
                    @endif
            </div>
        </div>
    </div>
</div>
