<?php
namespace App\Facades;
use Illuminate\Support\Facades\Facade;

class Hook extends Facade
{
    protected static function getFacadeAccessor()
    {
        return \App\Package\Hook::class;
    }
}
