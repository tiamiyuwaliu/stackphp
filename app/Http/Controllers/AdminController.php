<?php
namespace App\Http\Controllers;

use App\Package\Uploader;
use App\Repositories\Module;
use App\Repositories\Pages;
use App\Repositories\Settings;
use App\Repositories\Theme;
use App\Repositories\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller {
    public function __construct()
    {
        parent::__construct();

        $this->setBackend();

    }

    public function index(Request $request) {
        $this->setTitle('Dashboard');
        $this->setActiveMenu('dashboard');

        return $this->render(view('cp.index'), true);
    }

    public function users(Request  $request) {
        $this->setTitle(__('messages.user-manager'));
        $this->setActiveMenu('users');

        if ($val = $request->input('val')) {
            if ($val['action'] == 'add') {
                $validators = Validator::make($val, [
                    'name' => 'required',
                    'email' => 'required|email:filter,rfc,dns|unique:users,email',
                    'password' => 'required',
                ]);
                if (!$validators->fails()) {
                    User::repository()->addUser($val);
                    return json_encode([
                        'type' => 'reload-canvas',
                        'content' => 'newUser',
                        'message' => __('messages.user-add-success')
                    ]);
                } else {
                    return json_encode([
                        'type' => 'error',
                        'message' => $validators->errors()->first()
                    ]);
                }
            } elseif($val['action'] == 'edit') {
                $validators = Validator::make($val, [
                    'name' => 'required',
                    'email' => 'required|email:filter,rfc,dns',

                ]);
                if (!$validators->fails()) {
                    User::repository()->saveUser($val, $val['id']);
                    return json_encode([
                        'type' => 'reload-canvas',
                        'content' => 'editUser'.$val['id'],
                        'message' => __('messages.user-saved-success')
                    ]);
                } else {
                    return json_encode([
                        'type' => 'error',
                        'message' => $validators->errors()->first()
                    ]);
                }
            }
        }

        if ($action = $request->input('action')) {
            switch($action) {
                case 'delete':
                    User::repository()->delete($request->input('id'));
                    return json_encode([
                        'type' => 'reload',
                        'message' => __('messages.user-deleted-success')
                    ]);
                    break;
            }
        }
        return $this->render(view('cp.users', [
            'users' => User::repository()->getUsers()
        ]), true);
    }

    public function email(Request  $request) {
        $this->setTitle(__('messages.email-setup'));
        $this->setActiveMenu('email');

        return $this->render(view('cp.email'), true);
    }

    public function pages(Request  $request) {
        $this->setTitle(__('messages.pages-manager'));
        $this->setActiveMenu('pages');

        if ($val = $request->input('val')) {
            if($val['action'] == 'add') {
                $validators = Validator::make($val, [
                    'title' => 'required',
                    'content' => 'required'
                ]);
                if (!$validators->fails()) {
                    Pages::repository()->add($val);
                    return json_encode([
                        'type' => 'reload-modal',
                        'content' => '#newPageModal',
                        'message' => __('messages.page-add-success')
                    ]);
                } else {
                    return json_encode([
                        'type' => 'error',
                        'message' => $validators->errors()->first()
                    ]);
                }

            } elseif($val['action'] == 'edit') {
                $validators = Validator::make($val, [
                    'title' => 'required',
                    'content' => 'required'
                ]);
                if (!$validators->fails()) {
                    Pages::repository()->save($val, $val['id']);
                    return json_encode([
                        'type' => 'reload-modal',
                        'content' => '#editPageModal'.$val['id'],
                        'message' => __('messages.page-save-success')
                    ]);
                } else {
                    return json_encode([
                        'type' => 'error',
                        'message' => $validators->errors()->first()
                    ]);
                }

            }
        }

        if($action = $request->input("action")) {
            switch($action) {
                case 'delete':
                    Pages::repository()->delete($request->input('id'));
                    return json_encode([
                        'type' => 'reload',
                        'message' => __('messages.page-deleted-success')
                    ]);
                    break;
            }
        }
        return $this->render(view('cp.pages', [
            'pages' => Pages::repository()->getAllPages()
        ]), true);
    }

    public function modules(Request $request) {
        $this->setTitle(__('messages.modules-manager'));
        $this->setActiveMenu('modules');

        if ($action = $request->input('action')) {
            switch($action) {
                case 'enable':
                    Module::repository()->activate($request->input('id'));
                    return json_encode([
                        'type' => 'reload',
                        'message' => __('messages.module-enabled-success')
                    ]);
                    break;
                case 'disable':
                    Module::repository()->disable($request->input('id'));
                    return json_encode([
                        'type' => 'reload',
                        'message' => __('messages.module-disabled-success')
                    ]);
                    break;
            }
        }
        return $this->render(view('cp.modules', [
            'modules' => Module::repository()->listModules()
        ]), true);
    }

    public function themes(Request $request) {
        $this->setTitle(__('messages.themes-manager'));
        $this->setActiveMenu('themes');
        if ($action = $request->input('action')) {
            switch($action) {
                case 'enable':
                    Theme::repository()->enable($request->input('id'));
                    return json_encode([
                        'type' => 'reload',
                        'message' => __('messages.theme-enabled-success')
                    ]);
                    break;
            }
        }
        return $this->render(view('cp.themes', [
            'themes' => Theme::repository()->listThemes()
        ]), true);
    }

    public function settings(Request $request) {
        $this->setTitle('Settings');
        $this->setActiveMenu('settings');
        $this->setActiveSubMenu('settings');

        if ($val = $request->input('val')) {
            if ($images = $request->input('img')) {
                foreach($images as $image => $value) {
                    $file = $request->file($image);
                    if ($file) {
                        $uploader = new Uploader($file, 'image');
                        $uploader->setPath("settings/");
                        if ($uploader->passed()) {
                            $val[$image] = $uploader->uploadFile()->result();
                        } else {
                            return json_encode([
                                'type' => 'error',
                                'message' => $uploader->getError()
                            ]);
                        }
                    } else {
                        $val[$image] = $value;
                    }
                }
            }
            Settings::repository()->save($val);
            return json_encode([
                'type' => 'function',
                'message' => __('messages.settings-saved')
            ]);
        }

        switch ($request->segment(3, 'general')) {
            case 'information':
                $this->setActiveMenu('information');
                $content = view('cp.setup/information');
                break;
            case 'email':
                $this->setActiveMenu('email');
                $content = view('cp.setup/email');
                break;
            case 'social':
                $this->setActiveMenu('social');
                $content = view('cp.setup/social');
                break;
            case 'upload':
                $this->setActiveMenu('upload');
                $content = view('cp.setup/upload');
                break;
            default:
                $content = view('cp.setup/general');
                break;
        }
        return $this->render($content, true);
    }
}
