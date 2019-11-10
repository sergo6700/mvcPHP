<?php

namespace app\models;


use system\core\base\Model;

class Messages extends Model{

    public function insertMessages($data){
        $sql = "INSERT INTO `messages`(`from_user`, `to_user`, `message`, `data`) VALUES (:from_user, :to_user, :message, :data)";
        $this->queryExecute($sql, $data);
    }

    public function user_chat_history($from_user, $to_user){
        $sql = "
            SELECT * FROM messages 
            WHERE 
            (from_user = $from_user AND to_user = $to_user) 
            OR 
            (from_user = $to_user AND to_user = $from_user)
            ORDER BY data ASC 
        ";
        $result = $this->query($sql);
        foreach ($result as $row){
            $data = time_elapsed_string($row['data']);
            if($row['from_user'] == $from_user){
                $user = $this->userInfo($from_user)[0];
                $output = "
                <div class='right-message row'>
                    <div class='alert alert-danger text-right  col-10' role='alert'>
                        {$row['message']}
                        <p class='time ml-2 mt-1 '>$data</p>
                    </div>
                    <div class='col-2'>
                        <img src='{$user['user_dir']}{$user['image']}' width='30'>
                    </div>
                </div>
                ";
            }
            else{
                $user = $this->userInfo($to_user)[0];
                $output = "
                <div class='left-message row'>
                    <div class='col-2'>
                        <img src='{$user['user_dir']}{$user['image']}' width='30'>
                    </div>
                    <div class='alert alert-dark col-10' role='alert'>
                        {$row['message']}
                       <p class='time  '>{$data}</p>

                    </div>
                </div>
                ";
            }
            echo $output;
        }
    }
    private function userInfo($id){
        $sql = "SELECT user_dir, image FROM users WHERE id = $id";
         return $this->query($sql);
    }
}