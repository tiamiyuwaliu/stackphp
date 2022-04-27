<div class="content-padding  scroll-inner-right modern-scroll">
    <div class="container">
        <div class="box box-padding d-flex">
            <h6 class="flex-grow-1">{{__('messages.rss-feed')}}</h6>
            <div class="">
                <a href="" data-bs-target="#newFeedModal" data-bs-toggle="modal"  class="btn btn-secondary btn-sm">{{__('messages.add-feed')}}</a>
            </div>
        </div>

        @if(count($rssLists->items()))
           <div class="rss-list-container">
               @foreach($rssLists->items() as $rss)
                   {!! view('app/publish/rss/display', ['rss' => $rss, 'channels' => $channels]) !!}
               @endforeach
           </div>
        @else
            <div class="empty-result">
                <img  src="{{url('resources/themes/default/images/empty-result.png')}}"/>
            </div>
        @endif
    </div>
</div>

<div class="modal fade" id="newFeedModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">{{__('messages.add-feed')}}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{url('publish/rss')}}" method="post" class="general-form">
                <input type="hidden" name="val[action]" value="add"/>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <label class="form-label">{{__('messages.title')}}</label>
                            <input required type="text" name="val[title]" class="form-control"/>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">{{__('messages.feed-url')}}</label>
                            <input required type="text" name="val[url]" class="form-control"/>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-12"><label class="form-label">{{__('messages.what-action-perform')}}</label></div>
                        <div class="col-4">
                            <div class="form-check">
                                <input class="form-check-input" value="0" checked type="radio" name="val[action_type]" id="flexRadioNoAction">
                                <label class="form-check-label" for="flexRadioNoAction">
                                    {{__('messages.no-action')}}
                                </label>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-check">
                                <input class="form-check-input" value="1" type="radio" name="val[action_type]" id="flexRadioAutoPost">
                                <label class="form-check-label" for="flexRadioAutoPost">
                                    {{__('messages.auto-post')}}
                                </label>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-check">
                                <input class="form-check-input" value="2" type="radio" name="val[action_type]" id="flexRadioAutoSchedule">
                                <label class="form-check-label" for="flexRadioAutoSchedule">
                                    {{__('messages.auto-schedule')}}
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="col-md-6">
                            <label class="form-label">{{__('messages.include-words')}}</label>
                            <input  type="text" name="val[include]" class="form-control"/>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">{{__('messages.exclude-words')}}</label>
                            <input  type="text" name="val[exclude]" class="form-control"/>
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="col-12"><label class="form-label">{{__('messages.what-content-to-use')}}</label></div>
                        <div class="col-6">
                            <div class="form-check">
                                <input class="form-check-input" value="0" checked type="radio" name="val[type]" id="flexRadioTitle">
                                <label class="form-check-label" for="flexRadioTitle">
                                    {{__('messages.use-title-caption')}}
                                </label>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-check">
                                <input class="form-check-input" value="1" type="radio" name="val[type]" id="flexRadioDescription">
                                <label class="form-check-label" for="flexRadioDescription">
                                    {{__('messages.use-description-caption')}}
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="col-md-6">
                            <label class="form-label">{{__('messages.how-many-post-at-time')}}</label>
                            <input type="number" value="5"  name="val[count]" class="form-control"/>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">{{__('messages.check-interval')}}</label>
                            <input type="number" name="val[interval]" value="1" class="form-control"/>
                        </div>
                    </div>

                    <h6 class="mt-4">{{__('messages.choose-a-account')}}</h6>
                    <div class="rss-account-list post-edit-account-list ">
                        @if(count($channels))
                            @foreach($channels as $channel)
                                {!! view('app/channels/popup/display', ['channel' => $channel]) !!}
                            @endforeach
                        @else
                            <div class="empty-result">
                                <img  src="{{url('resources/themes/default/images/empty-result.png')}}"/>
                            </div>
                        @endif
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">{{__('messages.save')}}</button>
                </div>
            </form>
        </div>
    </div>
</div>
