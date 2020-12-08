<?php


namespace Base;


abstract class Controller
{
    public $user;

    protected $view;

    /**
     * @param mixed $view
     */
    public function setView($view): void
    {
        $this->view = $view;
    }

    public function redirect($url)
    {
        header("location:". $url);
    }
}