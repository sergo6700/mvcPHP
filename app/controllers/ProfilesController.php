<?php


namespace app\controllers;


use app\models\Profiles;
use app\models\User;

class ProfilesController extends AppController
{
    private $profilesModel;
    private $userModel;
    public function __construct($route)
    {
        parent::__construct($route);
        $this->profilesModel = new Profiles();
        $this->userModel = new User();
        $this->layout = false;

    }

    public function profilesAction(){
        $user_info = $_SESSION['user'];
        $this->layout = 'main';
        $user = $this->userModel;
        $friends = $this->profilesModel->AllUsers($user_info['id'],1);
        $friendRequest = $this->profilesModel->AllUsers($user_info['id'], 0);
        $isFriend = [];
        $reqFriends = [];
        foreach($friends as $key) {
            $isFriend[$key['id']] = $key;
        }
        foreach ($friendRequest as $key){
            $reqFriends[$key['id']] = $key;
        }
        $friend = [
            'friends'    =>  $isFriend,
            'request'    =>  $reqFriends
        ];
        $info = $user->findAll('users');
        $this->set($info, $friend);
    }


    public function viewProfileAction(){
        $this->layout = 'main';
        $this->view = 'otherUser';
        $user = $this->userModel;
        $profile = $this->profilesModel;
        if ($_SESSION['user']['id'] == $_GET['id']){
            redirected('/user/myPage');
        }
        $portfolio = $user->portfolio($_GET['id']);

        $info = $user->otherUserInfo($_GET['id']);
        $friends = $profile->AllUsers($_GET['id'], 1);
        $request = $profile->AllUsers($_GET['id'], 0);
        $friendRequest = [];
        foreach ($request as $key){
            $friendRequest[$key['id']] = $key;
        }
        $story = $user->myStories($_GET['id']);
        $data =[
            'friends' => $friends,
            'story' => $story,
            'portfolio' => $portfolio,
            'request' => $friendRequest,
        ];
        $this->set($info[0], $data);
    }



}