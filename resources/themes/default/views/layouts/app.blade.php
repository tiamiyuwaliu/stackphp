<div class="left-pane">
        <div class="logo-container">
            <a href=""><img src="{{url(config('site_logo', 'resources/themes/default/images/logo.png'))}}"/> </a>
        </div>

        <div class="menu-container modern-scroll">
            <h6>{{__('messages.publish')}}</h6>
            <ul>
                <li><a href="{{url('publish')}}" data-ajax="true" class="{{($active_menu == 'publish') ? 'active':null}}"><span></span><i class="bi bi-calendar3"></i> {{__('messages.scheduling')}}</a> </li>
                <li><a href="{{url('publish/bulk')}}" data-ajax="true" class="{{($active_menu == 'bulk') ? 'active':null}}"><span></span><i class="bi bi-box-seam"></i>{{__('messages.bulk-upload')}}</a> </li>
                <li><a href="{{url('media')}}" data-ajax="true" class="{{($active_menu == 'media') ? 'active':null}}"><span></span><i class="bi bi-images"></i> {{__('messages.media-manager')}}</a> </li>
                <li><a href="{{url('templates')}}" data-ajax="true" class="{{($active_menu == 'templates') ? 'active':null}}"><span></span><i class="bi bi-columns-gap"></i> {{__('messages.templates')}}</a> </li>
                <li><a href="{{url('publish/rss')}}" data-ajax="true" class="{{($active_menu == 'rss') ? 'active':null}}"><span></span><i class="bi bi-rss"></i> {{__('messages.rss-feed')}}</a> </li>
            </ul>

            <h6>{{__('messages.builder')}}</h6>
            <ul>
                <li><a href="{{url('builder/bio')}}" data-ajax="true" class="{{($active_menu == 'bio') ? 'active':null}}"><span></span><i class="bi bi-link-45deg"></i> {{__('messages.bio-link')}}</a> </li>
                <li><a href="{{url('builder/link')}}" data-ajax="true" class="{{($active_menu == 'short') ? 'active':null}}"><span></span><i class="bi bi-box-arrow-up-right"></i> {{__('messages.short-link')}}</a> </li>
                <li><a href="{{url('builder/vcard')}}" data-ajax="true" class="{{($active_menu == 'vcard') ? 'active':null}}"><span></span><i class="bi bi-card-heading"></i> {{__('messages.vcard-generator')}}</a> </li>
                <li><a href="{{url('builder/qrcode')}}" data-ajax="true" class="{{($active_menu == 'qrcode') ? 'active':null}}"><span></span><i class="bi bi-qr-code-scan"></i> {{__('messages.qrcode-generator')}}</a> </li>

            </ul>


            <h6>{{__('messages.others')}}</h6>
            <ul>
                <li><a href="{{url('channels')}}" data-ajax="true" class="{{($active_menu == 'channels') ? 'active':null}}"><span></span><i class="bi bi-people"></i> {{__('messages.social-channels')}}</a> </li>
                <!--<li><a href="{{url('report')}}" data-ajax="true" class="{{($active_menu == 'reports') ? 'active':null}}"><span></span><i class="bi bi-bar-chart"></i> {{__('messages.reports')}}</a> </li>-->
                <li><a href="{{url('cp')}}" ><span></span><i class="bi bi-palette"></i> {{__('messages.admin-panel')}}</a> </li>
            </ul>
        </div>

        <div class="help-btn-container">
            <a href="" class="help-btn"><i class="bi bi-chat-fill"></i> {{__('messages.help-center')}}</a>
        </div>
</div>
<div class="right-pane">
    <div class="header clearfix">
        <div class="float-start">
            <a href="" class="menu-toggle"><i class="bi bi-text-right"></i></a>
            <div class="social-channels-buttons clearfix">
                @foreach(['facebook','twitter','instagram','reddit', 'linkedin','tiktok'] as $channel)
                    @if(config($channel.'-channel', false))
                        <?php $count = \App\Repositories\Channel::repository()->hasChannels($channel)?>
                            <a data-ajax="true" href="{{url('channel/'.$channel)}}">
                                <i class="plus bi bi-plus"></i>
                                @if($count)
                                    <?php $account = \App\Repositories\Channel::repository()->getLastChannel($channel)?>
                                    <div class="avatar" style="background-image:url({{url($account->avatar)}})"></div>
                                @endif
                                <i class="social bi bi-{{$channel}} {{$channel}}-bg"></i>
                            </a>

                    @endif
                @endforeach
                <a href="{{url('channels')}}" data-ajax="true">
                    <i class="plus bi bi-plus"></i>
                </a>

            </div>
        </div>
        <div class="float-end">
            <ul class="clearfix">
                <li>
                    <a href="" data-bs-target="#composeModal" data-bs-toggle="modal" class="btn btn-primary"><i class="bi bi-plus"></i> {{__('messages.compose')}}</a>
                </li>
                <li><a href="" class="icon-link" ><i class="bi bi-brightness-low"></i></a> </li>
                <li><a href="" class="icon-link" ><i class="bi bi-globe"></i></a> </li>
                <li class="dropdown">
                    <a data-bs-toggle="dropdown" class="img-link" href=""><img src="{{\App\Repositories\User::repository()->getAvatar()}}"/> </a>
                    <div class="dropdown-menu shadow mt-2">
                        <a href="{{url('account')}}" data-ajax="true" class="dropdown-item">{{__('messages.account-settings')}}</a>
                        <a href="{{url('logout')}}" class="dropdown-item">{{__('messages.logout')}}</a>
                    </div>
                </li>
            </ul>
        </div>

    </div>

    {!! $content !!}
</div>


<div class="modal fade post-modal" id="composeModal" data-bs-backdrop="static">
    <div class="modal-dialog modal-dialog-centered ">
        <div class="modal-content composer-container">
            <a href="" class="close-btn" onclick="return App.closePostEditor()"><i class="bi bi-x-lg"></i></a>
            <div class="compose-content each-pane" >
                <form action="{{url('publish')}}" method="post" id="postEditorForm" class="general-form">
                    <input type="hidden" name="val[action]" value="post"/>
                    <div class="modal-body">
                        <div class="box box-padding account-lists">
                            <a href="" onclick="return App.togglePostEditorPane('.account-picker')" class="add"><i class="bi bi-person-plus"></i></a>
                            <div class="selected-accounts clearfix">

                            </div>
                        </div>
                        <div class="box box-padding p-1">
                            <textarea placeholder="{{__('messages.write-a-caption')}}" name="val[caption]" data-counter="#post-editor-counter" id="post-editor-textarea" class="emoji-text post-editor-textarea"></textarea>
                        </div>

                        <div class="box post-media-list clearfix"></div>
                        <input type="hidden" name="val[post_type]" value="1" class="post-type-input"/>
                        <div class="box box-padding p-1 schedule-date-selector">
                            <div class="form-floating">
                                <input type="text" name="val[time]" id="scheduleDate" class="form-control date-time-picker" placeholder="{{__('messages.choose-a-custom-date')}}"/>
                                <label for="scheduleDate">{{__('messages.choose-a-custom-date')}}</label>
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer clearfix">
                        <div class="float-start">
                            <ul class="clearfix">
                                <li><a href="" data-bs-toggle="tooltip" data-bs-placement="top" title="{{__('messages.upload')}}"><i class="bi bi-camera"></i></a> </li>
                                <li><a href="" onclick="return App.postOpenMediaPicker()" data-bs-toggle="tooltip" data-bs-placement="top" title="{{__('messages.media-library')}}"><i class="bi bi-images"></i></a> </li>
                                <li><a data-bs-toggle="tooltip" data-bs-placement="top" title="{{__('messages.caption-picker')}}" onclick="return App.openTemplatePicker('caption')" href=""><i class="bi bi-layers"></i></a> </li>
                                <li><a data-bs-toggle="tooltip" data-bs-placement="top" title="{{__('messages.hashtag-picker')}}" onclick="return App.openTemplatePicker('hashtag')" href=""><i class="bi bi-hash"></i></a> </li>
                            </ul>
                        </div>
                        <div class="float-end">
                            <span id="post-editor-counter" class="counter">0</span>
                            <button type="button" data-bs-toggle="tooltip" data-bs-placement="top" title="{{__('messages.preview')}}" class="btn btn-dark btn-sm"><i class="bi bi-eye"></i></button>
                            <div class="btn-group dropup">
                                <button type="button" onclick="return App.validatePostSubmit()" class="btn btn-primary btn-sm post-submit-btn">{{__('messages.post-now')}}</button>
                                <button type="button" class="btn btn-primary btn-sm dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown" aria-expanded="false">
                                    <span class="visually-hidden"></span>
                                </button>
                                <div class="dropdown-menu dropdown-menu-end">
                                    <a onclick="return App.switchPostEditButton('1', '{{__('messages.post-now')}}')" class="dropdown-item" href="#">{{__('messages.post-now')}}</a>
                                    <a onclick="return App.switchPostEditButton('0', '{{__('messages.schedule-now')}}')" class="dropdown-item" href="#">{{__('messages.post-at-custom-time')}}</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="account-picker each-pane">
                <div class="modal-header">
                    <div class="form-group" style="width: 100%">
                        <input onkeyup="App.searchChannels(this, '.post-edit-account-list')" type="text" class="form-control" placeholder="{{__('messages.search-profiles')}}"/>
                    </div>
                </div>
                <div class="modal-body">
                    <div class="post-edit-account-list modern-scroll">
                        @foreach(\App\Repositories\Channel::repository()->getChannels() as $channel)
                            {!! view('app/channels/popup/display', ['channel' => $channel]) !!}
                        @endforeach
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" onclick="App.postAddSelectedAccounts()" class="btn btn-primary"><i class="bi bi-check2"></i></button>
                </div>
            </div>
            <div class="templates-picker-container each-pane">
                <div class="modal-header">
                    <div class="form-group" style="width: 100%">
                        <input onkeyup="App.searchTemplates(this)" type="text" class="form-control" placeholder="{{__('messages.search-templates')}}"/>
                    </div>
                </div>
                <div class="modal-body modern-scroll">

                </div>
            </div>
            <div class="media-library each-pane">
                <div class="modal-header">
                    <h6>{{__('messages.pick-media-library')}}</h6>
                </div>
                <div class="modal-body modern-scroll">

                </div>
                <div class="modal-footer">
                    <button type="button" onclick="App.postAddSelectedMedia()" class="btn btn-primary"><i class="bi bi-check2"></i></button>
                </div>
            </div>
        </div>
    </div>
</div>
