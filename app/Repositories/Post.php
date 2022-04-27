<?php
namespace App\Repositories;

use App\Package\Repository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class Post {
    use Repository;

    public function add($val, $accountId) {
        $ext = [
            'caption' => '',
            'media' => [],
            'post_type' => 0,
            'time' => '',
        ];
        /**
         * @var $caption
         * @var $media
         * @var $post_type
         * @var $time
         */
        extract(array_merge($ext, $val));

        $caption = Emoji::repository()->toShort($caption);
        $media = json_encode($media);
        $channel = Channel::repository()->findById($accountId);
        if (!$channel) return false;


        return DB::table('posts')->insert([
            'userid' => Auth::id(),
            'account' => $accountId,
            'social_type' => $channel->social,
            'caption' => $caption,
            'medias' => $media,
            'schedule_type' => $post_type,
            'schedule_time' => ($time) ? strtotime($time) : time(),
            'status' => ($post_type == 0) ? 2 : 0,
            'timezone' => '',
            'created_at' => time()
        ]);
    }

    public function save($val, $id) {
        $ext = [
            'caption' => '',
            'media' => [],
            'post_type' => 0,
            'time' => '',
        ];
        /**
         * @var $caption
         * @var $media
         * @var $post_type
         * @var $time
         */
        extract(array_merge($ext, $val));

        $caption = Emoji::repository()->toShort($caption);
        $media = json_encode($media);


        return DB::table('posts')->where('userid', Auth::id())->where('id', $id)->update([
            'userid' => Auth::id(),
            'caption' => $caption,
            'medias' => $media,
            'schedule_time' => ($time) ? strtotime($time) : time(),
        ]);
    }

    public function postNow($id) {

    }

    public function getPosts($type,  $limit = 20) {
        $query = DB::table('posts')
            ->where('userid', Auth::id())
            ->where('status', $type);
        if ($limit > 0) {
            return $query->orderBy('id', 'desc')->paginate($limit);
        }
        return $query->orderBy('id', 'desc')->get();

    }

    public function changePostDate($id, $date) {
        return DB::table('posts')->where('id', $id)->where('userid', Auth::id())->update([
            'schedule_time' => strtotime($date)
        ]);
    }

    public function delete($id) {
        return DB::table('posts')->where('id', $id)->where('userid', Auth::id())->delete();
    }

    public function getStatusNumber($type) {
        switch($type) {
            case 'published':
                return 1;
                break;
            case 'unpublished':
                return 3;
                break;
        }
        return 2;
    }

    public function countPosts($type = null) {
        $query =  DB::table('posts');
        if ($type) {
            $query->where('status', $type);
        }
        return $query->where('userid', Auth::id())->count();
    }

    public function testRss($url) {
        $xml = simplexml_load_file($url);
        //$entries = $xml->xpath("//item");
        if ($xml) return true;
        return false;
    }

    public function saveRSS($val, $id = null) {
        $ext = [
            'title' => '',
            'url'  => '',
            'action_type'=> 0,
            'include' => '',
            'exclude' => '',
            'type' => 0,
            'count' => 5,
            'interval' => 1,
            'accounts' => []
        ];
        /**
         * @var $title
         * @var $url
         * @var $action_type
         * @var $include
         * @var $exclude
         * @var $type
         * @var $count
         * @var $interval
         * @var $accounts
         */
        extract(array_merge($ext, $val));

        if ($id) {
            DB::table('rss')->where('userid', Auth::id())->where('id', $id)->update([
                'title' => $title,
                'url' => $url,
                'include' => $include,
                'exclude' => $exclude,
                'accounts' => json_encode($accounts),
                'content_type' => $type,
                'action' => $action_type,
                'check_interval' => $interval,
                'post_count' => $count,
                'check_time' => time()
            ]);
        } else {
            DB::table('rss')->insert([
                'userid' => Auth::id(),
                'title' => $title,
                'url' => $url,
                'action' => $action_type,
                'include' => $include,
                'exclude' => $exclude,
                'accounts' => json_encode($accounts),
                'content_type' => $type,
                'check_interval' => $interval,
                'post_count' => $count,
                'check_time' => time()
            ]);
        }

        return true;
    }

    public function listRSS() {
        return DB::table('rss')->where('userid', Auth::id())->orderBy('id', 'desc')->paginate(15);
    }

    public function changeRssStatus($id, $status) {
        DB::table('rss')->where('id', $id)->where('userid', Auth::id())->update(['status' => $status]);
    }

    public function findRSS($id) {
        return DB::table('rss')->where('id', $id)->where('userid', Auth::id())->first();
    }

    public function getRssPosts($id) {
       return DB::table('rss_posts')->where('rss_id', $id)->where('userid', Auth::id())->orderBy('id', 'desc')->paginate(20);
    }

    public function deleteRSS($id) {
        DB::table('rss')->where('id', $id)->where('userid', Auth::id())->delete();
        return DB::table('rss_posts')->where('rss_id', $id)->where('userid', Auth::id())->delete();
    }

    public function countRssPosts($id, $type = null) {
        $query = DB::table('rss_posts')->where('rss_id', $id)->where('userid', Auth::id());
        if ($type) $query->where('used', $type);
        return $query->count();
    }
}
