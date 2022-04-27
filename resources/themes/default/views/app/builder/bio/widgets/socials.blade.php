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
    <input type="hidden" name="val[widget_type]" value="socials"/>
    <input type="hidden" name="val[widget_icon]" value="bi bi-people"/>

    <div class="mt-2">
        <label class="form-label">{{__('messages.text-color')}}</label>
        <input type="text" id="social-text-color{{$widgetId}}" data-target="#social-text-color{{$widgetId}}-value"  class="color-input"/>
        <input type="hidden" id="social-text-color{{$widgetId}}-value" value="{{$settings  ? $settings['color'] : '#EFEFEF'}}"  name="val[color]" class=""/>
    </div>

    @foreach(\App\Repositories\Builder::repository()->getSocialWidgets() as $social)
        <div class="mt-2">
            <label class="form-label">{{__('messages.'.$social)}}</label>
            <input type="text" class="form-control" value="{{$settings  ? $settings[$social] : ''}}" name="val[{{$social}}]"/>
        </div>
    @endforeach

    <div class="mt-4 ">
        <button class="btn  btn-primary ">{{$new ? __('messages.add-widget') : __('messages.save-widget')}}</button>
        @if($widgetId)
            <button class="btn btn-secondary " onclick="return App.closeEditorWidget({{$widgetId}})">{{__('messages.close')}}</button>
        @endif
    </div>
</form>
