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
    <input type="hidden" name="val[widget_type]" value="heading"/>
    <input type="hidden" name="val[widget_icon]" value="bi bi-type-h1"/>



    <div class="mt-3">
        <label class="form-label">{{__('messages.type')}}</label>
        <select class="form-select" name="val[size]">
            <option {{($settings and $settings['size'] == 'h1') ? 'selected' : null}} value="h1">H1</option>
            <option {{($settings and $settings['size'] == 'h2') ? 'selected' : null}} value="h2">H2</option>
            <option {{($settings and $settings['size'] == 'h3') ? 'selected' : null}} value="h3">H3</option>
            <option {{($settings and $settings['size'] == 'h4') ? 'selected' : null}} value="h4">H4</option>
            <option {{($settings and $settings['size'] == 'h5') ? 'selected' : null}} value="h5">H5</option>
            <option {{($settings and $settings['size'] == 'h6') ? 'selected' : null}} value="h6">H6</option>
        </select>
    </div>

    <div class="mt-2">
        <label class="form-label">{{__('messages.text')}}</label>
        <input type="text" class="form-control" value="{{$settings  ? $settings['text'] : ''}}" name="val[text]"/>
    </div>
    <div class="mt-2">
        <label class="form-label">{{__('messages.text-color')}}</label>
        <input type="text" id="heading-text-color{{$widgetId}}" data-target="#heading-text-color{{$widgetId}}-value"  class="color-input"/>
        <input type="hidden" id="heading-text-color{{$widgetId}}-value" value="{{$settings  ? $settings['color'] : '#EFEFEF'}}"   name="val[color]" class=""/>
    </div>
    <div class="mt-4 ">
        <button class="btn  btn-primary ">{{$new ? __('messages.add-widget') : __('messages.save-widget')}}</button>
        @if($widgetId)
            <button class="btn btn-secondary " onclick="return App.closeEditorWidget({{$widgetId}})">{{__('messages.close')}}</button>
        @endif
    </div>
</form>
