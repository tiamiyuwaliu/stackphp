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
    <input type="hidden" name="val[widget_type]" value="link"/>
    <input type="hidden" name="val[widget_icon]" value="bi bi-link-45deg"/>

    <div class="mt-2">
        <label class="form-label">{{__('messages.link-title')}}</label>
        <input type="text" class="form-control" value="{{$settings ? $settings['title'] : ''}}" name="val[title]"/>
    </div>
    <div class="mt-2 row">
        <div class="col-4">
            <select name="val[type]" class="form-select">
                <option {{($settings and $settings['type'] == 'url') ? 'selected' : null}} value="url">{{__('messages.url')}}</option>
                <option {{($settings and $settings['type'] == 'email') ? 'selected' : null}} value="email">{{__('messages.e-mail')}}</option>
                <option {{($settings and $settings['type']== 'tel') ? 'selected' : null}} value="tel">{{__('messages.tel')}}</option>
            </select>
        </div>
        <div class="col-8">
            <input type="text" class="form-control form-control-lg" value="{{$settings ? $settings['link'] : ''}}" name="val[link]"/>
        </div>
    </div>
    <div class="row mt-2">
        <div class="col-6">
            <Label class="form-label">{{__('messages.size')}}</Label>
            <select name="val[size]" class="form-select">
                <option {{($settings and $settings['size'] == 'large') ? 'selected' : null}} value="large">{{__('messages.large')}}</option>
                <option {{($settings and $settings['size'] == 'medium') ? 'selected' : null}} value="medium">{{__('messages.medium')}}</option>
            </select>
        </div>
        <div class="col-6">
            <Label class="form-label">{{__('messages.animation')}}</Label>
            <select name="val[animation]" class="form-select">
                <option {{($settings and $settings['animation'] == 'bounce') ? 'selected' : null}} value="bounce">{{__('messages.bounce')}}</option>
                <option {{($settings and $settings['animation'] == 'swing') ? 'selected' : null}} value="swing">{{__('messages.swing')}}</option>
                <option {{($settings and $settings['animation'] == 'tada') ? 'selected' : null}} value="tada">{{__('messages.tada')}}</option>
                <option {{($settings and $settings['animation'] == 'wobble') ? 'selected' : null}} value="wobble">{{__('messages.wobble')}}</option>
                <option {{($settings and $settings['animation'] == 'pulse') ? 'selected' : null}} value=pulse">{{__('messages.pulse')}}</option>
                <option {{($settings and $settings['animation'] == 'flash') ? 'selected' : null}} value="flash">{{__('messages.flash')}}</option>
                <option {{($settings and $settings['animation'] == 'fadeIn') ? 'selected' : null}} value="fadeIn">{{__('messages.fadein')}}</option>
                <option {{($settings and $settings['animation'] == 'flipInX') ? 'selected' : null}} value="flipInX">{{__('messages.flipin-x')}}</option>
                <option {{($settings and $settings['animation'] == 'flipInY') ? 'selected' : null}} value="flipInY">{{__('messages.flipin-y')}}</option>
                <option {{($settings and $settings['animation'] == 'slideInDown') ? 'selected' : null}} value="slideInDown">{{__('messages.slidein-down')}}</option>
                <option {{($settings and $settings['animation'] == 'slideInUp') ? 'selected' : null}} value="slideInUp">{{__('messages.slidein-up')}}</option>
            </select>
        </div>
    </div>

        <div class="form-check form-switch form-check-lg mt-3">
            <?php $time = time();?>
            <input type="hidden" name="val[tab]" value="0"/>
            <input class="form-check-input" {{($settings and isset($settings['tab']) and $settings['tab']) ? 'checked' : null}} name="val[tab]" value="1" type="checkbox" id="flexSwitchCheckDefaultTab{{$time}}">
            <label class="form-check-label pl-3" for="flexSwitchCheckDefaultTab{{$time}}">{{__('messages.open-new-tab')}}</label>
        </div>

    <div class="{{$new ? 'hide' : null}}">
        <h6 class="mt-3">{{__('messages.customize')}}</h6>
        <hr/>
        <div class="mt-2">
            <label class="form-label">{{__('messages.icon')}}</label>
            <input type="text" value="{{$settings ? $settings['icon'] : ''}}" class="form-control" name="val[icon]"/>
            <span class="text-muted"><a href="https://icons.getbootstrap.com/" target="_blank">Boostrap</a> {{__('messages.icon-link-note')}}</span>
        </div>
        <div class="row mt-2">
            <div class="col-6">
                <div class="mt-2">
                    <label class="form-label">{{__('messages.text-color')}}</label>
                    <input type="text" id="link-text-color{{$widgetId}}" data-target="#link-text-color{{$widgetId}}-value"  class="color-input"/>
                    <input type="hidden" id="link-text-color{{$widgetId}}-value" value="{{$settings ? $settings['color'] : '#EFEFEF'}}"  name="val[color]" class=""/>
                </div>
            </div>
            <div class="col-6">
                <div class="mt-2">
                    <label class="form-label">{{__('messages.background-color')}}</label>
                    <input type="text" id="link-text-bgcolor{{$widgetId}}" data-target="#link-text-bgcolor{{$widgetId}}-value"  class="color-input"/>
                    <input type="hidden" id="link-text-bgcolor{{$widgetId}}-value" value="{{$settings ? $settings['bgcolor'] : '#000'}}"   name="val[bgcolor]" class=""/>
                </div>
            </div>
        </div>
        <div class="row mt-2">
            <div class="col-6">
                <label class="form-label">{{__('messages.border-radius')}}</label>
                <select name="val[radius]" class="form-select">
                    <option {{($settings and $settings['radius'] == 'straight') ? 'selected' : null}} value="straight">{{__('messages.straight')}}</option>
                    <option {{($settings and $settings['radius'] == 'rounded') ? 'selected' : null}} value="rounded">{{__('messages.rounded')}}</option>
                    <option {{($settings and $settings['radius'] == 'round') ? 'selected' : null}} value="round">{{__('messages.round')}}</option>
                </select>
            </div>
            <div class="col-6">
                <label class="form-label">{{__('messages.border-style')}}</label>
                <select name="val[border-style]" class="form-select">
                    <option {{($settings and $settings['border-style'] == 'solid') ? 'selected' : null}} value="solid">{{__('messages.solid')}}</option>
                    <option {{($settings and $settings['border-style'] == 'dashed') ? 'selected' : null}} value="dashed">{{__('messages.dashed')}}</option>
                    <option {{($settings and $settings['border-style'] == 'double') ? 'selected' : null}} value="double">{{__('messages.double')}}</option>
                    <option {{($settings and $settings['border-style'] == 'outset') ? 'selected' : null}} value="outset">{{__('messages.outset')}}</option>
                </select>
            </div>
        </div>

        <div class="mt-3">
            <label for="link-border-width{{$widgetId}}" class="form-label">{{__('messages.border-width')}}</label>
            <input type="range" min="0" name="val[border-width]" value="{{($settings and isset($settings['border-width'])) ? $settings['border-width'] : '0'}}" class="form-range" id="link-border-width{{$widgetId}}">
        </div>
    </div>

    <div class="mt-4 ">
        <button class="btn  btn-primary ">{{$new ? __('messages.add-widget') : __('messages.save-widget')}}</button>
        @if($widgetId)
            <button class="btn btn-secondary " onclick="return App.closeEditorWidget({{$widgetId}})">{{__('messages.close')}}</button>
        @endif
    </div>
</form>
