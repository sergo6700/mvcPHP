<?php


namespace app\models;


use system\core\base\Model;
use system\libs\Session;

class Main extends Model{

    public function __construct(){
        parent::__construct();
    }

    public function insertUser(array $arr, $confirm){
        $confirmUniq = "SELECT email FROM `users` WHERE `email` = '$confirm'";
        $emailUnique = $this->query($confirmUniq);
        if (count($emailUnique) > 0){
            return false;
        }
        else{
            $sql = "INSERT INTO `users`(`name`, `email`, `tel`, `password`,`user_dir`, `image`, `backImage`, `isEmailVerified`, `token`, `status`) VALUES (:name, :email, :tel, :password, :user_dir, :image, :backImage,:isEmailVerified, :token, :status)";
            $this->queryExecute($sql,$arr);
            return true;
        }

    }

    public  function checkLogin(array $checkLogin){
        $sql = "SELECT * FROM `users` WHERE `email` = :email AND `password` = :password AND `isEmailVerified` = 1";
        $count = $this->queryExecute($sql, $checkLogin);
        if (empty($count)){
            return false;
        }
        else {
            $_SESSION['email'] = $checkLogin[':email'];
            $_SESSION['password'] = $checkLogin[':password'];
            return true;
        }
    }
    public function confirm($data){
        $sql = "SELECT id FROM users WHERE email = :email AND token = :token AND isEmailVerified = 0";
        $res = $this->queryExecute($sql, $data);
        if (is_null($res)){
            redirected(base_url());
            return false;
        }
        $id = $res[0]['id'];
        if (!is_null($id)){
            $update = "UPDATE `users` SET isEmailVerified = 1 , token = '' WHERE id = $id";
            $this->query($update);
        }
    }


}