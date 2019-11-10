<?php


namespace app\models;


use system\core\base\Model;

class Search extends Model{

    public function __construct(){
        parent::__construct();
    }


    public function search($data){
        $sql = "SELECT * FROM users WHERE name LIKE '%{$data}%'";
        return $this->query($sql);
    }

}