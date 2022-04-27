<div class="content-padding modern-scroll scroll-inner-right-top">
    <div class="container">
        <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a data-ajax="true" href="{{url('channels')}}">{{__('messages.channels')}}</a></li>
                <li class="breadcrumb-item active" aria-current="page">Instagram</li>
            </ol>
        </nav>

        <div class="row social-change-page-container">
            <div class="col-sm-2">
                <div class="icon instagram-bg">
                    <i class="bi bi-instagram"></i>
                </div>
                <h4>Instagram</h4>
            </div>
            <div class="col-sm-10">
                <div class="box box-padding clearfix">
                    <div class="float-start">
                        {{__('messages.connect-instagram-note')}}
                    </div>
                    <div class="float-end">
                        <a href="{{url('channel/instagram')}}?auth=true" class="btn btn-outline-secondary ajax-action"><i class="bi bi-person-plus"></i> {{__('messages.connect')}}</a>
                    </div>
                </div>

                @if($channels)
                    <div class="box box-padding">


                        <div class="channels-list">
                            @foreach($channels as $channel)
                                {!! view('app/channels/display', ['channel' => $channel]) !!}
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
