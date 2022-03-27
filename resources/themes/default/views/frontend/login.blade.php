
<div class="body_wrapper">
    {{view('frontend.layouts.header', ['className' => 'fixed-header'])}}

    <section class="login_area">
        <div class="container">
            <div class="row">
                <div class="col-lg-7">
                    <div class="login_info">
                        <h2 class="f_p f_700 f_size_40 t_color3 mb_20">Login</h2>
                        <p class="f_p f_400 f_size_15">Welcome Back! </p>
                        <form action="" method="post"  class="login-form mt_60 general-form">
                            @csrf
                            <div class="form-group text_box">
                                <label class="f_p text_c f_400">Email address</label>
                                <input name="val[email]" type="text" placeholder="Email address">
                            </div>
                            <div class="form-group text_box">
                                <label class="f_p text_c f_400">Password</label>
                                <input name="val[password]" type="password" placeholder="******">
                            </div>
                            <button type="submit" class="btn_three">Log in</button>
                            <div class="alter-login text-center mt_30">
                                New user? <a class="login-link" href="{{url('signup')}}">Create a free account</a>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-lg-4 d-flex align-items-center">
                    <div class="login_img">
                        <img src="{{url('resources/themes/default/images/auth-bg.png')}}" alt="">
                    </div>
                </div>
            </div>
        </div>
    </section>
    {{view('frontend.layouts.footer')}}
</div>
