<?php


namespace App\Controller;


use Base\Controller;
use Base\Db;
use Base\Session;

class User extends Controller
{
    public $view;

    public function registerAction()
    {
        if (!empty($_POST['name'])) {
            $user = new \App\Model\User();
            $user->setName($_POST['name']);
            if (empty($_POST["password"])) {
                $this->redirect('/register');
            } else {
                $user->setPassword(sha1($_POST['password']));
            }
            $user->photo_id(0);
            if (empty($_POST["birth_date"])) {
                $this->redirect("/register");
                die();
            } else {
                $user->setBirthdate($_POST["birth_date"]);
            }
            $user->auth();
            if (!empty($user->auth())) {
                $this->redirect("/user/auth");
            }
        }
        $this->view->render("register.phtml", ['title' => "Registration form"]);
    }

    public function authAction()
    {
        $this->view->render("authorize.phtml", ["title" => "Authorize"]);
    }

    public function authorizeAction()
    {
        if (isset($_POST['name'])) {
            $user = new \App\Model\User();
            $user->setName($_POST['name']);
            $user->setPassword(sha1($_POST['password']));
            $ret = $user->authorize();
            if (!empty($user->authorize())) {
                $user->set($ret[0]['id'], 'id');
                Session::setUserId($user->get('id'));
                $this->redirect("logined");
            }
        }
    }

    public function loginedAction()
    {

        $this->view->render('logined.phtml', ["title" => "Confirmed"]);
    }

    public function listAction()
    {
        $users = \App\Model\User::getList();

        $this->view->render("list.phtml", ["users" => $users]);

    }



}