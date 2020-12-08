<?php


namespace App\Model;


use Base\Db;
use Base\Model;
use Base\Session;

class User extends Model
{
    protected array $data;
    protected int $id;
    /** @var string $table */
    protected static string $table = 'users';


    public function setBirthdate($birth_date)
    {
        $this->set($birth_date, 'birth_date');
        return $this;
    }

    public function photo_id($photo_id)
    {
        $this->set($photo_id, 'photo_id');
        return $this;
    }

    public function setName($name)
    {
        $this->set($name, 'name');
        return $this;
    }

    public function iSet($data)
    {
        $this->data = $data;
        return $this;
    }

    public function setPassword($password)
    {
        $this->set($password, 'password');
        return $this;
    }

    public function setId()
    {
        $this->data['id'] = $this->id;
        return $this;
    }


    public function getImage($userid)
    {
        $ret = self::chooseAll($userid);
        if ($ret == true) {
            return "../../../photos/" . $ret['filename'];
        } else {
            return null;
        }
    }


    public static function getList()
    {
        $users = self::selectAll();

        $ret = [];

        foreach ($users as $user) {
            $users = new self();
            $users->id = $user['id'];
            $users->data = $user;
            $ret[] = $users;
        }

        return $ret;
    }

}