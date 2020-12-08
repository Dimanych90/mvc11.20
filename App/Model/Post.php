<?php


namespace App\Model;


use Base\Model;

class Post extends Model
{
    protected array $data;

    protected int  $id;

    protected static string $table = 'post';

    public static function postList()
    {
        $postList = self::selectAllForPost();
        $ret = [];
        foreach ($postList as $post) {
            $postList = new self();
            $postList->data = $post;
            $postList->id = $postList->data['id'];
            $ret[] = $postList;
        }
//        var_dump($ret); die();
        return $ret;
    }
}