<div class="content-padding modern-scroll scroll-inner-right-top">
    <div class="container">
        <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a data-ajax="true" href="{{url('channels')}}">{{__('messages.channels')}}</a></li>
                <li class="breadcrumb-item active" aria-current="page">Telegram</li>
            </ol>
        </nav>

        <div class="row social-change-page-container">
            <div class="col-sm-2">
                <div class="icon tumblr-bg">
                    <i class="bi bi-telegram"></i>
                </div>
                <h4>Telegram</h4>
            </div>
            <div class="col-sm-10">
                <div class="box box-padding clearfix">
                    <div class="float-start">
                        {{__('messages.connect-telegram-note')}}
                    </div>
                    <div class="float-end dropdown">
                        <a href="" data-bs-toggle="dropdown" class="btn btn-outline-secondary dropdown-toggle"><i class="bi bi-person-plus"></i> {{__('messages.connect')}}</a>
                        <div class="dropdown-menu dropdown-menu-end">
                            <a href="https://core.telegram.org/bots" target="_blank" class="dropdown-item">{{__('messages.create-a-bot')}}</a>
                            <a href="" data-bs-target="#telegramModal" data-bs-toggle="modal" class="dropdown-item">{{__('messages.connect-bot')}}</a>
                        </div>
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

<div class="modal" tabindex="-1" id="telegramModal">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">{{__('messages.connect-bot')}}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{url('channel/telegram')}}" method="post" class="general-form">
                <input type="hidden" name="val[action]" value="bot"/>
                <div class="modal-body">
                    <div class="form-floating">
                        <input type="text" class="form-control" name="val[token]" id="importImageInput" placeholder="{{__('messages.bot-token')}}"/>
                        <label for="floatingInput">{{__('messages.bot-token')}}</label>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary"><i class="bi bi-check2"></i></button>
                </div>
            </form>
        </div>
    </div>
</div>

