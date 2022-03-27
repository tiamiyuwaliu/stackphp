<?php
namespace App\Repositories;

use App\Package\Repository;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Blog extends Model {
    use Repository;

    public function getList($limit = 20) {
        return DB::table('blogs')->paginate($limit);
    }

    public function save($val, $id = null) {
        $ext = [
            'title' => '',
            'slug' => '',
            'image_1' => '',
            'image_2' => '',
            'description'  => '',
            'content' => '',
        ];
        /**
         * @var $title
         * @var $slug
         * @var $image_1
         * @var $image_2
         * @var $description
         * @var $content
         */
        extract(array_merge($ext, $val));

        if ($id) {
            $data = [
                'title' => $title,
                'slug' => $slug,
                'description' => $description,
                'content' => $content,
            ];
            if ($image_1) $data['image_1'] = $image_1;
            if ($image_2) $data['image_2'] = $image_2;
            DB::table('blogs')->where('id', $id)->update($data);
        } else {
            DB::table('blogs')->insert([
                'title' => $title,
                'slug' => $slug,
                'description' => $description,
                'content' => $content,
                'created_at' => time(),
                'image_1' => $image_1,
                'image_2' => $image_2
            ]);
        }

        return true;
    }
}
