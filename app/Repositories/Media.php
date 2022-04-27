<?php
namespace App\Repositories;

use App\Package\Repository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class Media {
    use Repository;

    public function add($path, $thumb = null, $type = null) {
        DB::table('media')->insert([
            'userid' => Auth::id(),
            'path' => $path,
            'thumbnail' => $thumb,
            'type' => $type
        ]);
        return true;
    }

    public function getMedias($term = null, $offset = 0, $limit = 20) {
        $medias = DB::table('media')->where('userid', Auth::id());
        if ($term) $medias->where('description', 'like', '%'.$term.'%');
        return $medias->orderBy('id', 'desc')->offset($offset)->limit($limit)->get();
    }

    public function delete($id) {
        DB::table('media')->where('userid', Auth::id())->where('id', $id)->delete();
        return false;
    }
}
