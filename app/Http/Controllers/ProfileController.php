<?php
namespace App\Http\Controllers;

use App\Package\Uploader;
use App\Repositories\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function index(Request $request)
    {
        $this->setTitle(__('messages.account-settings'));
        $page = $request->segment(2);
        switch($page) {
            case 'profile':
                if ($val = $request->input('val')) {
                    if ($val['action'] == 'upload') {
                        $file = $request->file('file');
                        $uploader = new Uploader($file, 'image');
                        $uploader->setPath("avatar/".User::repository()->authId.'/');
                        $uploader->setImageSizes([300]);
                        if ($uploader->passed()) {
                            $image = $uploader->resize()->result();
                            $image =  str_replace('%w', 300, $image);
                            User::repository()->updateUser(['avatar' => $image]);
                            return json_encode([
                                'type' => 'reload',
                                'message' => __('messages.avatar-updated-success')
                            ]);
                        } else {
                            return json_encode([
                                'type' => 'error',
                                'message' => $uploader->getError()
                            ]);
                        }
                    } elseif ($val['action'] == 'profile') {
                        User::repository()->updateUser([
                            'name' => $val['name'],
                            'email' => $val['email'],
                            'gender' => $val['gender'],
                            'timezone' => $val['timezone']
                        ]);
                        return json_encode([
                            'type' => 'reload',
                            'message' => __('messages.account-updated-success')
                        ]);
                    }
                }
                return $this->render(view('app/settings/profile'), true);
                break;
            case 'security':
                if ($val = $request->input('val')) {
                    $user = User::repository()->authUser;
                    if (Hash::check($val['current'], $user->password)) {
                        return json_encode([
                            'type' => 'reload',
                            'message' => __('messages.password-does-match-old')
                        ]);
                    }

                    if ($val['new'] != $val['confirm']) {
                        return json_encode([
                            'type' => 'reload',
                            'message' => __('messages.password-does-match')
                        ]);
                    }

                    User::repository()->updateUser(['password' => Hash::make($val['new'])]);
                    return json_encode([
                        'type' => 'reload',
                        'message' => __('messages.password-updated-success')
                    ]);
                }
                return $this->render(view('app/settings/security'), true);
                break;
            case 'cancel':
                if ($val = $request->input('val')) {

                }
                return $this->render(view('app/settings/cancel'), true);
                break;
        }
        return $this->render(view('app/settings/index'), true);
    }

}
