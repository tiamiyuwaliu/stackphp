<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Request;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    private $pageType = "app";
    private $pageTitle = "";
    private $pageLayout = "layouts.app";
    public $activeMenu = "";
    private $rtl = false;

    public function __construct()
    {

        if (Request::session()->has('rtl-session')) {
            $this->rtl = Request::session()->get('rtl-session');
        }
        $rtl = Request::input('rtl', false);
        if ($rtl) {
            $this->rtl = $rtl;
        }
        if (Request::has('rtl-disable')) {
            $this->rtl = false;
            Request::session()->remove('rtl-session');
        }
    }

    public function setTitle($title) {
        $this->pageTitle= $title;
        return $this;
    }

    public function setActiveMenu($menu) {
        $this->activeMenu = $menu;
        return $this;
    }

    public function setFrontend(){
        $this->pageType = 'frontend';
        $this->pageLayout = 'layouts.frontend';
    }

    public function setApp() {
        $this->pageType = 'app';
        $this->pageLayout = 'layouts.app';
    }

    public function setBackend() {
        $this->pageType = 'backend';
        $this->pageLayout = 'layouts.admin';
    }

    public function render($content, $wrap = true) {
        Blade::withoutDoubleEncoding();

        if ($wrap) {
            $content = view($this->pageLayout, array('content' => $content, 'controller' => $this));
        }
        if (isAjax()) {
            return json_encode(array(
                'title' => $this->pageTitle,
                'content' => $content->render(),
                'container' => '#page-container',
            ));
        }
        $content = view('layouts.base', array(
            'content' => $content,
            'title' => $this->pageTitle,
            'rtl' => $this->rtl,
            'controller' => $this,
            'active_menu' => $this->activeMenu,
            'pageType' => $this->pageType,
        ));
        return $content;
    }
}
