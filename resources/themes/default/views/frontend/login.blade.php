<div class="content">
    <div class="head">
        <h1>{{__('messages.login')}}</h1>
        <p>{{__('messages.login-to-your-account')}}</p>
    </div>
    <form action="{{url('login')}}" method="post" class="general-form">
        @csrf
        <div class="form-group">
            <label class="form-label">{{__('messages.email-address')}}</label>
            <div class="input-group">
                <span class="input-group-text" id="basic-addon1"><i class="bi bi-envelope"></i></span>
                <input type="text" name="val[email]" class="form-control"  placeholder="{{__('messages.email-address')}}" aria-label="Username" aria-describedby="basic-addon1">
            </div>
        </div>
        <div class="form-group">
            <label class="form-label">{{__('messages.password')}}</label>
            <div class="input-group">
                <span class="input-group-text" id="basic-addon1"><i class="bi bi-file-lock"></i></span>
                <input type="password" name="val[password]" class="form-control" placeholder="{{__('messages.password')}}" aria-label="Username" aria-describedby="basic-addon1">
            </div>
        </div>
        <div class="d-grid gap-2">
            <button type="submit" class="btn btn-primary btn-lg">{{__('messages.login')}}</button>
        </div>

        <div class="or-container">
            <span>{{__('messages.or')}}</span>
        </div>

        <div class="social-btn-container">
            <a href="{{url('facebook/auth')}}" class="social-btn facebook-login-btn"><i class="bi bi-facebook"></i> </a>
            <a href="{{url('twitter/auth')}}" class="social-btn twitter-login-btn"><i class="bi bi-twitter"></i> </a>
            <a href="{{url('google/auth')}}" class="social-btn google-login-btn"><i class="bi bi-google"></i> </a>
        </div>
    </form>

</div>
