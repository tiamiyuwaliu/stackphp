<div class="content-padding scroll-inner-right modern-scroll pr-0">
    <div class="container-lg">
        <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{url('publish')}}" data-ajax="true">{{__('messages.home')}}</a></li>
                <li class="breadcrumb-item" ><a href="{{url('account')}}" data-ajax="true">{{__('messages.account')}}</a> </li>
                <li class="breadcrumb-item active"  aria-current="page">{{__('messages.security')}}</li>
            </ol>
        </nav>

        <h3>{{__('messages.security')}}</h3>

        <div class="box box-padding">
            <form action="{{url('account/security')}}" method="post" class="general-form">

                <div class="alert alert-warning">{{__('messages.delete-account-warning')}}</div>
                <div class="row mt-3">
                    <div class="col-2">
                        <h6 class="mt-4">{{__('messages.current-password')}}</h6>
                    </div>
                    <div class="col-8">
                        <div class="form-floating mb-3">
                            <input required type="password" name="val[current]" value="" class="form-control" id="floatingInputCurrent" placeholder="{{__('messages.current-password')}}">
                            <label for="floatingInputCurrent">{{__('messages.current-password')}}</label>
                        </div>
                    </div>
                </div>

                <div class="mt-4">
                    <button type="submit" class="btn btn-danger">{{__('messages.delete')}}</button>
                </div>

            </form>
        </div>
    </div>
</div>
