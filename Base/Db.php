<?php


namespace Base;


class Db
{
    /** @var \PDO */
    private static $_pdo;

    const DB_USERS = 1;
    const DB_FILE = 2;

    private static $_instance;

    public static function getInstance()
    {
        if (self::$_instance == null) {
            self::$_instance;
        }
        return self::$_instance;
    }

    public static function getConnection()
    {
        $dsn = $_ENV['DSN'];

        $db = $_ENV['DB'];

        $host = $_ENV['HOST'];

        $user = $_ENV['USER'];

        $password = $_ENV['PASSWORD'];

        try {
            self::$_pdo = new \PDO("$dsn:dbname=$db;host=$host", $user, $password);

        } catch (\Exception $e) {
            return $e->getMessage();
        }
        return self::$_pdo;
    }

    public function fetchAll($select, array $data)
    {
//        var_dump($select,$data);die();
        Db::getConnection();
//        var_dump($select);die();
        $pdo = self::$_pdo->prepare($select);

        $res = $pdo->execute($data);

        if (!$res) {
            var_dump($pdo->errorInfo());
        }
        return $pdo->fetchAll(\PDO::FETCH_ASSOC);

    }

    public function fetchOne($select, $data)
    {
       $ret = $this->fetchAll($select,$data);
       return array_pop($ret);
    }

    public function exec($select, array $data)
    {
        Db::getConnection();
//        var_dump($select,$data);die();
        $pdo = self::$_pdo->prepare($select);
        $res = $pdo->execute($data);
        if (!$res) {
            var_dump($pdo->errorInfo());
        }
        $pdo->rowCount();
        return $pdo->fetchAll(\PDO::FETCH_ASSOC);

    }


}