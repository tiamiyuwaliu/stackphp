<?php
namespace App\Http\Controllers;

use App\Package\Uploader;
use App\Repositories\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BuilderController extends Controller {
    public function __construct()
    {
        parent::__construct();
    }

    public function index(Request $request) {
        $this->setTitle(__('messages.bio-link'));
        $this->setActiveMenu('bio');

        if ($val = $request->input('val')) {
            if($val['action'] == 'add') {
                if(isset($val['slug']) and $val['slug']) {
                    if(Builder::repository()->findLinkBySlug($val['slug'])) {
                        return json_encode([
                            'type' => 'error',
                            'message'=> __('messages.provided-biolink-url-exist')
                        ]);
                    }
                }
                $val['type'] = 'bio';
                Builder::repository()->addBio($val);
                return json_encode([
                    'type' => 'reload-modal',
                    'content' => '#bioLinkModal',
                    'message' => __('messages.bio-page-added')
                ]);
            }
        }

        if ($action = $request->input('action')) {
            if ($action == 'change-status') {
                return Builder::repository()->changeStatus($request->input('id'), $request->input('status'));
            }
        }
        return $this->render(view('app/builder/bio/index', ['links' => Builder::repository()->getLinks('bio')]), true);
    }

    public function bioPage(Request $request, $id) {
        $this->setTitle(__('messages.bio-link'));
        $this->setActiveMenu('bio');

        $page = Builder::repository()->findLinkBySlug($id);
        if (!$page) return redirect(url('builder/bio'));

        if ($val = $request->input('val')) {
            if ($val['action'] == 'save-settings') {
                $files = $request->file('file');
                if ($files) {
                    foreach($files as $key => $file) {
                        $uploader = new Uploader($file, 'image');
                        $uploader->setPath('bio/media/'.Auth::id().'/');
                        if ($uploader->passed()) {
                            $val[$key] = $uploader->uploadFile()->result();
                        }
                    }
                }
                if (isset($val['slug'])) {
                    if (Builder::repository()->findLinkBySlug($val['slug'], $page->id)) {
                        return json_encode([
                            'type' => 'error',
                            'message' => __('messages.bio-slug-already-exist')
                        ]);
                    }
                }
                Builder::repository()->saveLinkSettings($val, $page);
                return json_encode([
                    'type' => 'function',
                    'value' => 'App.reloadBioPreview'
                ]);
            } elseif($val['action'] == 'save-widget') {
                $files = $request->file('file');
                if ($files) {
                    foreach($files as $key => $file) {
                        $uploader = new Uploader($file, 'image');
                        $uploader->setPath('bio/media/'.Auth::id().'/');
                        if ($uploader->passed()) {
                            $val[$key] = $uploader->uploadFile()->result();
                        }
                    }
                }
                Builder::repository()->saveWidget($val, $page->id);
                return json_encode([
                    'type' => 'function',
                    'value' => ($val['widget_id']) ? 'App.reloadBioPreview' : 'App.closeAddWidget'
                ]);
            }
        }

        if ($action = $request->input('action')) {
            switch($action) {
                case 'delete-widget':
                    Builder::repository()->deleteWidget($request->input('id'));
                    return json_encode([
                        'type' => 'function',
                        'value' => 'App.widgetDeleted',
                        'content' => $request->input('id'),
                        'message' => __('messages.widget-deleted-success')
                    ]);
                    break;
                case 'duplicate':
                    Builder::repository()->duplicateWidget($request->input('id'));
                    return json_encode([
                        'type' => 'reload',
                        'message' => __('messages.widget-duplicated-success')
                    ]);
                    break;
                case 'arrange':
                    Builder::repository()->arrangeWidgets($request->input('id'), $request->input('ids'));
                    break;
            }
        }

        return $this->render(view('app/builder/bio/page', ['page' => $page]), true);
    }

    public function report(Request $request, $slug) {
        $this->setTitle(__('messages.bio-link'));
        $this->setActiveMenu('bio');

        $page = Builder::repository()->findLinkBySlug($slug);
        if (!$page) return redirect(url('builder/bio'));
        $current = $request->input('page', 'overview');

        return $this->render(view('app/builder/report/index', ['page' => $page, 'current' => $current]), true);
    }
    public function viewer(Request $request, $slug) {
        $this->setFrontend();
        $link = Builder::repository()->findLinkBySlug($slug);

        if (!$link) return false;
        $settings = perfectUnserialize($link->settings);

        Builder::repository()->addStats($link);


        $this->setTitle(($settings['page-title']) ? $settings['page-title'] : __('messages.bio-page'));
        return $this->render(view('app/builder/viewer/'.$link->type, ['link' => $link]), true);
    }
}
