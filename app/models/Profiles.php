<?php


namespace app\models;


use system\core\base\Model;

class Profiles extends Model
{
    public function __construct(){
        parent::__construct();
    }
    public function AllUsers($id,$status){
        $sql = "
            SELECT users.id, users.name, users.user_dir, users.image, friends.from_user FROM friends
                INNER JOIN users ON 
                    CASE
                        WHEN friends.from_user   = $id  AND friends.status = 0 THEN friends.to_user = users.id
                        WHEN friends.to_user     = $id  AND friends.status = 0 THEN friends.from_user = users.id
                        WHEN friends.from_user   = $id  AND friends.status = 1 THEN friends.to_user = users.id
                        WHEN friends.to_user     = $id  AND friends.status = 1 THEN friends.from_user = users.id
                    END  WHERE friends.status = $status
                    ORDER BY users.id
        ";
        $friends = $this->query($sql);
        return $friends;
    }
}