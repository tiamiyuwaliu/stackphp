<?php
namespace App\Http\Controllers;



use App\Facades\Hook;
use App\Repositories\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class DashboardController extends Controller {
    public function __construct() {
        parent::__construct();
        $this->setApp();
    }

    public function index() {
        $this->setActiveMenu('home');
        $this->setTitle(__('messages.home'));
        return $this->render(view('app.dashboard.index'), true);
    }

    public function account(Request $request) {
        $this->setActiveMenu('account');
        $this->setTitle(__('messages.my-account'));

        if ($val = $request->input('val')) {
            User::repository()->saveAccount($val);
            return json_encode([
                'type' => 'reload',
                'message' => __('messages.account-settings-saved')
            ]);
        }
        return $this->render(view('app.account.index'), true);
    }
}
