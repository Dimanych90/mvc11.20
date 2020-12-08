<?php


namespace Base;

use Base\Db;

class Model
{

    protected array $data;

    /** @var string $table */
    protected static string $table;

    protected int $id;

    public function auth()
    {
        $db = new \Base\Db();
        $keys = implode(',', array_keys($this->data));
        $values_data = array_map(function (&$value) {
            return ":" . $value;
        }, array_keys($this->data));
        $values = implode(',', $values_data);
        $comb = array_combine($values_data, array_values($this->data));
        $table = static::$table;
        $select = "SELECT * FROM $table WHERE `name` = :name AND `password` = :password
 AND `photo_id` = :photo_id AND `birth_date` = :birth_date";
        $res = $db->fetchAll($select, $comb);
        if (empty($res)) {
            $insert = "INSERT INTO users ($keys) VALUES ($values)";
            $db->exec($insert, $comb);
        } elseif ($res) {
            return $res;
        }
        return $res;
    }

    public function authorize()
    {
        $db = new \Base\Db();
        $keys = implode(',', array_keys($this->data));
        $value_keys = array_map(function ($value) {
            return ':' . $value;
        }, array_keys($this->data));
        $values = implode(',', $value_keys);
        $comb = array_combine($value_keys, array_values($this->data));
        $table = static::$table;
        $select = "SELECT * FROM $table WHERE name = :name AND password = :password";
        $res = $db->fetchAll($select, $comb);
        if (empty($res)) {
            header("location:" . 'register');
        } else {
            return $res;
        }
        return $res;
    }

    public function selectId($id)
    {
        $db = new Db();
        $table = static::$table;
        $ret = $db->fetchOne("SELECT * FROM $table WHERE id = $id", []);
        return $ret;
    }

    public function save()
    {
        $db = new Db();
        $keys = implode(',', array_keys($this->data));
        $value_map = array_map(function ($value) {
            return ':' . $value;
        }, array_keys($this->data));
        $values = implode(',', $value_map);
        $comb = array_combine($value_map, array_values($this->data));
        $table = static::$table;
        $insert = "INSERT INTO $table ($keys) VALUES ($values)";
        $res = $db->exec($insert, $comb);
        return $res;
    }

    public static function selectAll()
    {
        $table = static::$table;
        $select = "SELECT * FROM $table";
        $db = new \Base\Db();
        $ret = $db->fetchAll($select, []);
        return $ret;
    }

    public static function selectAllForPost()
    {
        $table = static::$table;
        $select = "SELECT * FROM $table ORDER BY id DESC LIMIT 10";
        $db = new \Base\Db();
        $ret = $db->fetchAll($select, []);
        return $ret;
    }

    public static function selectOne()
    {
        $table = static::$table;
        $select = "SELECT * FROM $table";
        $db = new Db();
        $ret = $db->fetchOne($select, []);
        return $ret;
    }

    public static function chooseAll($userid)
    {
        $db = new Db();
        $select = "SELECT * FROM files WHERE user_id = $userid";
        $ret = $db->fetchOne($select, []);
//        var_dump($ret);die();
        return $ret;
    }

    public function update($table, int $fileId, $userId)
    {
        $update = "UPDATE $table SET photo_id = $fileId WHERE id = $userId";
        $db = new Db();
        $ret = $db->fetchAll($update, []);
        return $ret;
    }

    public function get($data)
    {
        return $this->data[$data];
    }


    public function set($data, $value)
    {
        $this->data[$value] = $data;
        return $this;
    }


}