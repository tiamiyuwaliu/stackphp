<?php
namespace App\Http\Controllers;

use App\Repositories\Template;
use Illuminate\Http\Request;

class TemplateController extends  Controller{

    public function __construct()
    {
        parent::__construct();
        $this->setActiveMenu('templates');
    }

    public function index(Request $request) {
        $page = $request->segment(2, 'caption');
        if ($val = $request->input('val')) {
            if ($val['action'] == 'add') {
                Template::repository()->save($val, $page);
                return json_encode([
                    'type' => 'reload-modal',
                    'content' => '#addTemplateModal',
                    'message' => __('messages.template-saved-succeess')
                ]);
            } elseif($val['action'] == 'edit') {
                Template::repository()->save($val, $page, $val['id']);
                return json_encode([
                    'type' => 'reload-modal',
                    'content' => '#editTemplateModal'.$val['id'],
                    'message' => __('messages.template-saved-succeess')
                ]);
            }
        }

        if ($action = $request->input('action')) {
            if ($action == 'delete') {
                Template::repository()->delete($request->input('id'));
                return json_encode([
                    'type' => 'reload',
                    'message' => __('messages.template-deleted')
                ]);
            }elseif($action == 'search-template') {
                return view('app/templates/popup/search', [
                    'templates' => Template::repository()->getTemplates($request->input('type'), $request->input('term'))
                ]);
            }
        }

        return $this->render(view('app/templates/index', [
            'page' => $page,
            'templates' => Template::repository()->getTemplates($page)
        ]), true);
    }
}
