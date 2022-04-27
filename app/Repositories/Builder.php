<?php
namespace App\Repositories;

use App\Package\Repository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class Builder {
    use Repository;

    public function availableGradients() {
        return [
            'gradient1' => 'linear-gradient(43deg, #4158D0 0%, #C850C0 46%, #FFCC70 100%)',
            'gradient2' => 'linear-gradient(90deg, #00DBDE 0%, #FC00FF 100%);',
            'gradient3' => 'linear-gradient(0deg, #D9AFD9 0%, #97D9E1 100%);',
            'gradient4' => 'linear-gradient(160deg, #0093E9 0%, #80D0C7 100%);',
            'gradient5' => 'linear-gradient(45deg, #85FFBD 0%, #FFFB7D 100%);',
            'gradient6' => ' linear-gradient(62deg, #FBAB7E 0%, #F7CE68 100%);',
            'gradient7' => 'linear-gradient(135deg, #8BC6EC 0%, #9599E2 100%);',
            'gradient9' => 'linear-gradient(147deg, #FFE53B 0%, #FF2525 74%);',
            'gradient10' => 'linear-gradient(45deg, #FBDA61 0%, #FF5ACD 100%);',
            'gradient11' => 'linear-gradient(225deg, #FF3CAC 0%, #784BA0 50%, #2B86C5 100%);',
            'gradient12' => 'radial-gradient( circle farthest-corner at 10.2% 55.8%,  rgba(252,37,103,1) 0%, rgba(250,38,151,1) 46.2%, rgba(186,8,181,1) 90.1% )',
            'gradient13' => 'linear-gradient(to right, #a8ff78, #78ffd6); ',
            'gradient14' => 'linear-gradient(to right, #1e9600, #fff200, #ff0000);',
            'gradient15' => 'linear-gradient(to right, #355c7d, #6c5b7b, #c06c84);',
        ];
    }

    public function availableFonts() {
        return [
            'arial',
            'verdana',
            'Helvetic',
            'lato',
            'roboto',
            'bellota text',
            'montserrat',
            'comfortaa',
            'lobster',
            'merriweather'
        ];
    }

    public function getAvailableWidgets() {
        $widgets =  [
            'link' => [
                'title' => 'link',
                'icon' => 'bi bi-link-45deg',
                'desc' => 'link-widget-desc',
                'color' => '#1F08C1'
            ],
            'avatar' => [
                'title' => 'avatar',
                'icon' => 'bi bi-person-circle',
                'desc' => 'avatar-widget-desc',
                'color' => '#C813A2'
            ],
            'heading' => [
                'title' => 'heading',
                'icon' => 'bi bi-type-h1',
                'desc' => 'heading-widget-desc',
                'color' => '#2196F3'
            ],
            'paragraph' => [
                'title' => 'paragraph',
                'icon' => 'bi bi-paragraph',
                'desc' => 'paragraph-widget-desc',
                'color' => '#FF9800'
            ],
            'image' => [
                'title' => 'image',
                'icon' => 'bi bi-image',
                'desc' => 'image-widget-desc',
                'color' => '#F44336'
            ],
            'socials' => [
                'title' => 'socials',
                'icon' => 'bi bi-people',
                'desc' => 'socials-widget-desc',
                'color' => '#673AB7',
            ],
            /**'messengers' => [
                'title' => 'messengers',
                'icon' => 'bi bi-chat',
                'desc' => 'messengers-widget-desc',
                'color' => '#673AB7',
            ],**/
            'map' => [
                'title' => 'map',
                'icon' => 'bi bi-geo-alt',
                'desc' => 'map-widget-desc',
                'color' => '#8BC34A'
            ],
            'divider' => [
                'title'  => 'divider',
                'icon'  =>  'bi bi-hr',
                'desc' => 'divider-widget-desc',
                'color' => '#FF5722'
            ],
            /**'working-hours' => [
                'title' => 'working-hours',
                'icon' => 'bi bi-clock-history',
                'desc' => 'working-hours-widget-desc',
                'color' => '#00BCD4'
            ]**/
        ];

        return $widgets;
    }

    public function getWidgetColor($title) {
        $widgets = $this->getAvailableWidgets();
        if(isset($widgets[$title])) return $widgets[$title]['color'];
        return false;
    }

    public function getSocialWidgets() {
        return [
            'telephone',
            'email',
            'whatsapp',
            'facebook-messenger',
            'instagram',
            'twitter',
            'tiktok',
            'youtube-channel',
            'soundcloud',
            'linkedin',
            'spotify',
            'pinterest',
            'snapchat',
        ];
    }

    public function saveWidget($val, $id) {
        $ext = [
            'widget_id' => '',
            'widget_type' => '',
            'widget_icon' => '',
        ];
        /**
         * @var $widget_id
         * @var $widget_type
         * @var $widget_icon
         */
        extract(array_merge($ext, $val));
        $data = perfectSerialize($val);
        if ($widget_id) {
            DB::table('links_block')->where('userid', Auth::id())->where('id', $widget_id)->update([
                'settings' => $data
            ]);
        } else {
            DB::table('links_block')->insert([
                'userid' => Auth::id(),
                'link_id' => $id,
                'block_title' => $widget_type,
                'block_icon' => $widget_icon,
                'settings' => $data
            ]);
        }
    }

    public function addBio($val, $id = null) {
        $ext = [
            'title' => '',
            'type' => '',
            'slug' => '',
        ];
        /**
         * @var $title
         * @var $type
         * @var $slug
         */
        extract(array_merge($ext, $val));

        if($id) {
            DB::table('links')->where('userid', Auth::id())->where('id', $id)->update([
                'title' => $title,
                //'slug' => $slug,
            ]);
        } else {
            if (!$slug) {
                $slug = uniqueKey(10,15);
                while($this->findLinkBySlug($slug)) {
                    $slug = uniqueKey(10,15);
                }
            }
            DB::table('links')->insert([
                'title' => $title,
                'slug' => $slug,
                'userid' => Auth::id(),
                'type' => $type,
                'created_at' => time()
            ]);
        }
        return true;
    }

    public function changeStatus($id, $status) {
        return DB::table('links')->where('userid', Auth::id())->where('id', $id)->update(['status' => $status]);
    }

    public function findLinkBySlug($slug, $id = null) {
        $query = DB::table('links')->where('slug', $slug);
        if ($id) $query->where('id', '!=', $id);
        return $query->first();
    }

    public function getLinks($type) {
        return DB::table('links')->where('userid', Auth::id())->where('type', $type)->orderBy('id', 'desc')->get();
    }

    public function saveLinkSettings($val, $page) {
        $settings = ($page->settings) ? perfectUnserialize($page->settings) : [];
        unset($val['action']);
        $settings = array_merge($settings, $val);
        return DB::table('links')->where('userid', Auth::id())->where('id', $page->id)->update([
            'settings' => perfectSerialize($settings)
        ]);
    }

    public function getWidgets($id) {
        return DB::table('links_block')->where('userid', Auth::id())->where('link_id',$id)->orderBy('block_order', 'ASC')->get();
    }

    public function findWidget($id) {
        return DB::table('links_block')->where('userid', Auth::id())->where('id',$id)->first();
    }

    public function duplicateWidget($id) {
        $widget = $this->findWidget($id);
        return DB::table('links_block')->insert([
            'userid' => Auth::id(),
            'link_id' => $widget->link_id,
            'block_title' => $widget->block_title,
            'block_icon' => $widget->block_icon,
            'settings' => $widget->settings,
        ]);
    }

    public function arrangeWidgets($linkId, $ids) {
        $i = 0;
        foreach($ids as $id) {
            DB::table('links_block')->where('link_id', $linkId)->where('id', $id)->update([
                'block_order' => $i,
            ]);
            $i++;
        }
    }

    public function deleteWidget($id) {
        return DB::table('links_block')->where('userid', Auth::id())->where('id',$id)->delete();
    }

    public function addStats($link) {
        require app_path('Package/browser/vendor/autoload.php');
        $browser = new \Browser();
        $browserName = $browser->getBrowser();
        $platform = $browser->getPlatform();
        $device = ($browser->isMobile()) ? 'mobile' : 'desktop';
        $referral = app('request')->server('referral');
        $referral = ($referral) ? $referral : 'direct';
        $ipInfo  = getIpInfo('Visitor');
        $country = ($ipInfo) ? $ipInfo['country'] : 'unknnown';
        DB::table('links_view')->insert([
            'link_id' => $link->id,
            'ip' => app('request')->getClientIp(),
            'userid' => $link->userid,
            'country' => $country,
            'referral' => $referral,
            'device' => $device,
            'system' => $platform,
            'browser' => $browserName,
            'created_at' => time()
        ]);
    }

    public function countViews($type = 1, $id = null) {
        $query = DB::table('links_view');
        if ($type == 2) $query->distinct();
        $query->where('userid', Auth::id());
        if ($id) $query->where('link_id', $id);
        return $query->count();
    }
}
