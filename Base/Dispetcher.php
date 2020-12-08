<?php


namespace Base;


use App\Controller\Index;
use App\Controller\User;

class Dispetcher
{

    protected $controller;
    protected $action;

    public function dispatch()
    {

        $routes = [
            '/user/register'=> [User::class,'registerAction'] ,
            '/login' => [User::class, 'registerAction'],
            '/register' => [User::class, 'registerAction'],
            '/' => [User::class, 'registerAction']
        ];
        if (isset($routes[$_SERVER["REQUEST_URI"]])) {
//            var_dump($routes[$_SERVER["REQUEST_URI"]][0]);die();
            $this->controller = ucfirst($routes[$_SERVER["REQUEST_URI"]][0] ?? Index::class);
            $this->action = $routes[$_SERVER["REQUEST_URI"]][1] ?? 'indexAction';
        } elseif (empty($routes[$_SERVER["REQUEST_URI"]])) {
            $parts = explode('/', $_SERVER['REQUEST_URI']);
            $this->controller = "App\\Controller\\" . ucfirst($parts[1] ?? Index::class);
            $this->action = $parts[2] . 'Action'  ?? 'indexAction';
        }
        return $this;

    }

    /**
     * @return mixed
     */
    public function getController()
    {
        return $this->controller;
    }

    /**
     * @return mixed
     */
    public function getAction()
    {
        return $this->action;
    }


}