<?php


class Migration extends \PDO {

    public function __construct() {
        $username = 'sergey';
        $password = '1234';

        parent::__construct('mysql:dbname=myMvc;host=127.0.0.1', $username, $password);
    }

    public function createDB($name){
        $query = "CREATE DATABASE {$name} CHARACTER SET utf8 COLLATE utf8_general_ci;";
        $this->query($query);
    }

    public function create($tableName, $param){
        $query = "CREATE TABLE IF NOT EXISTS {$tableName}({$param}) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;";
        $this->query($query);
    }

    public function primaryKeys($tableName, $column){
        $query = "ALTER TABLE {$tableName} {$column})";
        $this->query($query);
    }

    public function autoIncrement($tableName, $column){
        $query = "ALTER TABLE {$tableName} MODIFY `$column` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=104;";
        $this->query($query);
    }

    public function insertInto($tableName, $param){
        $query = "INSERT INTO {$tableName} {$param}";
        $this->query($query);
    }

    public function foreignKey($tableName, $params){
        $query = "ALTER TABLE $tableName $params";
        $this->query($query);
    }

    public function drop($tablename){
        $query = "DROP TABLE {$tablename}";
        $this->query($query);
    }

}