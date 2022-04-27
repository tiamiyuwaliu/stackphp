<div class="content-padding">
    <div class="bio-page-container pr-0" style="padding-right: 0 !important;">
        <div class="content modern-scroll">
            <div class="container">
                <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a data-ajax="true" href="{{url('builder/bio')}}">{{__('messages.bio-link')}}</a></li>
                        <li class="breadcrumb-item"><a data-ajax="true" href="{{url('builder/bio/'.$page->slug)}}">{{$page->title}}</a></li>

                        <li class="breadcrumb-item active" aria-current="page">{{__('messages.reports')}}</li>
                    </ol>
                </nav>
                <div class="d-flex head">
                    <div class="flex-grow-1">
                        <h4>{{__('messages.reports')}}</h4>
                        <p class="text-muted"><i class="bi bi-link-45deg"></i> {{config('link-base-domain', url('/'))}}/{{$page->slug}}</p>
                    </div>
                    <div class="right">
                        <div class="link-report-date-filter">
                            <input type="text" value="{{date('Y-m-d', time() - (60*60*24*30))}} to {{date('Y-m-d')}}" class="form-control date-rande-picker" />
                        </div>
                        <a href="{{url('builder/bio/'.$page->slug)}}" data-ajax="true"><i class="bi bi-pencil"></i></a>
                    </div>
                </div>

                @if($current == 'overview')
                    <div class="row">
                        <div class="col-md-6">
                            <div class="box stat">
                                <i class="bi bi-graph-down-arrow"></i>
                                <div class="info">
                                    <h4>0</h4>
                                    <h6>{{__('messages.page-views')}}</h6>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="box stat">
                                <i class="bi bi-graph-down-arrow"></i>
                                <div class="info">
                                    <h4>0</h4>
                                    <h6>{{__('messages.unique-views')}}</h6>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="box box-padding">

                        <div class="admin-chart-container">
                            <div class="" id="admin-chart"></div>
                        </div>
                    </div>
                    <div class="box box-padding">
                        <div class="d-flex">
                            <h5 class="flex-grow-1">{{__('messages.session-by-country')}}</h5>
                            <a href="{{url('builder/bio/reports/'.$page->slug)}}?page=country" data-ajax="true">{{__('messages.view-all')}}</a>
                        </div>
                        <div id="country-map" style="width: 100%;height: 400px"></div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            {!! view('app/builder/report/referrals', ['page' => $page]) !!}
                        </div>
                        <div class="col-md-6">
                            {!! view('app/builder/report/systems', ['page' => $page]) !!}
                        </div>
                        <div class="col-md-6">
                            {!! view('app/builder/report/browsers', ['page' => $page]) !!}
                        </div>
                        <div class="col-md-6">
                            {!! view('app/builder/report/devices', ['page' => $page]) !!}
                        </div>
                    </div>

                @else
                    {!! view('app/builder/report/'.$current, ['page' => $page]) !!}
                @endif
            </div>
        </div>

    </div>
</div>
