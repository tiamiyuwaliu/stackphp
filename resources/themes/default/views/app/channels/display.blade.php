<div class="each clearfix">
    <div class="float-start">
        <div class="detail">
            <div class="avatar" style="background-image:url({{url($channel->avatar)}})"></div>
            <div class="info">
                <h6>{{$channel->username}}</h6>
            </div>
        </div>
    </div>
    <div class="float-end">
        <form action="{{url('channels')}}" method="post" class="form-auto-submit general-form">
            <input type="hidden" name="val[action]" value="toggle-channel-status"/>
            <input type="hidden" name="val[id]" value="{{$channel->id}}"/>
            <input type="hidden" name="val[status]" value="0"/>
            <div class="form-check form-check-lg form-switch">
                <input name="val[status]" {{$channel->status ? 'checked' : null}} value="1" class="form-check-input " type="checkbox" id="flexSwitchCheckCheckedChannel{{$channel->id}}" >
                <label class="form-check-label" for="flexSwitchCheckCheckedChannel{{$channel->id}}"></label>
            </div>
        </form>

    </div>
</div>
