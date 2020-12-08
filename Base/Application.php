<?php

namespace Base;

use Dotenv\Dotenv;

class Application
{

    public function ini()
    {
      $dotenv = Dotenv::createImmutable(__DIR__.'../../');
      $dotenv->load();

     $session = new Session();
     Session::getInstance();
    }

    public function run()
    {
        $this->ini();


        $dispetcher = new Dispetcher();

        $dispetcher->dispatch();


        $controllerName = $dispetcher->getController();

        $controller = new $controllerName;

        $action = $dispetcher->getAction();

        $view = new View();

        $controller->view = $view;

        $view->setTplPath(__DIR__ . '/..' . "\\App\\view\\user");


        $controller->$action();
    }
}