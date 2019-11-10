<?php


namespace system\core\base;

use system\core\Db;

abstract class Model{

    protected $pdo;

    public  function __construct(){
        $this->pdo = Db::instance();
    }

    public function execute($sql){
        return $this->execute($sql);
    }

    public function query($sql){
      return  $this->pdo->query($sql);
    }

    public function queryExecute($sql, $arr = []){
        $info = $this->pdo->queryExecute($sql, $arr);

        return $info;

    }
    public function findAll($table){
        $sql = "SELECT * FROM {$table}";
        return $this->query($sql);
    }
}