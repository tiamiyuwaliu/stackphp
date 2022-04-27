<div class="content-padding modern-scroll scroll-inner-right">

    <h3>{{__('messages.have-social-accounts')}}</h3>
    <p>{{__('messages.have-social-accounts-note')}}</p>

    <div class="social-channels-container">
        <div class="row">
            @foreach(\App\Repositories\Channel::repository()->supportedChannels() as $channel)
                @if(config($channel.'-channel', false))
                    <?php $count = \App\Repositories\Channel::repository()->hasChannels($channel)?>
                    @if($count)
                        <div class="col-lg-3 col-md-4  ">
                            <a class="each each-large {{$channel}}-bg"  href="{{url('channel/'.$channel)}}" data-ajax="true">
                                <div class="clearfix d-flex flex-row ">
                                    <div class="flex-grow-1">
                                        <h6>
                                            @if($channel == 'tumblr')
                                                <img src="{{url('resources/themes/default/images/tumblr.png')}}"/>
                                            @else
                                                <i class="bi bi-{{$channel}}"></i>
                                            @endif
                                            {{ucwords($channel)}}</h6>
                                    </div>
                                    <div class="">
                                        <i class="bi bi-person"></i> <span>{{$count}}</span>
                                    </div>
                                </div>

                                <div class="d-flex flex-row foot">
                                    <?php $account = \App\Repositories\Channel::repository()->getLastChannel($channel)?>
                                    <div class=" flex-grow-1">
                                        <div class="account">
                                            <div class="avatar" style="background-image: url({{url($account->avatar)}})"></div>
                                            <div class="info">
                                                <h6 class="text-ellipsis width-100px">{{$account->username}}</h6>
                                                <p><i class="bi bi-circle-fill"></i> {{__('messages.connected')}}</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="float-end">
                                        <i class="bi bi-gear"></i>
                                    </div>
                                </div>

                            </a>
                        </div>
                    @else
                        <div class="col-lg-2 col-md-3">
                            <a href="{{url('channel/'.$channel)}}" data-ajax="true" class="each each-small {{$channel}}-bg" >
                                <div class="icon">
                                    @if($channel == 'tumblr')
                                        <img  src="{{url('resources/themes/default/images/tumblr.png')}}"/>
                                    @else
                                        <i class="bi bi-{{$channel}}"></i>
                                    @endif
                                </div>
                                <h5>{{ucwords($channel)}}</h5>
                                <div class="form-check form-switch">
                                    <input disabled class="form-check-input" type="checkbox" id="flexSwitchCheckDefault{{$channel}}">
                                    <label class="form-check-label" for="flexSwitchCheckDefault{{$channel}}"></label>
                                </div>
                            </a>
                        </div>
                    @endif
                    @endif
                @endforeach
        </div>
    </div>
</div>
