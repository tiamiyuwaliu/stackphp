<h4 class="title">{{__('messages.edit-account')}}</h4>

<form action="{{url('account')}}" method="post" class="general-form">
    <div class="box shadow-sm">
        <div class="form-floating mb-3">
            <input type="text" name="val[name]" class="form-control" value="{{\App\Repositories\User::repository()->getUser()->name}}" placeholder="{{__('messages.full-name')}}">
            <label for="floatingInput">{{__('messages.full-name')}}</label>
        </div>

        <div class="form-floating mb-3">
            <input type="text" name="val[email]"  class="form-control"  {{\App\Repositories\User::repository()->getUser()->email}} placeholder="{{__('messages.email-address')}}">
            <label for="floatingInput">{{__('messages.email-address')}}</label>
        </div>

        <h6>{{__('messages.update-password')}}</h6>
        <div class="form-floating mb-3">
            <input type="password" name="val[password]" class="form-control"  placeholder="******">
            <label for="floatingInput">{{__('messages.password')}}</label>
        </div>

        <div class="mt-4">
            <button class="btn btn-primary">{{__('messages.save')}}</button>
        </div>
    </div>
</form>
