<?php
namespace App\Repositories;

use App\Package\Repository;
use Illuminate\Support\Facades\DB;

class Pages  {
    use Repository;

    public function add($val) {
        $ext = [
            'type' => '',
            'url' => '',
            'title' => '',
            'content' => '',
            'position' => '',
            'order' => ''
        ];
        /**
         * @var $type
         * @var $url
         * @var $title
         * @var $content
         * @var $position
         * @var $order
         */
        extract(array_merge($ext, $val));
        return DB::table('pages')->insert([
            'page_type' => $type,
            'page_slug' => $url,
            'page_title' => $title,
            'page_content' => $content,
            'position' => $position,
            'page_order' => $order
        ]);
    }

    public function save($val, $id) {
        $ext = [
            'type' => '',
            'url' => '',
            'title' => '',
            'content' => '',
            'position' => '',
            'order' => ''
        ];
        /**
         * @var $type
         * @var $url
         * @var $title
         * @var $content
         * @var $position
         * @var $order
         */
        extract(array_merge($ext, $val));
        return DB::table('pages')->where('id', $id)->update([
            'page_type' => $type,
            'page_slug' => $url,
            'page_title' => $title,
            'page_content' => $content,
            'position' => $position,
            'page_order' => $order
        ]);
    }

    public function getPages($position = 0) {
        return DB::table('pages')->where('position', $position)->orderBy('page_order', 'asc')->get();
    }

    public function getAllPages() {
        return DB::table('pages')->paginate(20);
    }

    public function delete($id) {
        return DB::table('pages')->where('id', $id)->delete();
    }
}
