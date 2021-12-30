<?php
namespace App\Package;

trait Repository {
    private static $instance;

    public static function repository() {
        if (self::$instance) return self::$instance;
        return self::$instance = new static();
    }
}
