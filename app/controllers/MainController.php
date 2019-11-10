<?php
namespace app\controllers;


use app\models\Main;

use app\models\phpmailer\PHPMailer;
use system\libs\Session;

class MainController extends AppController
{

    #ete chem uzum shablon miana grumem $this->layout = false
    #ete grem $this->view = 'orinak test' kmiacni main content test@
    #$this->set(['ppp' => 'fafasdfasf']);  poxancumem popoxakan viewin
    #kam $name = 'sergey'
    #$color = ['white' => 'white', 'black' => 'black']
    #$this->set(compact('name', 'color')
    private $mainModel;
    public function __construct($route)
    {
        parent::__construct($route);
        $this->mainModel = new Main();

    }

    public function indexAction(){
        $this->layout = 'login';
    }

    public function registrationAction(){
        $data = [
            ":name"              =>  NULL,
            ":email"             =>  NULL,
            ":tel"               =>  NULL,
            ":password"          =>  NULL,
            ":image"             =>  NULL,
            ":backImage"         =>  NULL,
            ":isEmailVerified"   =>  NULL,
            ":token"             =>  NULL,
            ":status"            =>  NULL,
        ];

        $token = "affasdfasdfkajdfaoeiAJSDFL;KAJSDFLKJ()()-ajsflkjas*";
        $token = str_shuffle($token);
        $token = substr($token, 0 , 10);
        $data[':token'] = $token;
        $data[':isEmailVerified'] = 0;
        if (isPost()){
            $name = getPost('name');
            $email = getPost('email');
            $tel = getPost('tel'). getPost('number');
            $pass1 = getPost('pass');
            $pass2 = getPost('pass2');
            if(empty($name) || empty($email) || empty($tel) || empty($pass1) || empty($pass2) || $pass1 != $pass2 ){
                $_SESSION['registration_error'] = "Somethings wrong!";
                redirected(base_url());
            }
            else{
                unset($_SESSION['registration_error']);
                $data[':name']      = $name;
                $data[':email']     = $email;
                $data[':tel']       = $tel;
                $data[':password'] = md5($pass1);
                $target_dir = "../public/uploads/{$email}/";
                if (!file_exists($target_dir)) {
                    mkdir($target_dir, 0777, true);
                }
                $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
                $uploadOk = 1;
                $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
// Allow certain file formats
                if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) {
                    $uploadOk = 0;
                }
// Check if $uploadOk is set to 0 by an error
                if ($uploadOk == 0) {
                    $_SESSION['file_upload_error'] = 'Image was not upload!';
                    redirected(base_url());die;
                    // if everything is ok, try to upload file
                } else {
                    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
                        $data[':image'] = $_FILES['fileToUpload']['name'];
                        unset($_SESSION['file_upload_error']);
                    } else {
                        $_SESSION['file_upload_error'] = 'Image was not upload!';
                        redirected(base_url());die;
                    }
                }
                $data[':user_dir'] = "/uploads/{$email}/";
                $data[':image'] = $_FILES['fileToUpload']['name'];
                $data[':status'] = 0;
            }

        }

        $emailConfirm = $this->mainModel->insertUser($data,$email);
        if (!$emailConfirm){
            $_SESSION['email_error'] = "This email is busy!";
            redirected(base_url());die;
        }
        $mail = $data[':email'];
        $name = $data[':name'];


        $email = new PHPMailer();
        $email->IsSMTP();
        $email->SMTPAuth   = true;

        $email->Host       = "smtp.gmail.com";
        $email->Username   = "sergrigoryan98@gmail.com";
        $email->Password   = "+37443184533";
        $email->SMTPSecure = 'tls';
        $email->Port       = 587; //465
        $email->setFrom("seroj6700@gmail.com");
        $email->addAddress($mail, $name);
        $email->Subject = "Please confirm our email!";
        $email->isHTML(true);
        $email->Body = "
                <p>Click  confirm your email!</p><br><br>
                <a href='http://mymvc.com/main/confirm?email={$data[':email']}&token={$data[':token']}'>Click Here</a>        
        ";
        if($email->send()){
            $this->layout = 'confirmemail';
            return true;
        }
        else{
            $_SESSION['email_error'] = "Email confirmation was not send!";
            redirected(base_url());
            return false;
        }
    }

    public function confirmAction(){
        if (!isset($_GET['token']) || !isset($_GET['email'])){
            $_SESSION['email_error'] = "Please confirm your Email!";
            redirected(base_url());
        }
        else{
            unset($_SESSION['email_error']);
            $email = $_GET['email'];
            $token = $_GET['token'];
            $data = [
                ":email" => $email,
                ":token" => $token
            ];
            $user = $this->mainModel;
            $user->confirm($data);
            $_SESSION['email_success'] = "Your email have been successfully confirmed!";
            unset($_SESSION['login_error']);
            redirected(base_url());
        }
    }

    public function loginAction(){
        $user = $this->mainModel;
        $data = [
            ':email' => getPost('email'),
            ':password' => md5(getPost('password'))
        ];

        $userInfo = $user->checkLogin($data);
        if (!$userInfo){
            $_SESSION['login_error'] = "Invalid email or password";
            redirected(base_url());
        }
        else{
            unset($_SESSION['login_error']);
            redirected(base_url(). '/user/home');
        }

    }

    public function logoutAction(){
        Session::destroy();
        redirected(base_url());
    }
}