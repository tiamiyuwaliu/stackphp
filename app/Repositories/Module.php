<?php
namespace App\Repositories;

use App\Package\Repository;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class Module {
    use Repository;

    public function listModules() {
        $directories = File::directories(base_path('modules/'));

        $modules = [];
        foreach($directories as $directory) {

            $moduleInfo = include($directory.'/info.php');
            $modules[basename($directory)] = $moduleInfo;
        }
        return $modules;
    }

    public function activate($module) {
       DB::table('modules')->insert([
           'name' => $module
       ]);
    }

    public function disable($module) {
        DB::table('modules')->where('name', $module)->delete();
    }

    public function activeModules() {
        DB::table('modules')->get();
    }

    public function isActive($module) {
        return DB::table('modules')->where('name', $module)->first();
    }
}
