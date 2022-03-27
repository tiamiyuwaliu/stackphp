<?php
namespace App\Repositories;

use App\Package\Repository;
use Illuminate\Support\Facades\DB;

class Product {
    use Repository;

    public function getList($type, $limit = 10) {
        return DB::table('products')->where('type', $type)->paginate($limit);
    }

    public function getAllList($type) {
        return DB::table('products')->where('type', $type)->get();
    }

    public function save($val, $id = null) {
        $ext = array(
            'type' => '',
            'product_id' => 0,
            'status' => 1,
            'name' => '',
            'title' => '',
            'sales' => '',
            'version' =>'',
            'demo_link' => '',
            'doc_link' => '',
            'image_1' => '',
            'image_2' => '',
            'price_regular' => '',
            'price_extended' => '',
            'regular_link' => '',
            'extended_link' => '',
            'description' => '',
            'features' => '',
            'changelog' => '',
            'html' => '',
            'date' => '',
            'slug' => ''
        );

        /**
         * @var $name
         * @var $type
         * @var $status
         * @var $title
         * @var $sales
         * @var $version
         * @var $demo_link
         * @var $doc_link
         * @var $image_1
         * @var $image_2
         * @var $price_regular
         * @var $price_extended
         * @var $regular_link
         * @var $extended_link
         * @var $description
         * @var $features
         * @var $changelog
         * @var $html
         * @var $date
         * @var $product_id
         * @var $slug
         */

        extract(array_merge($ext, $val));
        if ($id) {
            $data = [
                'type' => $type,
                'title' =>$title,
                'short_name' => $name,
                'description' => $description,
                'demo_link' => $demo_link,
                'features' => $features,
                'html_content' => $html,
                'price_regular' => $price_regular,
                'price_extended' => $price_extended,
                'link_regular' => $regular_link,
                'link_extended' => $extended_link,
                'changelog'  => $changelog,
                'doc_link' => $doc_link,
                'version'  => $version,
                'sales' => $sales,
                'last_update' => $date,
                'product_id' => $product_id,
                'slug' => $slug
            ];
            if ($image_1) $data['image_1'] = $image_1;
            if ($image_2) $data['image_2'] = $image_2;

            DB::table('products')->where('id', $id)->update($data);
        } else {
            DB::table('products')->insert([
                'type' => $type,
                'title' =>$title,
                'short_name' => $name,
                'description' => $description,
                'demo_link' => $demo_link,
                'image_1' => $image_1,
                'image_2' => $image_2,
                'features' => $features,
                'html_content' => $html,
                'price_regular' => $price_regular,
                'price_extended' => $price_extended,
                'link_regular' => $regular_link,
                'link_extended' => $extended_link,
                'changelog'  => $changelog,
                'doc_link' => $doc_link,
                'version'  => $version,
                'sales' => $sales,
                'last_update' => $date,
                'product_id' => $product_id,
                'slug' => $slug
            ]);
        }

        return true;
    }
}
