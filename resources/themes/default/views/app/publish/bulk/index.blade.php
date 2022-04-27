<div class="content-padding scroll-inner-right modern-scroll">
    <div class="container">
        <div class="box box-padding">
            <h6>{{__('messages.bulk-upload')}}</h6>
        </div>

        <div class="box bulk-upload-container">
            <ul class="nav nav-pills nav-fill">
                <li class="nav-item">
                    <a class="nav-link active upload-nav" aria-current="page" href="#" onclick="return false">{{__('messages.upload')}}</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link account-nav" href="#" onclick="return false">{{__('messages.choose-accounts')}}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link finish-nav" href="#" onclick="return false">{{__('messages.finish')}}</a>
                </li>
            </ul>

            <div class="box-padding">
                <div class="upload-pane bulk-pane">
                    <div class="head">
                        <i class="bi bi-cloud-upload"></i>
                        <h5>{{__('messages.click-button-upload-csv')}}</h5>
                        <a href="" class="btn btn-primary btn-lg upload-btn">

                            <form method="post"   action="<?php echo url('publish/bulk')?>" enctype="multipart/form-data" class="general-form bulk-uploader">
                                <input type="hidden" name="val[action]" value="upload"/>
                                <input onchange="App.submitBulkUpload()" type="file" name="file" class="upload-computer-input">
                                {{__('messages.browse')}}
                            </form>
                        </a>
                    </div>

                    <div class="format-container">
                        <p><i class="bi bi-check-all"></i> {{__('messages.bulk-format-note')}} <a href="{{url('sample.csv')}}" name="sample.csv" download="{{url('sample.csv')}}">{{__('messages.download-sample')}}</a> </p>
                        <div class="d-flex justify-content-evenly">
                            <div class="">This is a sample post description</div>
                            <div>https://publicimageurl.xyz</div>
                            <div>2018-11-08 10:00</div>
                            <div>6069822</div>
                        </div>
                    </div>
                </div>
                <div class="account-pane bulk-pane">
                    <h6>{{__('messages.choose-a-account')}}</h6>
                    <p>{{__('messages.choose-a-account-note')}}</p>
                    <form action="{{url('publish/bulk')}}" method="post" class="general-form">
                        <input type="hidden" name="val[action]" value="complete"/>
                        <div class="account-list post-edit-account-list modern-scroll">
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
                        <hr/>
                        <button type="button" onclick="return App.switchBulkPane('upload')" class="btn btn-secondary">{{__('messages.go-back')}}</button>
                        <button type="submit" class="btn btn-primary">{{__('messages.schedule-now')}}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
