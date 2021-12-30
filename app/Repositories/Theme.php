<?php
namespace App\Repositories;

use App\Package\Repository;
use Illuminate\Support\Facades\File;

class Theme {
    use Repository;

    public function listThemes() {
        $directories = File::directories(base_path('resources/themes/'));

        $themes = [];
        foreach($directories as $directory) {

            $themeInfo = include($directory.'/info.php');
            $themes[basename($directory)] = $themeInfo;
        }
        return $themes;
    }

    public function enable($theme) {
        Settings::repository()->save(['theme' => $theme]);
    }
}
