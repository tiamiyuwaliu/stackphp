<?php
namespace App\Repositories\Social;

use App\Package\Repository;
use Illuminate\Support\Facades\Auth;
use Tiktok\API\Client;

include app_path('Package/Tiktok/vendor/autoload.php');
class TiktokSocial {
    use Repository;

    private $tiktok;

    public function __construct() {
        $this->tiktok = new Client(config('tiktok-client-id'), config('tiktok-client-secret'));
    }

    public function loginUrl() {
        return $this->tiktok->authorizedURL(url('channel/tiktok'));
    }
}
