<div class="box box-padding d-flex">
    <div class="left">
        <img src="{{url('resources/themes/default/images/rss.png')}}"/>
    </div>
    <div class="flex-grow-1 middle">
        <a href="{{url('publish/rss/'.$rss->id)}}" data-ajax="true"><h6>{{$rss->title}}</h6></a>
        <p>{{$rss->url}}</p>
    </div>
    <div class=" right">
        <div class="form-check form-switch form-check-lg display-inline">
            <input data-url="{{url('publish/rss')}}" {{$rss->status ? 'checked':null}} onchange="return App.changeStatus(this, '{{$rss->id}}')" class="form-check-input" type="checkbox" id="flexSwitchCheckDefault{{$rss->id}}">
            <label class="form-check-label" for="flexSwitchCheckDefault{{$rss->id}}"></label>
        </div>
        <a href="" data-bs-target="#editFeedModal{{$rss->id}}" data-bs-toggle="modal"><i class="bi bi-gear"></i></a>
    </div>
</div>

<div class="modal fade" id="editFeedModal{{$rss->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">{{__('messages.add-feed')}}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{url('publish/rss')}}" method="post" class="general-form">
                <input type="hidden" name="val[action]" value="edit"/>
                <input type="hidden" name="val[id]" value="{{$rss->id}}"/>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <label class="form-label">{{__('messages.title')}}</label>
                            <input value="{{$rss->title}}" required type="text" name="val[title]" class="form-control"/>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">{{__('messages.feed-url')}}</label>
                            <input value="{{$rss->url}}" required type="text" name="val[url]" class="form-control"/>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-12"><label class="form-label">{{__('messages.what-action-perform')}}</label></div>
                        <div class="col-4">
                            <div class="form-check">
                                <input {{$rss->action == 0? 'checked':null}} class="form-check-input" value="0" checked type="radio" name="val[action_type]" id="flexRadioNoAction">
                                <label class="form-check-label" for="flexRadioNoAction">
                                    {{__('messages.no-action')}}
                                </label>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-check">
                                <input {{$rss->action == 1? 'checked':null}} class="form-check-input" value="1" type="radio" name="val[action_type]" id="flexRadioAutoPost">
                                <label class="form-check-label" for="flexRadioAutoPost">
                                    {{__('messages.auto-post')}}
                                </label>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-check">
                                <input  {{$rss->action == 2? 'checked':null}} class="form-check-input" value="2" type="radio" name="val[action_type]" id="flexRadioAutoSchedule">
                                <label class="form-check-label" for="flexRadioAutoSchedule">
                                    {{__('messages.auto-schedule')}}
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="col-md-6">
                            <label class="form-label">{{__('messages.include-words')}}</label>
                            <input value="{{$rss->include}}" type="text" name="val[include]" class="form-control"/>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">{{__('messages.exclude-words')}}</label>
                            <input  value="{{$rss->exclude}}" type="text" name="val[exclude]" class="form-control"/>
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="col-12"><label class="form-label">{{__('messages.what-content-to-use')}}</label></div>
                        <div class="col-6">
                            <div class="form-check">
                                <input {{$rss->content_type == 0? 'checked':null}} class="form-check-input" value="0" checked type="radio" name="val[type]" id="flexRadioTitle">
                                <label class="form-check-label" for="flexRadioTitle">
                                    {{__('messages.use-title-caption')}}
                                </label>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-check">
                                <input {{$rss->content_type == 1? 'checked':null}} class="form-check-input" value="1" type="radio" name="val[type]" id="flexRadioDescription">
                                <label class="form-check-label" for="flexRadioDescription">
                                    {{__('messages.use-description-caption')}}
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="col-md-6">
                            <label class="form-label">{{__('messages.how-many-post-at-time')}}</label>
                            <input type="number" value="{{$rss->post_count}}"  name="val[count]" class="form-control"/>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">{{__('messages.check-interval')}}</label>
                            <input type="number" name="val[interval]" value="{{$rss->check_interval}}" class="form-control"/>
                        </div>
                    </div>

                    <h6 class="mt-4">{{__('messages.choose-a-account')}}</h6>
                    <div class="rss-account-list post-edit-account-list ">
                        @if(count($channels))
                            @foreach($channels as $channel)
                                {!! view('app/channels/popup/display', ['channel' => $channel, 'accounts' => json_decode($rss->accounts)]) !!}
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
