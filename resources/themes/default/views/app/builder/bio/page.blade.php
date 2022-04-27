<div class="content-padding" style="border-top: solid 1px #DBDFE1">
    <div class="bio-page-container ">

        <div class="content modern-scroll">
            <div class="container">
                <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a data-ajax="true" href="{{url('channels')}}">{{__('messages.bio-link')}}</a></li>
                        <li class="breadcrumb-item active" aria-current="page">{{$page->title}}</li>
                    </ol>
                </nav>
                <div class="d-flex head">
                    <div class="flex-grow-1">
                        <h4>{{$page->title}}</h4>
                        <p class="text-muted"><i class="bi bi-link-45deg"></i> {{config('link-base-domain', url('/'))}}/{{$page->slug}}</p>
                    </div>
                    <div class="right">
                        <div class="form-check form-switch form-check-lg display-inline">
                            <input data-url="{{url('builder/bio')}}" {{$page->status ? 'checked':null}} onchange="return App.changeStatus(this, '{{$page->id}}')" class="form-check-input" type="checkbox" id="flexSwitchCheckDefault{{$page->id}}">
                            <label class="form-check-label" for="flexSwitchCheckDefault{{$page->id}}"></label>
                        </div>
                        <a href="{{url('builder/bio/reports/'.$page->slug)}}" data-ajax="true"><i class="bi bi-bar-chart-line"></i></a>
                        <div class="display-inline">
                            <a href="" data-bs-toggle="dropdown" ><i class="bi bi-three-dots-vertical"></i></a>
                            <div class="dropdown-menu dropdown-menu-end">
                                <a href="" class="dropdown-item">{{__('messages.edit')}}</a>
                                <a href="" class="dropdown-item">{{__('messages.delete')}}</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="box box-padding d-flex">
                    <ul id="bio-navs" class="nav  nav-pills flex-grow-1">
                        <li class="nav-item">
                            <a data-bs-toggle="tab" onclick="App.resizeScroll()" data-bs-target="#styling" class="nav-link active " aria-current="page" href="#">{{__('messages.styling')}}</a>
                        </li>
                        <li class="nav-item">
                            <a data-bs-toggle="tab" onclick="App.resizeScroll()" data-bs-target="#widgets" class="nav-link " href="#">{{__('messages.widgets')}}</a>
                        </li>
                        <li class="nav-item">
                            <a data-bs-toggle="tab" onclick="App.resizeScroll()" data-bs-target="#settings" class="nav-link" href="#">{{__('messages.settings')}}</a>
                        </li>
                    </ul>
                    <div>
                        <a href="" data-bs-toggle="offcanvas" data-bs-target="#addWidgetModal" class="btn btn-dark ">{{__('messages.add-widget')}}</a>
                    </div>
                </div>

                <?php
                    $settings = ($page->settings) ? perfectUnserialize($page->settings) : [];
                    $backgroundType = isset($settings['background-type']) ? $settings['background-type'] : 'gradient';
                ?>
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="styling" role="tabpanel" aria-labelledby="home-tab">
                        <form enctype="multipart/form-data" class="general-form form-auto-submit" id="bio-settings-form" data-no-loader="true" action="{{app('request')->fullUrl()}}" method="post">
                            <input type="hidden" name="val[action]" value="save-settings"/>
                            <div class="box box-padding">
                                <h5>{{__('messages.background')}}</h5>
                                <div class="row">
                                    <div class="col-md-6">
                                        <label class="form-label">{{__('messages.type')}}</label>
                                        <select name="val[background-type]" onchange="App.switchPane(this,'.background-pane-container', '.background-pane')" class="form-select">
                                            <option {{(isset($settings['background-type']) and $settings['background-type'] == 'gradient') ? 'selected' : null}}  value="gradient">{{__('messages.defined-gradients')}}</option>
                                            <option  {{(isset($settings['background-type']) and $settings['background-type'] == 'custom-gradient') ? 'selected' : null}} value="custom-gradient">{{__('messages.custom-gradient')}}</option>
                                            <option  {{(isset($settings['background-type']) and $settings['background-type'] == 'solid') ? 'selected' : null}} value="solid">{{__('messages.solid-color')}}</option>
                                            <option  {{(isset($settings['background-type']) and $settings['background-type'] == 'custom-image') ? 'selected' : null}} value="custom-image">{{__('messages.custom-image')}}</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="background-pane-container">
                                    <div class="background-pane gradient-pane {{$backgroundType == 'gradient' ? 'show' : null}}">
                                        <div class="row">
                                            @foreach(\App\Repositories\Builder::repository()->availableGradients() as $key => $gradient)
                                                <div class="col-sm-2">
                                                    <a href="" onclick="return App.activateCheckInput(this, '.gradient-pane', '#bio-settings-form')"
                                                       class="each  {{(isset($settings['defined-gradient']) and $settings['defined-gradient'] == $key) ? 'active' : null}}"
                                                       style="background: {{$gradient}}">
                                                        <span class="hide"><input type="radio" {{(isset($settings['defined-gradient']) and $settings['defined-gradient'] == $key) ? 'checked' : null}} name="val[defined-gradient]" value="{{$key}}"/></span>
                                                    </a>
                                                </div>
                                            @endforeach

                                        </div>
                                    </div>
                                    <div class="background-pane solid-pane {{$backgroundType == 'solid' ? 'show' : null}}">
                                        <h6>{{__('messages.background-color')}}</h6>
                                        <input type="text" id="solid-bg-color" data-target="#solid-bg-color-value"  class="color-input"/>
                                        <input type="hidden" id="solid-bg-color-value" value="{{(isset($settings['solid-color'])) ? $settings['solid-color'] : '#C813A2'}}" data-form="#bio-settings-form" name="val[solid-color]" class=""/>
                                    </div>
                                    <div class="background-pane custom-gradient-pane {{$backgroundType == 'custom-gradient' ? 'show' : null}}">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="clearfix">
                                                    <div class="float-start">
                                                        <h6>{{__('messages.color')}}  1</h6>

                                                        <input type="text" id="custom-gradient-color-1" data-target="#custom-gradient-color-value"  class="color-input"/>
                                                        <input type="hidden" id="custom-gradient-color-value" value="{{(isset($settings['gradient-color1'])) ? $settings['gradient-color1'] : '#C813A2'}}" data-form="#bio-settings-form" name="val[gradient-color1]" class=""/>
                                                    </div>
                                                    <div class="float-end">
                                                        <h6>{{__('messages.color')}} 2</h6>
                                                        <input type="text" id="custom-gradient-color-2" data-target="#custom-gradient-color-2-value"  class="color-input"/>
                                                        <input type="hidden" id="custom-gradient-color-2-value" value="{{(isset($settings['gradient-color2'])) ? $settings['gradient-color2'] : '#C813A2'}}" data-form="#bio-settings-form" name="val[gradient-color2]" class=""/>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="background-pane custom-image-pane {{$backgroundType == 'custom-image' ? 'show' : null}}">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div>
                                                    @if(isset($settings['background-image']) and $settings['background-image'])
                                                        <div class="background-image" style="background-image:url({{url($settings['background-image'])}})"></div>
                                                        @endif
                                                    <label for="formFileLg" class="form-label">{{__('messages.choose-image-file')}}</label>
                                                    <input class="form-control form-control-lg" name="file[background-image]" id="formFileLg" type="file">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="box box-padding">
                                <h5>{{__('messages.font')}}</h5>

                                <div class="row fonts-list-container">
                                    @foreach(\App\Repositories\Builder::repository()->availableFonts() as $font)
                                        <div class="col-md-3">
                                            <a href="" onclick="return App.activateCheckInput(this, '.fonts-list-container', '#bio-settings-form')"
                                               class="each {{(isset($settings['font']) and $settings['font'] == $font) ? 'active' : null}}"
                                               style="font-family: {{$font}}">
                                                ABC

                                                <span>{{$font}}</span>
                                                <span class="hide"><input {{(isset($settings['font']) and $settings['font'] == $font) ? 'checked' : null}} type="radio" name="val[font]" value="{{$font}}"/></span>
                                            </a>
                                        </div>
                                    @endforeach
                                </div>

                                <div class="mt-3 row">
                                    <div class="col-md-6">
                                        <label class="form-label">{{__('messages.font-size')}}</label>
                                        <div class="input-group mb-3">
                                            <input name="val[font-size]" value="{{(isset($settings['font-size'])) ? $settings['font-size'] : 12}}" type="number" class="form-control"  >
                                            <span class="input-group-text" id="basic-addon1">px</span>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">{{__('messages.text-saturation')}}</label>
                                        <select name="val[text-saturation]" class="form-select">
                                            <option {{(isset($settings['text-saturation']) and $settings['text-saturation'] == 'light') ? 'selected' : null}}  value="light">{{__('messages.light')}}</option>
                                            <option {{(isset($settings['text-saturation']) and $settings['text-saturation'] == 'regular') ? 'selected' : null}}  value="regular">{{__('messages.regular')}}</option>
                                            <option  {{(isset($settings['text-saturation']) and $settings['text-saturation'] == 'medium') ? 'selected' : null}} value="medium">{{__('messages.medium')}}</option>
                                            <option {{(isset($settings['text-saturation']) and $settings['text-saturation'] == 'bold') ? 'selected' : null}} value="bold">{{__('messages.bold')}}</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </form>

                    </div>
                    <div class="tab-pane fade " id="widgets" role="tabpanel" aria-labelledby="profile-tab">
                        <div class="bio-widgets-container" data-url="{{app('request')->fullUrl()}}" data-id="{{$page->id}}">
                            @foreach(\App\Repositories\Builder::repository()->getWidgets($page->id) as $widget)
                                <div class="each-widget box each-widget-{{$widget->id}}">
                                    <input type="hidden" class="widget-input" value="{{$widget->id}}"/>
                                    <div class="box-padding d-flex">
                                        <div class="move">
                                            <i class="bi bi-justify"></i>
                                        </div>
                                        <div class="icon" style="background:{{\App\Repositories\Builder::repository()->getWidgetColor($widget->block_title)}}">
                                            <i class="{{$widget->block_icon}}"></i>
                                        </div>
                                        <div class="info flex-grow-1">
                                            <h6>{{__('messages.'.$widget->block_title)}}</h6>
                                        </div>
                                        <div class="actions">
                                            <a href="" onclick="return App.openWidgetEditor({{$widget->id}})"><i class="bi bi-pencil"></i></a>
                                            <a href="{{app('request')->fullUrl()}}?action=duplicate&id={{$widget->id}}" class="confirm" data-ajax-action="true"><i class="bi bi-files"></i></a>
                                            <a href="{{app('request')->fullUrl()}}?action=delete-widget&id={{$widget->id}}" class="confirm" data-ajax-action="true"><i class="bi bi-trash"></i></a>
                                        </div>
                                    </div>
                                    <div class="edit-container">
                                        {!! view('app/builder/bio/widgets/'.$widget->block_title, ['widgetId' => $widget->id, 'widget' => $widget]) !!}
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="tab-pane fade" id="settings" role="tabpanel" aria-labelledby="contact-tab">

                        <form enctype="multipart/form-data" class="general-form form-auto-submit" id="bio-settings-page-form" data-no-loader="true" action="{{app('request')->fullUrl()}}" method="post">
                            <input type="hidden" name="val[action]" value="save-settings"/>
                            <div class="box box-padding">
                                <label for="basic-url" class="form-label">{{__('messages.biolink-url')}}</label>
                                <div class="input-group mb-2">
                                    <span class="input-group-text" >{{config('link-base-domain', url('/'))}}/</span>
                                    <input type="text" class="form-control" name="val[slug]" value="{{$page->slug}}" placeholder="slug-here" >
                                </div>
                                <small class="text-muted">{{__('messages.leave-empty-generate-one')}}</small>
                            </div>

                            <div class="box box-padding">
                                <h6>{{__('messages.branding')}}</h6>
                                <div class="clearfix mt-3 mb-3">
                                    <div class="float-start">
                                        <h6>{{__('messages.display-branding')}}</h6>

                                    </div>
                                    <div class="float-end">
                                        <div class="form-check form-switch form-check-lg">
                                            <input type="hidden" name="val[display-branding]" value="0"/>
                                            <input name="val[display-branding]" {{(isset($settings['display-branding']) and $settings['display-branding']) ? 'checked' : null}} class="form-check-input " type="checkbox" id="flexSwitchCheckCheckedBranding" >
                                            <label class="form-check-label" for="flexSwitchCheckCheckedBranding"></label>
                                        </div>
                                    </div>
                                </div>

                                <div class="mt-3">
                                    <label class="form-label">{{__('messages.branding-name')}}</label>
                                    <input type="text" class="form-control" name="val[branding-name]" value="{{(isset($settings['branding-name'])) ? $settings['branding-name'] : ''}}"/>
                                </div>

                                <div class="mt-3">
                                    <label class="form-label">{{__('messages.branding-url')}}</label>
                                    <input type="text" class="form-control" name="val[branding-url]" value="{{(isset($settings['branding-url'])) ? $settings['branding-url'] : ''}}"/>
                                </div>

                                <div class="mt-3">
                                    <h6>{{__('messages.branding-color')}}</h6>
                                    <input type="text" id="branding-color" data-target="#branding-color-value"  class="color-input"/>
                                    <input type="hidden" id="branding-color-value" value="{{(isset($settings['branding-color'])) ? $settings['branding-color'] : '#C813A2'}}" data-form="#bio-settings-page-form" name="val[branding-color]" class=""/>

                                </div>
                            </div>

                            <div class="box box-padding">
                                <h6>{{__('messages.pixels')}}</h6>
                                <div class="row mt-2">
                                    <div class="col-md-3">
                                        <label class="form-label">{{__('messages.facebook-pixel')}}</label>
                                        <input type="text" class="form-control" name="val[facebook-pixel]" placeholder="{{__('messages.pixel-id')}}" value="{{(isset($settings['facebook-pixel'])) ? $settings['facebook-pixel'] : ''}}"/>
                                    </div>
                                    <div class="col-md-3">
                                        <label class="form-label">{{__('messages.google-analytics-pixel')}}</label>
                                        <input type="text" class="form-control" name="val[google-analytics-pixel]" placeholder="{{__('messages.pixel-id')}}" value="{{(isset($settings['google-analytics-pixel'])) ? $settings['google-analytics-pixel'] : ''}}"/>
                                    </div>
                                    <div class="col-md-3">
                                        <label class="form-label">{{__('messages.google-tag-manager')}}</label>
                                        <input type="text" class="form-control" name="val[google-tag-manager-pixel]" placeholder="{{__('messages.pixel-id')}}" value="{{(isset($settings['google-tag-manager-pixel'])) ? $settings['google-tag-manager-pixel'] : ''}}"/>
                                    </div>
                                    <div class="col-md-3">
                                        <label class="form-label">{{__('messages.twitter')}}</label>
                                        <input type="text" class="form-control" name="val[twitter-pixel]" placeholder="{{__('messages.pixel-id')}}" value="{{(isset($settings['twitter-pixel'])) ? $settings['twitter-pixel'] : ''}}"/>
                                    </div>
                                </div>
                            </div>

                            <div class="box box-padding" >
                                <h6>{{__('messages.seo')}}</h6>

                                <div class="clearfix mt-3 mb-3">
                                    <div class="float-start">
                                        <h6>{{__('messages.block-search-engine-indexing')}}</h6>
                                        <small>{{__('messages.block-search-engine-indexing-note')}}</small>
                                    </div>
                                    <div class="float-end">
                                        <div class="form-check form-switch form-check-lg">
                                            <input type="hidden" name="val[block-searching]" value="0"/>
                                            <input name="val[block-searching]" {{isset($settings['block-searching']) and $settings['block-searching'] ? 'checked' : null}} class="form-check-input " type="checkbox" id="flexSwitchCheckCheckedblock-searching" >
                                            <label class="form-check-label" for="flexSwitchCheckCheckedblock-searching"></label>
                                        </div>
                                    </div>
                                </div>

                                <div class="mt-3">
                                    <label class="form-label">{{__('messages.page-title')}}</label>
                                    <input type="text" class="form-control" name="val[page-title]"  value="{{(isset($settings['page-title'])) ? $settings['page-title'] : ''}}"/>
                                </div>
                                <div class="mt-3">
                                    <label class="form-label">{{__('messages.page-description')}}</label>
                                    <input type="text" class="form-control" name="val[page-description]"  value="{{(isset($settings['page-description'])) ? $settings['page-description'] : ''}}"/>
                                </div>

                            </div>

                        </form>

                </div>
            </div>
            </div>
        </div>
        <div class="preview-container">
            <div class="preview">
                <iframe id="preview-iframe" src="{{url('/'.$page->slug)}}"></iframe>
            </div>
        </div>
    </div>
</div>

<div class="offcanvas offcanvas-end"  id="addWidgetModal" aria-labelledby="offcanvasTopLabel">
    <div class="pane main-pane">
        <div class="offcanvas-header">
            <h5 id="offcanvasTopLabel">{{__('messages.choose-widget')}}</h5>
            <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body modern-scroll">
            <div class="list-group widgets-list">
                @foreach(\App\Repositories\Builder::repository()->getAvailableWidgets() as $key=>$widget)
                    <a onclick="return App.switchPaneByLink('{{$key}}','#addWidgetModal', '.pane')" href="" class="list-group-item list-group-item-action">
                        <div class="d-flex w-100  justify-content-between">
                            <div>
                                <i style="background:{{$widget['color']}}" class="{{$widget['icon']}}"></i>
                            </div>
                            <div class="flex-grow-1">
                                <h6 class="mb-0">{{__('messages.'.$widget['title'])}}</h6>
                                <small>{{__('messages.'.$widget['desc'])}}</small>
                            </div>
                        </div>
                    </a>
                @endforeach

            </div>
        </div>
    </div>
    @foreach(\App\Repositories\Builder::repository()->getAvailableWidgets() as $key=>$widget)
        <div class="pane {{$key}}-pane">
            <div class="offcanvas-header">
                <h5 id="offcanvasTopLabel"><a class="btn btn-secondary btn-sm" onclick="return App.switchPaneByLink('main','#addWidgetModal', '.pane')" href=""><i class="bi bi-arrow-left"></i></a> {{__('messages.'.$widget['title'])}}</h5>
                <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
            <div class="offcanvas-body modern-scroll">
                {!! view('app/builder/bio/widgets/'.$key, ['linkId' => $page->id, 'new' => true]) !!}
            </div>
        </div>
    @endforeach
</div>
