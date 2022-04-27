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
    <input type="hidden" name="val[widget_type]" value="image"/>
    <input type="hidden" name="val[widget_icon]" value="bi bi-image"/>


    <div>
        @if($settings)
            <input type="hidden" name="val[image]" value="{{$settings['image']}}"/>
            <div class="avatar" style="background-image:url({{url($settings['image'])}})"></div>
        @endif
        <label for="formFileLg" class="form-label">{{__('messages.choose-image-file')}}</label>
        <input class="form-control form-control-lg" name="file[image]" id="formFileLg" type="file">
    </div>

    <div class="mt-2">
        <label class="form-label">{{__('messages.image-alt')}}</label>
        <input type="text" class="form-control" value="{{$settings  ? $settings['alt'] : ''}}" name="val[alt]"/>
    </div>

    <div class="mt-2">
        <label class="form-label">{{__('messages.destination-url')}}</label>
        <input type="text" class="form-control" value="{{$settings  ? $settings['url'] : ''}}" name="val[url]"/>
    </div>

    <div class="mt-4 ">
        <button class="btn  btn-primary ">{{$new ? __('messages.add-widget') : __('messages.save-widget')}}</button>
        @if($widgetId)
            <button class="btn btn-secondary " onclick="return App.closeEditorWidget({{$widgetId}})">{{__('messages.close')}}</button>
        @endif
    </div>
</form>
