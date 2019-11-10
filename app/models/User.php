<?php

namespace app\models;
use system\core\base\Model;
class User extends Model{

    public function __construct(){
        parent::__construct();
    }

    public function userInfo(array $info){

        $sql = "SELECT * FROM `users` WHERE `email` = :email AND `password` = :password";
        $user_info = $this->queryExecute($sql, $info);
        return $user_info;

    }

    public function otherUserInfo($id){
        $sql = "SELECT * FROM `users` WHERE id = $id";
        $user_info = $this->query($sql);
        return $user_info;
    }



    public function userStory(array $arr){
        $sql = "INSERT INTO `stories`( `user_id`, `title`, `story`, `created`) VALUES (:user_id, :title, :story, :created)";
        $story = $this->queryExecute($sql, $arr);
        return $story;
    }

    public function userStoryPage($id){
        $sql = "SELECT users.image, users.user_dir, users.name, stories.title, stories.created, stories.story FROM stories
                LEFT JOIN users  ON stories.user_id = users.id    
                INNER JOIN friends ON 
                    CASE
                        WHEN friends.from_user = $id   AND friends.status = 1 THEN friends.to_user   = users.id 
                        WHEN friends.to_user   = $id   AND friends.status = 1 THEN friends.from_user = users.id 
                        ELSE NULL
                    END
                 ";
        $stories = $this->query($sql);
        return $stories;
    }

    public function myStories($id){
        $sql = "SELECT stories.* , users.name, users.image, users.user_dir FROM stories
            LEFT JOIN users ON 
                users.id = stories.user_id
            WHERE user_id = $id";
        return $this->query($sql);
    }

    public function portfolio($id){
        $sql = "SELECT * FROM dirs WHERE user_id = $id";
        return $this->query($sql);
    }




    public function friendRequest( $from_id, $to_id){
            $sql = "INSERT INTO `friends`(`from_user`, `to_user`,`status`) VALUES ($from_id, $to_id, 0)";
            $friend = $this->query($sql);
            if(!is_null($friend)){
                return true;
            }else{
                return false;
            }


    }

    public function statusFriend($id){
        $sql = "UPDATE `friends` SET status = 1 WHERE from_user = $id";
        $this->query($sql);
    }

    public function statusRequest($id){
        $sql = "SELECT * FROM friends WHERE status = 0";
        return $this->query($sql);
    }

    public function insertPath(array $data){
        $sql = "INSERT INTO `dirs`(`user_id`, `path`) VALUES (:user_id, :path)";
        $this->queryExecute($sql,$data);
    }

    public function saveImage($id, $image){
        $sql = "UPDATE `users` SET backImage = '$image' WHERE id = $id";
        $this->query($sql);
    }

    public function deleteFriend($id, $status){
        $sql = "DELETE FROM `friends` WHERE (from_user = $id OR to_user = $id) AND status = $status";
        $this->query($sql);
        redirected('/user/home');
    }

}