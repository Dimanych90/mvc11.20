<?php


namespace App\Controller;


use Base\Controller;
use Base\Session;

class Post extends Controller
{

    public $view;

    public function postAction()
    {
        $users = \App\Model\User::getList();
//        var_dump($users);
//        $this->view->render("../post/post.phtml", ["users" => $users]);
        $posts = \App\Model\Post::postList();

        $this->view->render("../post/sendPost.phtml", ["posts" => $posts,"users"=>$users]);
    }

    public function sendPostAction()
    {
        if ($_POST['message']) {
            $post = new \App\Model\Post();
            $post->set(Session::getUserId(), 'user_id');
            $message = htmlspecialchars($_POST['message']);
            $post->set($message, 'message');
            $post->set(date("H:i:s,d.M.Y"), 'datetime');
            $post->save();
            $this->postAction();
        }
    }

}