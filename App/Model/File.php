<?php


namespace App\Model;


use Base\Model;

class File extends Model
{

    protected array $data;

    protected int $user_id;

    protected static string $table = 'files';

    protected int $id;

    public static function uploadFiles($filename)
    {

        if ($filename) {
            $dir = 'photos/' . $_FILES['file']['name'];
            move_uploaded_file($filename, $dir);
        }
    }

    public function fileId()
    {
       $ret = self::selectOne();
       return $ret['id'];
    }

    public static function fileList()
    {
        $files = self::selectAll();

        $ret = [];
        foreach ($files as $file) {
            $files = new self();
            $files->id = $file['id'];
            $files->data = $file;
            $ret[] = $files;
        }
        return $ret;
    }


}