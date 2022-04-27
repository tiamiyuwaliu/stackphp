<?php
namespace App\Repositories\Social;

use App\Package\Repository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

include app_path('Package/twitteroauth/autoload.php');

class TwitterSocial {
    use Repository;

    private $consumerKey;
    private $consumerSecret;
    public $twitter;
    private $accountId = null;

    public function __construct()
    {
        $this->consumerKey = config('twitter-consumer-key');
        $this->consumerSecret = config('twitter-consumer-secret');

    }

    public function init() {
        try {
            $oauthToken = app('session')->get('twiter.oauth.token');
            $oauthTokenSecret =  app('session')->get('twiter.oauth.secret');
            $this->twitter = new \Abraham\TwitterOAuth\TwitterOAuth($this->consumerKey, $this->consumerSecret, $oauthToken, $oauthTokenSecret);
        } catch (\Exception $e) {
            $this->twitter = new \Abraham\TwitterOAuth\TwitterOAuth($this->consumerKey, $this->consumerSecret);
        }
        return $this;
    }

    public function loginUrl($url = 'channel/twitter') {
        try {
            $this->init();
            $outhToken = (object) $this->twitter->oauth('oauth/request_token', ['oauth_callback' => url($url)]);
            app('session')->put('twiter.oauth.token', $outhToken->oauth_token);
            app('session')->put('twiter.oauth.secret', $outhToken->oauth_token_secret);
            $url = $this->twitter->url("oauth/authorize", ["oauth_token" => $outhToken->oauth_token]);
            return $url;
        } catch (\Exception $e) {

            print_r($e->getMessage());
            app('session')->forget('twiter.oauth.token');
            app('session')->forget('twiter.oauth.secret');
        }
    }

    function getToken(){
        try {
            app('session')->forget('twiter.oauth.token');
            app('session')->forget('twiter.oauth.secret');
            $accessToken = $this->twitter->oauth("oauth/access_token", ["oauth_verifier" => app('request')->input("oauth_verifier")]);
            return $accessToken;
        } catch (\Exception $e) {
            redirect(url('channel/twitter', array('auth' => true)));
        }
    }

    function setToken($token){
        $token = json_decode($token);
        $this->twitter->setOauthToken($token->oauth_token, $token->oauth_token_secret);
    }

    function getAvatar($name, $token) {

        try {
            $this->setToken($token);
            $user = $this->twitter->get('users/show', array('user_id' => $name));

            $avatar = $user->profile_image_url_https;

            $dir = "uploads/social/picture/".Auth::id().'/';
            if (!is_dir(public_path($dir))) mkdir(public_path($dir), 0777, true);
            $file = $dir.md5($avatar).'.jpg';
            getFileViaCurl($avatar, $file);
            return $file;
        } catch (\Exception $e){}

        return 'resources/themes/default/images/social/twitter.png';
    }

    function userInfo(){
        return $this->twitter->get("account/verify_credentials", ["include_email" => 'true']);
    }

    function doLogin($response){
        if(isset($response->errors) &&
            (
                $response->errors[0]->code == 89
                || $response->errors[0]->code == 135
                || $response->errors[0]->code == 64
                || $response->errors[0]->code == 63
                || $response->errors[0]->code == 50
                || $response->errors[0]->code == 32
            )
        ){
            if ($this->accountId) {

            }
        }
    }
}
