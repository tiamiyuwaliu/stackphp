<?php
namespace App\Repositories;

use App\Package\Repository;
use Illuminate\Support\Facades\DB;

class Settings  {
    use Repository;

    public function load() {
        $settings = DB::table('settings')->get();
        foreach($settings as $setting) {
            config([$setting->settings_key => $setting->settings_value]);
        }
    }
    public function exists($key) {
        return DB::table('settings')->where('settings_key', $key)->first();
    }
    public function save($val) {
        foreach($val as $key => $value) {
            if ($this->exists($key)) {
                DB::table('settings')->where('settings_key', $key)->update(['settings_value' => $value]);
            } else {
                DB::table('settings')->insert([
                    'settings_key' => $key,
                    'settings_value' => $value
                ]);
            }
        }
    }
}
