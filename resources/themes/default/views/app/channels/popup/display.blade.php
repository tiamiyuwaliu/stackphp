<?php $accounts = (isset($accounts)) ? $accounts : [];?>
<div class="each clearfix" data-id="{{$channel->id}}" data-username="{{$channel->username}}" data-avatar="{{url($channel->avatar)}}">
    <div class="float-start">
        <div class="avatar" style="background-image:url({{url($channel->avatar)}})"></div>
        <div class="info">
            <h6>{{$channel->username}}</h6>
        </div>
    </div>
    <div class="float-end">
        <div class="form-check form-check-md">
            <input {{(in_array($channel->id, $accounts))?'checked':null}} class="form-check-input" type="checkbox" name="val[accounts][]" value="{{$channel->id}}" id="flexCheckDefault{{$channel->id}}">
            <label class="form-check-label" for="flexCheckDefault{{$channel->id}}"></label>
        </div>
    </div>
</div>
