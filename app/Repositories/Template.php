<?php
namespace App\Repositories;

use App\Package\Repository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class Template {
    use Repository;

    public function save($val, $page, $id = null) {
        $ext = [
           'title' => '',
           'content' => ''
        ];
        /**
         * @var $title
         * @var $content
         */
        extract(array_merge($ext, $val));

        if ($id) {
            DB::table('templates')
                ->where('id', $id)
                ->where('userid', Auth::id())
                ->update([
                    'title' => $title,
                    'content' => $content,
                ]);
        } else {
            DB::table('templates')->insert([
                'type' => $page,
                'userid' => Auth::id(),
                'title' => $title,
                'content' => $content,
                'created' => time()
            ]);
        }
    }

    public function getTemplates($type, $term = null) {
        $query =  DB::table('templates')
            ->where('userid', Auth::id())
            ->where('type', $type);
        if ($term ) $query->where('content', 'LIKE', '%'.$term.'%');
        return $query->orderBy('id', 'DESC')
            ->get();
    }

    public function delete($id) {
        return DB::table('templates')
            ->where('id', $id)
            ->where('userid', Auth::id())
            ->delete();
    }
}
