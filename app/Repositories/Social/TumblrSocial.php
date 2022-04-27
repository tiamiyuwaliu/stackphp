<?php
namespace App\Repositories\Social;

use App\Package\Repository;

use Illuminate\Support\Facades\Auth;
use Tumblr\API\Client;

require_once  app_path('Package/Tumblr/vendor/autoload.php');
require_once  app_path('Package/Tumblr/tumblroauth.php');

class TumblrSocial {
    use Repository;

    public function __construct() {
        $this->init(null,null, true);
    }

    public function init($oauthToken = null, $oauthTokenSecret = null, $old  = false) {
        if (!$old) {
            $this->tumblr = new Client(config('tumblr-client-id'), config('tumblr-client-secret'));
            if ($oauthToken) {
                $this->tumblr->setToken($oauthToken, $oauthTokenSecret);
            }
        } else {
            $this->tumblr = new \TumblrOAuth(config('tumblr-client-id'), config('tumblr-client-secret'), $oauthToken, $oauthTokenSecret);

        }

        return $this;
    }

    public function loginUrl() {
        $this->token = $this->tumblr->getRequestToken(url('channel/tumblr'));
        app('session')->put('tumblr_oauth_token', $this->token['oauth_token']);
        app('session')->put('tumblr_oauth_token_secret', $this->token['oauth_token_secret']);
        return $this->tumblr->getAuthorizeURL($this->token, false);
    }

    public function getAccessToken($verifier) {
        return $this->token = $this->tumblr->getAccessToken($verifier);
    }

    public function setToken($token) {
        $this->tumblr->setToken($token['oauth_token'], $token['oauth_token_secret']);
        $this->token = $token;
    }
    public function getCurrentUser() {
        return $this->tumblr->getUserInfo()->user;
    }

}
