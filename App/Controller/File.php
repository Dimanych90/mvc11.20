<?php


namespace App\Controller;


use Base\Controller;
use Base\Session;
use Base\View;

class File extends Controller
{
    public $view;

    public function uploadAction()
    {

//        var_dump($_FILES);

        if (!empty($_FILES['file']['name'])) {
            $file = new \App\Model\File();
            $file->set($_FILES['file']['name'], 'filename');
            $file->set($_FILES['file']['size'], 'size');
            $file->set(date("H:i:s, d:m:Y"), 'upload_at');
            $file->set(Session::getUserId(), 'user_id');
            $file->save();
            \App\Model\File::uploadFiles($_FILES['file']['tmp_name']);
            $file->fileId();
            $file->update('users', $file->fileId(), $file->get('user_id'));
            $this->redirect("../post/post");
        }elseif (empty($_FILES['file']['name'])){
            $this->redirect("../post/post");
        }
    }


    public function listAction()
    {
        $listFile = \App\Model\File::fileList();
        $this->view->render("../file/filelist.phtml", ["files" => $listFile]);
    }
}