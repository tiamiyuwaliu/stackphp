<?php
$new = (isset($new)) ? $new : false;
$settings = [];
$widgetId = 0;
if (isset($widget))  {
    $settings = perfectUnserialize($widget->settings);
    $widgetId = $widget->id;
}
?>
<form action="{{app('request')->fullUrl()}}" method="post" class="general-form">
    <input type="hidden" name="val[action]" value="save-widget"/>
    <input type="hidden" name="val[widget_id]" value="{{$widgetId}}"/>
    <input type="hidden" name="val[widget_type]" value="map"/>
    <input type="hidden" name="val[widget_icon]" value="bi bi-geo-alt"/>

    <div class="mt-2">
        <label class="form-label">{{__('messages.map-address')}}</label>
        <input type="text" class="form-control" value="{{$settings  ? $settings['address'] : ''}}" name="val[address]"/>
    </div>
    <div class="mt-2">
        <label class="form-label">{{__('messages.map-color')}}</label>
        <input type="text" id="map-color{{$widgetId}}" data-target="#map-color{{$widgetId}}-value"  class="color-input"/>
        <input type="hidden" id="map-color{{$widgetId}}-value" value="{{$settings ? $settings['color'] : '#EFEFEF'}}"  name="val[color]" class=""/>
    </div>

    <div class="form-check form-switch form-check-lg mt-3">
        <?php $time = time();?>
        <input type="hidden" name="val[zoom]" value="0"/>
        <input class="form-check-input" {{($settings and isset($settings['zoom']) and $settings['zoom']) ? 'checked' : null}} name="val[zoom]" value="1" type="checkbox" id="flexSwitchCheckDefaultMapZoom{{$time}}">
        <label class="form-check-label pl-3" for="flexSwitchCheckDefaultMapZoom{{$time}}">{{__('messages.zoom-icons')}}</label>
    </div>

    <div class="form-check form-switch form-check-lg mt-3">
        <?php $time = time();?>
        <input type="hidden" name="val[button]" value="0"/>
        <input class="form-check-input" {{($settings and isset($settings['button']) and $settings['button']) ? 'checked' : null}} name="val[button]" value="1" type="checkbox" id="flexSwitchCheckDefaultMapButton{{$time}}">
        <label class="form-check-label pl-3" for="flexSwitchCheckDefaultMapButton{{$time}}">{{__('messages.address-button')}}</label>
    </div>
    <div class="mt-4 ">
        <button class="btn  btn-primary ">{{$new ? __('messages.add-widget') : __('messages.save-widget')}}</button>
        @if($widgetId)
            <button class="btn btn-secondary " onclick="return App.closeEditorWidget({{$widgetId}})">{{__('messages.close')}}</button>
        @endif
    </div>
</form>
