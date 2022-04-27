<?php
namespace App\Repositories\Social;

use App\Package\Repository;
use Illuminate\Support\Facades\Auth;

class RedditSocial {
    use Repository;

    private $clientId;
    private $clientScret;

    public function __construct()
    {
        $this->clientId = config('reddit-client-id');
        $this->clientScret = config('reddit-client-secret');
    }

    public function loginUrl() {
        $permission = 'save,modposts,identity,edit,read,report,submit';

        // Set url
        $url = 'https://www.reddit.com/api/v1/authorize';

        $code = rand();
        $params = array(
            'response_type' => 'code',
            'client_id' => $this->clientId,
            'redirect_uri' => url('channel/reddit'),
            'scope' => $permission,
            'state' => $code,
            'duration' => 'permanent',
        );

        // Get redirect url
        $url = $url . '?' . urldecode(http_build_query($params));
        return $url;
    }

    public function getToken($code) {
        $curl = curl_init('https://www.reddit.com/api/v1/access_token');
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_USERPWD, $this->clientId . ':' . $this->clientScret);
        curl_setopt(
            $curl,
            CURLOPT_POSTFIELDS,
            array(
                'grant_type' => 'authorization_code',
                'code' => $code,
                'redirect_uri' => url('channel/reddit'),
            )
        );
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);

        // Decode Response
        $data = json_decode(curl_exec($curl), true);
        return $data;
    }
}
