<?php
namespace App\Http\Controllers;



use App\Facades\Hook;
use App\Repositories\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class HomeController extends Controller {

    public function __construct() {
        parent::__construct();
        $this->setFrontend();
    }

    public function index(Request $request) {
        return $this->render(view('frontend.home'), true);
    }



    public function login(Request  $request) {

        if ($val = $request->input('val')) {
            $validators = Validator::make($val, [
                'email' => ['required', 'email'],
                'password' => ['required'],
            ]);

            if (!$validators->fails()) {
                if (Auth::attempt([
                    'email' => $val['email'],
                    'password' => $val['password']
                ], true))  {
                    $request->session()->regenerate();
                    return json_encode([
                        'type' => 'normal-url',
                        'value' => url('home')
                    ]);
                } else {
                    return json_encode([
                        'type' => 'error',
                        'message' => 'Invalid login details'
                    ]);
                }
            } else {
                return json_encode([
                    'type' => 'error',
                    'message' => $validators->errors()->first()
                ]);
            }
        }
        return $this->render(view('frontend/layouts/auth', array('content' => view('frontend/login'))), true);
    }

    public function signup(Request  $request) {
        if ($val = $request->input('val')) {

            $validators = Validator::make($val, [
                'name' => 'required',
                'email' => 'required|email:filter,rfc,dns|unique:users,email',
                'password' => 'required',
            ]);
            $validators->validated();

            if (!$validators->fails()) {
                User::repository()->addUser($val);
                if (Auth::attempt([
                    'email' => $val['email'],
                    'password' => $val['password']
                ], true))  {
                    $request->session()->regenerate();
                    return json_encode([
                        'type' => 'normal-url',
                        'value' => url('home')
                    ]);
                }
            } else {
                return json_encode([
                    'type' => 'error',
                    'message' => $validators->errors()->first()
                ]);
            }

        }
        return $this->render(view('frontend/signup'), true);
    }

    public function logout(Request $request) {
        Auth::logout();
        $request->session()->regenerate();
        return redirect(url(''));
    }
}
