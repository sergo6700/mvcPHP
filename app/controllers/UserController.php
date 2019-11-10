<?php


namespace app\controllers;


use app\models\Profiles;
use app\models\User;
use system\libs\Session;
class UserController extends AppController {

    private $userModel;
    private $profilesModel;


    public function __construct($route)
    {
        parent::__construct($route);
        $this->userModel = new User();
        $this->profilesModel = new Profiles();
        $this->layout = false;
    }

    public function indexAction(){
        $this->layout = 'login';
    }

    public function homeAction(){
        $user = $this->userModel;
        $data = [
            ':email' => Session::get('email'),
            ':password' => Session::get('password')
        ];
        $user_info = $user->userInfo($data);
        $infoUser = $user_info[0];
        $_SESSION['user'] = $infoUser;
        $stories = $user->userStoryPage($infoUser['id']);
        $myStories = $user->myStories($infoUser['id']);
        $suggestions = $this->profilesModel->AllUsers($infoUser['id'],0);
        $request = [];
        foreach ($suggestions as $key){
            $request[$key['from_user']] = $key;
        }
        $friends = $this->profilesModel->AllUsers($infoUser['id'],1);
        
        $info = [
            'story'      =>  $stories,
            'sugestions' =>  $request,
            'friends'    =>  $friends,
            'mystories'  => $myStories
        ];
        $this->layout = 'main';
        $this->set($infoUser, $info);
        $this->view = 'main';
    }

    public function postAction(){
        $story = $this->userModel;
        $data = [
            ':user_id' => getPost('id'),
            ':title'   => getPost('title'),
            ':story'   => getPost('story'),
            ':created' => date("Y-m-d H:i:s"),
        ];
        $story->userStory($data);
        redirected(base_url(). '/user/home');
    }



    public function friendAction(){
        $from   = $_GET['from'];
        $to     = $_GET['to'];
        $friend_request =  $this->userModel->friendRequest($from, $to);
        if ($friend_request){
            $_SESSION['add_friend_'.$to] =  $to;
        }
        redirected('/profiles/profiles');
    }

    public function addFriendAction(){
        $user = $_GET['id'];
        $this->userModel->statusFriend($user);
        unset($_SESSION['add_friend']);
        redirected('/user/home');
    }

    public function deleteSuggestionAction(){
        $id = $_GET['id'];
        $this->userModel->deleteFriend($id, 0);
    }

    public function deleteFriendAction(){
        $id = $_GET['id'];
        $this->userModel->deleteFriend($id, 1);
    }


    public function uploadFileAction(){
        $user = $this->userModel;
        $id = $_GET['id'];
        $data[':user_id'] = $id;
        $target_dir =  $_GET['dir'];
        $target_file =  '.'. $target_dir . basename($_FILES["user_image"]["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo( '.'.$target_file,PATHINFO_EXTENSION));
        if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
            && $imageFileType != "gif" ) {
            $uploadOk = 0;
        }
        if ($uploadOk == 0) {
            echo "Sorry, your file was not uploaded.";
        } else {
            if (move_uploaded_file($_FILES["user_image"]["tmp_name"], $target_file)) {
                $data[':path'] = $target_dir. $_FILES['user_image']['name'];
            } else {
                echo "Sorry, there was an error uploading your file.";
            }
        }
        $user->insertPath($data);
        redirected('/user/myPage');


    }

    public function myPageAction(){
        $this->layout = 'main';
        $this->view = 'myProfile';
        $user = $this->userModel;
        $data = [
            ':email' => Session::get('email'),
            ':password' => Session::get('password')
        ];
        $user_info = $user->userInfo($data);
        $infoUser = $user_info[0];
        $portfolio = $user->portfolio($infoUser['id']);
        $friends = $this->profilesModel->AllUsers($infoUser['id'], 1);
        $story = $user->myStories($infoUser['id']);
        $data =[
            'friends' => $friends,
            'story' => $story,
            'portfolio' => $portfolio
        ];
        $this->set($infoUser, $data);
    }

    public function saveBackImageAction(){
        $id = $_GET['id'];
        $image = parse_url($_GET['src'], PHP_URL_PATH);
        $this->userModel->saveImage($id, $image);
        redirected('/user/myPage');
    }
}