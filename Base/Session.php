<?php


namespace Base;


use App\Model\User;

class Session
{

    const USER_ID = 'user_id';
    const USER_IP = 'ip';
    const USER_MACHINE = 'machine';

    private static $_instance;

    /**
     * @return mixed
     */
    public static function getInstance()
    {
        if (!self::$_instance) {
            self::$_instance;
        }
        return self::$_instance;
    }

    /**
     * Session constructor.
     */
    public function __construct()
    {
        session_start();
    }

    public function getuserIp()
    {
        return $_SERVER["REMOTE_ADDR"];
    }

    public function getUserMachine()
    {
        return $_SERVER["HTTP_USER_AGENT"];
    }


    public static function setUserId($user_id)
    {
         $_SESSION['id'] = $user_id;
          return $_SESSION['id'];;
    }

    public static function getUserId()
    {
        return $_SESSION['id'];
    }

    public function userSafety($user_id)
    {

    }
}
