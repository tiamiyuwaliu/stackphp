<div class="body_wrapper">
    {{view('frontend.layouts.header')}}
    <section class="payment_banner_area_two">
        <div class="container">
            <div class="payment_content_two text-center">
                <h2 class="mt-5">{!!__('messages.home-landing-text')!!}</h2>
                <div class="action_btn d-flex align-items-center justify-content-center">
                    <a href="#" class="slider_btn btn_hover">{{__('messages.browse-products')}}</a>
                    <a href="#" class="video_btn">{{__('messages.contact-us-for-info')}}?</a>
                </div>
            </div>
            <div class="symbols-pulse active">
                <div class="pulse-1"></div>
                <div class="pulse-2"></div>
                <div class="pulse-3"></div>
                <div class="pulse-4"></div>
                <div class="pulse-x"></div>
            </div>
        </div>
    </section>


    <section class="payment_features_area_three bg_color">
        <div class="container">
            <div class="sec_title text-center mb_70 wow fadeInUp" data-wow-delay="0.3s" style="visibility: visible; animation-delay: 0.3s; animation-name: fadeInUp;">
                <h2 class="f_p f_size_30 l_height50 f_700 t_color">Here is what you can expect</h2>
                <p class="f_400 f_size_18 l_height34">He lost his bottle squiffy bog bleeding hunky-dory wind up
                    morish tomfoolery spend<br> a penny hanky panky, lemon squeezy vagabond.!</p>
            </div>
            <div class="row">
                <div class="col-lg-7 d-flex align-items-center">
                    <div class="payment_features_content_two">
                        <h2 class="t_color">How we help our clients<br> measure social</h2>
                        <p>He lost his bottle a load of old tosh cup of tea bog-standard<br> matie boy blow off the
                            little rotter morish.!</p>
                        <div class="row">
                            <div class="col-lg-6 col-md-6">
                                <div class="item">
                                    <img src="img/new/icon/icon1.png" alt="">
                                    <h3>Customized registration</h3>
                                    <p>Nice one mufty brown bread James Bond lost the plot chinwag vagabond are.!
                                    </p>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6">
                                <div class="item">
                                    <img src="img/new/icon/icon2.png" alt="">
                                    <h3>Fast and simple Setup</h3>
                                    <p>Nice one mufty brown bread James Bond lost the plot chinwag vagabond are.!
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-5">
                    <img class="img-fluid" src="img/new/features_01.png" alt="">
                </div>
            </div>
        </div>
    </section>

    <section class="seo_fact_area sec_pad">
        <div class="home_bubble">
            <div class="bubble b_one"></div>
            <div class="bubble b_three"></div>
            <div class="bubble b_four"></div>
            <div class="bubble b_six"></div>
            <div class="triangle b_eight" data-parallax="{&quot;x&quot;: 120, &quot;y&quot;: -10}" style="transform:translate3d(0.029px, 0px, 0px) rotateX(0deg) rotateY(0deg) rotateZ(0deg) scaleX(1) scaleY(1) scaleZ(1); -webkit-transform:translate3d(0.029px, 0px, 0px) rotateX(0deg) rotateY(0deg) rotateZ(0deg) scaleX(1) scaleY(1) scaleZ(1); "><img src="{{url('resources/themes/default/images/seo/triangle_one.png')}}" alt=""></div>
        </div>
        <div class="container">
            <div class="seo_sec_title text-center mb_70 wow fadeInUp" data-wow-delay="0.3s" style="visibility: visible; animation-delay: 0.3s; animation-name: fadeInUp;">
                <h2>Over 1200+<br> completed work &amp; Still counting.</h2>
            </div>
            <div class="seo_fact_info">
                <div class="seo_fact_item">
                    <div class="text">
                        <div class="counter one">693</div>
                        <p>Happy Clients</p>
                    </div>
                </div>
                <div class="seo_fact_item">
                    <div class="text">
                        <div class="counter two">276</div>
                        <p>Projects</p>
                    </div>
                </div>
                <div class="seo_fact_item">
                    <div class="text">
                        <div class="counter three">102</div>
                        <p>SEO Winners</p>
                    </div>
                </div>
                <div class="seo_fact_item last">
                    <div class="text">
                        <div class="counter four">93</div>
                        <p>Experience</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="seo_call_to_action_area sec_pad">
        <div class="container">
            <div class="seo_call_action_text">
                <h2>Need Support?<br> We are fast in responding to ticket</h2>
                <a href="#" class="about_btn">Get Support</a>
            </div>
        </div>
    </section>
    {{view('frontend.layouts.footer')}}
</div>
