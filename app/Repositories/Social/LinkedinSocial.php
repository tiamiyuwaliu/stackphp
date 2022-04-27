<?php
namespace App\Repositories\Social;

use App\Package\Repository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

include app_path('Package/linkedin/autoload.php');

class LinkedinSocial {
    use Repository;

    public function __construct(){
        $this->linkedin = new \Phillipsdata\LinkedIn\LinkedIn(config('linkedin-client-id'), config('linkedin-client-secret'), url('channel/linkedin'));
    }

    function loginUrl(){
        $scope = "r_emailaddress r_liteprofile w_member_social";
        if (config('linkedin-channel-page')) $scope = 'r_emailaddress r_liteprofile w_member_social w_organization_social r_organization_social rw_organization_admin';
        return $this->linkedin->getPermissionUrl( $scope );
    }

    function getToken(){
        try {
            if($code = app('request')->input("code")){
                $tokenResponse = $this->linkedin->getAccessToken($code);

                if($tokenResponse->status() == 200){
                    $tokenResponse = $tokenResponse->response();
                    return $tokenResponse->access_token;
                }else{
                    redirect(url("channel/linkedin", array('auth' => true)));
                }

            }else{
                redirect(url("channel/linkedin", array('auth' => true)));

            }

        } catch (\Exception $e) {
            redirect(url("channel/linkedin", array('auth' => true)));

        }
    }

    function setToken($token){
        $token = (object)array(
            "access_token" => $token
        );

        $this->linkedin->setAccessToken($token);
    }

    function getCurrentUser(){
        try {
            $profile = $this->linkedin->getUser();
            if($profile->status() == 200){
                return $profile->response();
            }else{
                return false;
            }
        } catch (\Exception $e) {
            return false;
        }
    }

    function getCompanies(){
        try {
            $companies = $this->linkedin->getCompanies();
            if($companies->status() == 200){
                return $companies->response();
            }else{
                return false;
            }
        } catch (\Exception $e) {
            return false;
        }
    }

    public function getAvatar($user) {
        if (isset($user->profilePicture)) {
            $picture = json_decode(json_encode($user->profilePicture), true);
            if (isset($picture['displayImage~']['elements'][0]['identifiers']['0']['identifier'])) {
                $avatar = $picture['displayImage~']['elements'][0]['identifiers']['0']['identifier'];
                $dir = "uploads/avatar/".Auth::id().'/';
                if (!is_dir(public_path($dir))) mkdir(public_path($dir), 0777, true);
                $file = $dir.md5($avatar).'.jpg';
                getFileViaCurl($avatar, $file);
                return $file;
            }
        }
        return 'resources/themes/default/images/social/linkedin.png';
    }

    public function dologin($response) {
        if(isset($response->status) && $response->status == 401){

        }
    }
}
