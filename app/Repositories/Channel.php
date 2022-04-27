<?php
namespace App\Repositories;

use App\Package\Repository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class Channel {
    use Repository;

    public function supportedChannels() {
        return [
            'twitter',
            'facebook',
            'instagram',
            'pinterest',
            'linkedin',
            'tiktok',
            //'youtube',
            'reddit',
            'tumblr',
            'telegram',
        ];
    }

    public function hasChannels($social) {
        return DB::table('channels')
            ->where('userid',Auth::id())
            ->where('social', $social)
            ->where('status', 1)
            ->count();
    }

    public function getLastChannel($social) {
        return DB::table('channels')
            ->where('userid',Auth::id())
            ->where('social', $social)
            ->where('status', 1)
            ->orderBy('id', 'desc')
           ->first();
    }

    public function getChannels($social = null, $type = null, $term = null) {
        $query = DB::table('channels')
            ->where('userid',Auth::id());
        if ($social) $query->where('social', $social);
        if($type) $query->where('social_type', $type);
        if ($term) $query->where('username', 'LIKE', '%'.$term.'%');
        return $query->orderBy('id', 'desc')->get();
    }



    public function find($social, $id) {
        return DB::table('channels')
            ->where('userid', Auth::id())
            ->where('social', $social)
            ->where('social_id', $id)->first();
    }

    public function findById($id) {
        return DB::table('channels')
            ->where('userid', Auth::id())
            ->where('id', $id)
            ->first();
    }

    public function update($id, $data) {
        DB::table('channels')
            ->where('id',$id)
            ->where('userid', Auth::id())
            ->update($data);
    }

    public function save($data) {
        $ext = [
            'social' => '',
            'username' => '',
            'social_id' => '',
            'avatar' => '',
            'social_type' => '',
            'social_token' => '',
            'status' => ''
        ];
        /**
         * @var $social
         * @var $username
         * @var $social_id
         * @var $avatar
         * @var $social_type
         * @var $social_token
         * @var $status
         */
        extract(array_merge($ext, $data));

        if ($channel = $this->find($social, $social_id)) {
            DB::table('channels')
                ->where('id',$channel->id)
                ->update([
                    'social' => $social,
                    'username' => $username,
                    'social_id' => $social_id,
                    'avatar' => $avatar,
                    'social_type' => $social_type,
                    'social_token' => $social_token,
                    'created' => time()
                ]);
        } else {
            DB::table('channels')->insert([
                'userid' => Auth::id(),
                'social' => $social,
                'username' => $username,
                'social_id' => $social_id,
                'avatar' => $avatar,
                'social_type' => $social_type,
                'social_token' => $social_token,
                'status' => $status,
                'created' => time()
            ]);
        }
    }
}
