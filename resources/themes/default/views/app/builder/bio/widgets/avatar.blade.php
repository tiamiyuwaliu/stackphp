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
    <input type="hidden" name="val[widget_type]" value="avatar"/>
    <input type="hidden" name="val[widget_icon]" value="bi bi-person-circle"/>

    <div>
        @if($settings)
            <input type="hidden" name="val[image]" value="{{$settings['image']}}"/>
            <div class="avatar" style="background-image:url({{url($settings['image'])}})"></div>
        @endif
        <label for="formFileLg" class="form-label">{{__('messages.choose-image-file')}}</label>
        <input class="form-control form-control-lg" name="file[image]" id="formFileLg" type="file">
    </div>

    <div class="mt-3">
        <label class="form-label">{{__('messages.size')}}</label>
        <select class="form-select" name="val[size]">
            <option {{($settings and $settings['size'] == 'small') ? 'selected' : null}} value="small">{{__('messages.small')}}</option>
            <option {{($settings and $settings['size'] == 'medium') ? 'selected' : null}} value="medium">{{__('messages.medium')}}</option>
            <option {{($settings and $settings['size'] == 'large') ? 'selected' : null}} value="large">{{__('messages.large')}}</option>
        </select>
    </div>

    <div class="mt-3">
        <label class="form-label">{{__('messages.border-radius')}}</label>
        <select name="val[radius]" class="form-select">
            <option {{($settings and $settings['radius'] == 'straight') ? 'selected' : null}} value="straight">{{__('messages.straight')}}</option>
            <option {{($settings and $settings['radius'] == 'rounded') ? 'selected' : null}} value="rounded">{{__('messages.rounded')}}</option>
            <option  {{($settings and $settings['radius'] == 'round') ? 'selected' : null}} value="round">{{__('messages.round')}}</option>
        </select>
    </div>

    <div class="mt-4 ">
        <button class="btn  btn-primary ">{{$new ? __('messages.add-widget') : __('messages.save-widget')}}</button>
        @if($widgetId)
            <button class="btn btn-secondary " onclick="return App.closeEditorWidget({{$widgetId}})">{{__('messages.close')}}</button>
        @endif
    </div>
</form>
