<?php

namespace App\Providers;

use App\Facades\Hook;
use App\Repositories\Settings;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //

    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Blade::withoutDoubleEncoding();
        Paginator::useBootstrap();
        //
        $theme = 'default';
        $settings = DB::table('settings')->where("settings_key", 'theme')->first();
        if ($settings) $theme = $settings->settings_value;
        config(['view.paths' => [resource_path("themes/$theme/views")]]);
        //load default settings
        $defaultSettings = [
            'activation-subject' => 'Hello {full_name}! Activation your account',
            'activation-content' => "Welcome to {site-name}!

Hello {full_name},

Thank you for joining! We're glad to have you as community member, and we're stocked for you to start exploring our service.
 All you need to do is activate your account:
  {activation_link} ",
            'welcome-subject' => 'Hi {full_name}! Getting Started with Our Service',
            'welcome-content' => "Hello {full_name}!

Congratulations!
You have successfully signed up for our service.
We hope you enjoy this package! We love to hear from you,

Thanks and Best Regards!",
            'reset-subject' => 'Reset Your Password',
            'reset-content' => "Hi {full_name}! <br/> Please click the link below to activate your account <br/> <a href='{link}'>{link}</a> <br/> Thanks"
        ];
        foreach($defaultSettings as $key => $value) {
            config([$key => $value]);
        }
        //load other database settings
        Settings::repository()->load();

    }
}
