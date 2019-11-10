<?php


namespace system\core;


class Db{

    protected $pdo;

    protected static $instance;

    protected function __construct(){
        $db = require ROOT . '/config/config_db.php';
        $options = [
            \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC
        ];
        $this->pdo = new \PDO($db['dsn'], $db['user'], $db['pass'], $options);
    }
    //singleton
    public static function instance(){
        if (self::$instance === null){
            self::$instance = new self;
        }
        return self::$instance;
    }
    //veradardznum e tru kam false
    public  function  execute($sql){
        $stm = $this->pdo->prepare($sql);
        return $stm->execute();
    }

    public function query($sql){
        $stmt = $this->pdo->prepare($sql);
        $res = $stmt->execute();
        if ($res !== false){

            return  $stmt->fetchAll();
        }
        return [];
    }

    public function queryExecute($sql, $arrInfo = []){
        $stm = $this->pdo->prepare($sql);
        $res = $stm->execute($arrInfo);
        if ($res !== false){
            return $stm->fetchAll();
        }
        return [];
    }
}