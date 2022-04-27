<?php
namespace App\Repositories\Social;

use App\Package\Repository;
use Illuminate\Support\Facades\Auth;

include app_path('Package/Facebook/autoload.php');

class FacebookSocial {
    use Repository;
    private $appId;
    private $appSecret;
    private $accessToken;
    public $fb;
    private $accountId = null;
    private $permissions = array();

    public function __construct() {
        $this->init(config('facebook-app-id'), config('facebook-app-secret'));
    }

    public function setPermissions($permissions) {
        $this->permissions = $permissions;
    }
    public function init($appId, $appSecret) {
        $this->appId = $appId;
        $this->appSecret = $appSecret;

        try {
            $this->fb = new \Facebook\Facebook(array(
                'app_id' => $this->appId,
                'app_secret' => $this->appSecret,
                'default_graph_version' => 'v5.0',
            ));
        } catch (Exception $e){
            print_r($e);
            exit;
        }

        return $this;
    }

    public function loginUrl($url) {
        $helper = $this->fb->getRedirectLoginHelper();
        $permissions = (!empty($this->permissions)) ? $this->permissions : ['pages_manage_posts,pages_read_engagement,pages_manage_engagement,publish_to_groups,pages_show_list,instagram_basic,instagram_content_publish'];
        $loginUrl = $helper->getLoginUrl($url, $permissions);

        return $loginUrl;
    }

    public function instagramUrl($url) {
        $helper = $this->fb->getRedirectLoginHelper();
        $permissions = (!empty($this->permissions)) ? $this->permissions : ['instagram_basic,pages_show_list'];
        $loginUrl = $helper->getLoginUrl($url, $permissions);

        return $loginUrl;
    }

    function getUserAccessToken($url){
        $helper = $this->fb->getRedirectLoginHelper();
        try {
            $accessToken = $helper->getAccessToken($url);
            return $accessToken->getValue();
        } catch (Exception $e) {
            print_r($e->getMessage());
            exit;
        }
    }

    function getLoginUser($fields = 'name,id'){
        return $this->fetchGet('/me?fields='.$fields);
    }

    function setAccessToken($access_token){
        $this->fb->setDefaultAccessToken($access_token);
        $this->accessToken = $access_token;
    }

    function fetchAccessToken($pid){
        $response = $this->fetchGet('/'.$pid.'/?fields=access_token');
        if(is_object($response)){
            return $response->access_token;
        }else{
            return false;
        }
    }

    function getGroups($admin = false){
        $result = $this->fetchGet('/me/groups?fields=id,icon,name,description,email,privacy,cover'.($admin?"&admin_only=true":"").'&limit=10000');
        if(is_string($result)){
            $result = $this->fetchGet('/me/groups?fields=id,icon,name,description,email,privacy,cover'.($admin?"&admin_only=true":"").'&limit=3');
        }
        return $result;
    }

    public function getPages() {
        $result = $this->fetchGet('/me/accounts?fields=id,name,single_line_address,phone,emails,website,fan_count,link,is_verified,about,picture,category&limit=10000');
        if(is_string($result)){
            $result = $this->fetchGet('/me/accounts?fields=id,name,single_line_address,phone,emails,website,fan_count,link,is_verified,about,picture,category&limit=3');
        }
        return $result;
    }

    public function fetchGet($params, $app_version = null){
        try {
            $response = $this->fb->get($params, null, null, $app_version);
            return json_decode($response->getBody());
        } catch(Facebook\Exceptions\FacebookResponseException $e) {
            return 'Graph returned an error: ' . $e->getMessage();
        } catch(Facebook\Exceptions\FacebookSDKException $e) {
            return 'Facebook SDK returned an error: ' . $e->getMessage();
        }
    }

    public function doLogin($response){
        $response = $response->getResponse()->getBody();
        $response = json_decode($response);

        if(isset($response->error) && $this->accountId != 0 &&
            (
                $response->error->code == 190
                || $response->error->code == 368
                || $response->error->code == 10
            )
        ){
            if ($this->accountId) {
                //Hook::getInstance()->fire('account.disabled', null, array($this->accountId));
                //$this->db->query("UPDATE accounts SET status=? WHERE id=?", 0, $this->accountId);
            }
        }
    }

    public function fetchPost($params, $data){
        try {
            $response = $this->fb->post($params, $data);
            return json_decode($response->getBody());
        } catch(Facebook\Exceptions\FacebookResponseException $e) {
            if ($e->getMessage() == "Missing or invalid image file") return true;
            return false;
        } catch(Facebook\Exceptions\FacebookSDKException $e) {
            return false;
        }
    }

    public function getPageAvatar($page, $generated = false) {
        if (isset($page->picture)) {
            $avatar =  $page->picture->data->url;
            if (!$generated) return $avatar;
            return $this->generateAvatar($avatar);
        }
        return ($generated)  ? 'resources/themes/default/images/social/page.png' : url('resources/themes/default/images/social/page.png');
    }

    public function getGroupAvatar($page, $generated = false) {
        if (isset($page->cover)) {
            $avatar =  $page->cover->source;
            if (!$generated) return $avatar;
            return $this->generateAvatar($avatar);
        }
        return ($generated ) ? 'resources/themes/default/images/social/group.png' : url('resources/themes/default/images/social/group.png');
    }

    public function generateAvatar($avatar) {
        $dir = "uploads/social/picture/".Auth::id().'/';
        if (!is_dir(public_path($dir))) mkdir(public_path($dir), 0777, true);
        $file = $dir.md5($avatar).'.jpg';
        getFileViaCurl($avatar, $file);
        return $file;
    }

    function getPageAccessToken($sid){
        $response = $this->fetchGet('/'.$sid.'/?fields=access_token');
        if(is_object($response)){
            return $response->access_token;
        }else{
            return false;
        }
    }

    public function getPageInstagram($page) {
        $accessToken = $this->getPageAccessToken($page);
        $response = $this->fb->get("/".$page.'?fields=instagram_business_account', $accessToken, null,null);
        return json_decode($response->getBody(), true);
    }
    public function getInstagramDetails($id) {
        $response = $this->fetchGet("/".$id.'?fields=id%2Cusername%2Cname%2Cprofile_picture_url%2Cig_id');
        return $response;
    }

}
