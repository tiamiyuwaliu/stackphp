<?php
namespace Tiktok\API;

use GuzzleHttp\Psr7\Uri;

class Client {
    /**
     * API version
     */
    private $version = '1.0';

    /**
     * API credentials
     */
    private $clientKey;
    private $clientSecret;

    /**
     * Guzzle client
     */
    private $client;

    /**
     * Tiktok access token
     */
    private $accessToken;

    /**
     * Tiktok base urls
     */
    private $authorizedUrl = 'https://www.tiktok.com/auth/authorize/';

    /**
     * Create a new Tiktok API instance
     * @param string $clientKey
     * @param string $clientSecret
     * @param string $accessToken
     */
    public function __construct($clientKey = null, $clientSecret = null, $accessToken = null) {
        $this->client = new \GuzzleHttp\Client([
            'allow_redirects' => false
        ]);
        $this->clientKey = $clientKey;
        $this->clientSecret = $clientSecret;

        if ($accessToken) $this->setToken($accessToken);
    }

    /**
     * Set the access token
     * @param string $accessToken
     */
    public function setToken(string $accessToken) {
        $this->accessToken = $accessToken;
    }

    /**
     * Generate the authorization url
     *
     * @param string $redirect_uri
     * @return string
     */
    public function authorizedURL(string $redirect_uri, $scope = null) {
        $data = [
            'client_key' => $this->clientKey,
            'redirect_url' =>$redirect_uri,
            'state' => time(),
            'response_type' => 'code'
        ];

        $uri = new Uri($this->authorizedUrl);
        $uri = $uri->withQuery(http_build_query($data));
        return $uri;
    }
}
