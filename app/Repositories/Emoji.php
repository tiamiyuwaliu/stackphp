<?php
namespace App\Repositories;

use App\Package\Repository;

require app_path('Package/emoji/vendor/autoload.php');
class Emoji {
    use Repository;

    public function toShort($text) {
        $emojione = new \JoyPixels\Client(new \JoyPixels\Ruleset());
        return $emojione->toShort($text);
    }

    public function toImage($text) {
        $emojione = new \JoyPixels\Client(new \JoyPixels\Ruleset());
        return $emojione->shortnameToImage($text);
    }

}
