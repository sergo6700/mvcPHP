<?php


namespace app\controllers;


use app\models\Messages;

class MessagesController extends AppController
{
    private $messagesModel;
    public function __construct($route)
    {
        parent::__construct($route);
        $this->layout = false;
        $this->messagesModel = new Messages();
    }

    public function insertAction(){
        $output = '';
        $data = [
            ':to_user'       =>      getPost('to_user_id'),
            ':from_user'    =>      $_SESSION['user']['id'],
            ':message'      =>      getPost('chat_message'),
            ':data'         =>      date("Y-m-d H:i:s")
        ];
        $this->messagesModel->insertMessages($data);
        $this->messagesModel->user_chat_history($_SESSION['user']['id'], getPost('to_user_id'));
    }

    public function chatHistoryAction(){
        echo $this->messagesModel->user_chat_history($_SESSION['user']['id'],getPost('to_user_id'));
    }

}
