<?php
namespace App\Http\Controllers;

use App\Repositories\Channel;
use App\Repositories\Social\FacebookSocial;
use App\Repositories\Social\LinkedinSocial;
use App\Repositories\Social\RedditSocial;
use App\Repositories\Social\TiktokSocial;
use App\Repositories\Social\TumblrSocial;
use App\Repositories\Social\TwitterSocial;
use Illuminate\Http\Request;

class ChannelController extends Controller {

    public function __construct()
    {
        parent::__construct();
        $this->setActiveMenu('channels');
        $this->setTitle(__('messages.social-channels'));
    }

    public function index(Request $request) {
        $this->setTitle(__('messages.social-channels'));

        if ($val = $request->input('val')) {
            if ($val['action'] == 'toggle-channel-status') {
                Channel::repository()->update($val['id'],[
                    'status' => $val['status']
                ]);
            }
        }

        if($action = $request->input('action')) {
            if ($action == 'search-channel') {
                return view('app/channels/popup/search', ['channels' => Channel::repository()->getChannels(null,null, $request->input('term'))]);
            }
        }
        return $this->render(view('app/channels/index'), true);
    }

    public function facebook(Request $request) {
        session_start();
        if ($auth = $request->input('auth')) {
            $facebook = FacebookSocial::repository();
            return json_encode([
                'type'=> 'normal-url',
                'value' => $facebook->loginUrl(url('channel/facebook'))
            ]);
        }
        if ($code = $request->input('code')) {
            $facebook = FacebookSocial::repository();
            $token = $facebook->getUserAccessToken(url('channel/facebook'));
            if (!$token) return redirect($facebook->loginUrl(url('channel/facebook')));
            $facebook->setAccessToken($token);
            $groups = $facebook->getGroups(true);
            $pages = $facebook->getPages();
            foreach($groups->data as $group) {
                Channel::repository()->save([
                    'social' => 'facebook',
                    'username' => $group->name,
                    'social_id' => $group->id,
                    'avatar' => $facebook->getGroupAvatar($group, true),
                    'social_type' => 'group',
                    'social_token' => $token,
                    'status' => 0
                ]);
            }
            foreach($pages->data as $page) {
                Channel::repository()->save([
                    'social' => 'facebook',
                    'username' => $page->name,
                    'social_id' => $page->id,
                    'avatar' => $facebook->getPageAvatar($page, true),
                    'social_type' => 'page',
                    'social_token' => $token,
                    'status' => 0
                ]);
            }
            return redirect(url('channel/facebook'));
        }
        return $this->render(view('app/channels/facebook', [
            'groups' => Channel::repository()->getChannels('facebook', 'group'),
            'pages' => Channel::repository()->getChannels('facebook', 'page')
        ]), true);
    }

    public function instagram(Request $request) {
        session_start();
        if ($auth = $request->input('auth')) {
            $facebook = FacebookSocial::repository();
            return json_encode([
                'type'=> 'normal-url',
                'value' => $facebook->loginUrl(url('channel/instagram'))
            ]);
        }
        if ($code = $request->input('code')) {
            $facebook = FacebookSocial::repository();
            $token = $facebook->getUserAccessToken(url('channel/instagram'));
            if (!$token) return redirect($facebook->loginUrl(url('channel/instagram')));
            $facebook->setAccessToken($token);
            $pages = json_decode(json_encode($facebook->getPages()), true);
            $instagrams = array();
            foreach($pages['data'] as $page) {
                $pageInstagram = $facebook->getPageInstagram($page['id']);
                if (isset($pageInstagram['instagram_business_account'])){
                    $instagramId = $pageInstagram['instagram_business_account']['id'];
                    $instagramDetail = $facebook->getInstagramDetails($instagramId);
                    $instagrams[] = array(
                        'username' => $instagramDetail->username,
                        'avatar' => (isset($instagramDetail->profile_picture_url)) ? $instagramDetail->profile_picture_url : '',
                        'id' => $instagramId,
                    );
                }
            }
            foreach($instagrams as $instagram) {
                Channel::repository()->save([
                    'social' => 'instagram',
                    'username' => $instagram['username'],
                    'social_id' => $instagram['id'],
                    'avatar' => ($instagram['avatar']) ? $facebook->generateAvatar($instagram['avatar']) : 'resources/themes/default/images/social/instagram.png',
                    'social_token' => $token,
                    'status' => 0
                ]);
            }
            return redirect(url('channel/instagram'));
        }
        return $this->render(view('app/channels/instagram', [
            'channels' => Channel::repository()->getChannels('instagram')
        ]), true);
    }

    public function twitter(Request $request) {
        session_start();
        if ($auth = $request->input('auth')) {
            $twitter = TwitterSocial::repository();
            return json_encode([
                'type' => 'normal-url',
                'value' => $twitter->loginUrl()
            ]);
        }

        if ($verifyIdentifier = $request->input('oauth_verifier')) {
            $twitter = TwitterSocial::repository();
            $twitter->init();
            $accessToken = (object)$twitter->getToken();

            $avatar = $twitter->getAvatar($accessToken->user_id,json_encode($accessToken));
            Channel::repository()->save([
                'social' => 'twitter',
                'username' => $accessToken->screen_name,
                'social_id' => $accessToken->user_id,
                'avatar' => $avatar,
                'social_token' => json_encode($accessToken),
                'status' => 0
            ]);

            return redirect(url('channel/twitter'));
        }
        return $this->render(view('app/channels/twitter', [
            'channels' => Channel::repository()->getChannels('twitter')
        ]), true);
    }

    public function linkedin(Request $request) {
        session_start();
        if ($auth = $request->input('auth')) {
            $linkedin = LinkedinSocial::repository();
            return json_encode(array(
                'type' => 'normal-url',
                'value' => $linkedin->loginUrl()
            ));
        }

        if ($code = $request->input('code')) {
            $linkedin = LinkedinSocial::repository();
            $token = $linkedin->getToken();
            $linkedin->setToken($token);
            $user = (object)$linkedin->getCurrentUser($token);
            //$companies = $linkedin->getCompanies();
            $firstName_param = (array)$user->firstName->localized;
            $lastName_param = (array)$user->lastName->localized;

            $firstName = reset($firstName_param);
            $lastName = reset($lastName_param);
            $fullname = $firstName." ".$lastName;

            Channel::repository()->save([
                'social' => 'linkedin',
                'username' => $fullname,
                'social_id' => $user->id,
                'avatar' => $linkedin->getAvatar($user),
                'social_type' => 'profile',
                'social_token' => $token,
                'status' => 0
            ]);

            try {
                if (config('linkedin-channel-page', false)) {
                    $companies = $linkedin->getCompanies();
                    if(!empty($companies)){
                        foreach ($companies->elements as $company) {
                            $company = (array)$company;
                            $company = $company['organizationalTarget~'];
                            $logo = (array)$company->logoV2;
                            $logo = $logo['original~'];
                            $logo = $logo->elements[0]->identifiers[0]->identifier;
                            Channel::repository()->save([
                                'social' => 'linkedin',
                                'username' => $company->localizedName,
                                'social_id' => $company->id,
                                'avatar' => FacebookSocial::repository()->generateAvatar($logo),
                                'social_type' => 'page',
                                'social_token' => $token,
                                'status' => 0
                            ]);
                        }

                    }
                }
            } catch (Exception $e) {

            }

            return redirect(url('channel/linkedin'));
        }
        return $this->render(view('app/channels/linkedin', [
            'profiles' => Channel::repository()->getChannels('linkedin', 'profile'),
            'pages' => Channel::repository()->getChannels('linkedin', 'page')
        ]), true);
    }

    public function reddit(Request $request) {
        if ($auth = $request->input('auth')) {
            $reddit = RedditSocial::repository();
            return json_encode(array(
                'type' => 'normal-url',
                'value' => $reddit->loginUrl()
            ));
        }

        if ($code = $request->input('code')) {
            $reddit = RedditSocial::repository();
            $data = $reddit->getToken($code);
            // Verify if response is valid
            if ( isset($data['access_token']) ) {
                $token = $data['access_token'];
                $refresh_token = $data['refresh_token'];
                $curl = curl_init('https://oauth.reddit.com/api/v1/me');
                curl_setopt($curl, CURLOPT_HTTPHEADER, array('Authorization: Bearer ' . $token, 'User-Agent: flairbot/1.0 by '));
                curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
                $data = json_decode(curl_exec($curl), true);
                curl_close($curl);
                if ( isset($data['name']) ) {
                    $name = $data['name'];
                    Channel::repository()->save([
                        'social' => 'reddit',
                        'username' => $name,
                        'social_id' => $name,
                        'avatar' => 'resources/themes/default/images/social/reddit.png',
                        'social_token' => json_encode(array('token' => $token, 'refresh' => $refresh_token)),
                        'status' => 0
                    ]);
                }
                return redirect(url('channel/reddit'));

            }
        }
        return $this->render(view('app/channels/reddit', [
            'channels' => Channel::repository()->getChannels('reddit'),
        ]), true);
    }

    public function tumblr(Request $request) {
        if ($auth = $request->input('auth')) {
            $tumblr = TumblrSocial::repository();
            return json_encode(array(
                'type' => 'normal-url',
                'value' => $tumblr->loginUrl()
            ));
        }

        if ($oauthToken = $request->input('oauth_token')) {
            $tumblr = TumblrSocial::repository();
            $verifier = $request->input('oauth_verifier');
            $oldOauthToken = app('session')->get('tumblr_oauth_token');
            $oldOauthTokenSecret = app('session')->get('tumblr_oauth_token_secret');
            $tumblr = $tumblr->init($oldOauthToken, $oldOauthTokenSecret, true);
            $accessToken = $tumblr->getAccessToken($verifier);
            $tumblr = $tumblr->init($accessToken['oauth_token'], $accessToken['oauth_token_secret']);
            $user = $tumblr->getCurrentUser();
            $blogs = $user->blogs;

            foreach($blogs as $blog) {
                Channel::repository()->save([
                    'social' => 'tumblr',
                    'username' => $blog->name,
                    'social_id' => $blog->name,
                    'avatar' => FacebookSocial::repository()->generateAvatar($blog->avatar[0]->url),
                    'social_token' => json_encode($accessToken),
                    'status' => 0
                ]);
            }

            return redirect(url('channel/tumblr'));
        }

        return $this->render(view('app/channels/tumblr', [
            'channels' => Channel::repository()->getChannels('tumblr'),
        ]), true);
    }

    public function telegram(Request $request) {
        if ($val = $request->input('val')) {
            $data = curl_get_content('https://api.telegram.org/bot' . $val['token'] . '/getUpdates');
            $data = json_decode($data);
            if ($data) {
                if (isset($data->result)) {
                    $added = array();
                    foreach ( $data->result as $result ) {
                        $chat_id = null;
                        if (isset($result->channel_post)) {
                            $chat_id = @$result->channel_post->chat->id;
                            $type = 'channel';
                            $title = @$result->channel_post->chat->title;
                        }elseif(isset($result->message)) {
                            $chat_id = @$result->message->chat->id;
                            $type = 'group';
                            $title = @$result->message->chat->title;
                        }

                        if ( $chat_id) {
                            Channel::repository()->save([
                                'social' => 'telegram',
                                'username' => $title,
                                'social_id' => $chat_id,
                                'avatar' => 'resources/themes/default/images/social/telegram.png',
                                'social_token' => $val['token'],
                                'social_type' => $type,
                                'status' => 0
                            ]);
                            $added[] = $chat_id;
                        }

                    }

                    if (count($added) > 0) {
                        return json_encode(array(
                            'type' => 'url',
                            'message' => __('messages.channels-added-success'),
                            'value' => url('accounts/telegram')
                        ));
                    } else {
                        return json_encode(array(
                            'type' => 'error',
                            'message' => __('messages.no-telegram-group-found'),
                        ));
                    }
                } else {
                    return json_encode(array(
                        'type' => 'error',
                        'message' => __('messages.invalid-telegram-api-key'),
                    ));
                }
            }
        }
        return $this->render(view('app/channels/telegram', [
            'channels' => Channel::repository()->getChannels('telegram'),
        ]), true);
    }

    public function tiktok(Request $request) {
        if ($auth = $request->input('auth')) {
            $tiktok = TiktokSocial::repository();
            return json_encode([
                'type' => 'normal-url',
                'value' => $tiktok->loginUrl()
            ]);
        }

        return $this->render(view('app/channels/tiktok', [
            'channels' => Channel::repository()->getChannels('tiktok'),
        ]), true);
    }
}
