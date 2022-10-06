<?php
require_once('models/UserManager.class.php');

class UserController {
    private $userManager;

    public function __construct()
    {
        $this->userManager = new UserManager;
    }

    public function showLogInForm(){
        require_once('views/login.php');
    }

    public function login(){
        try{
            $this->userManager->logInCheck($_POST['email'], $_POST['password']);
            $user=$this->userManager->getUser();
            $_SESSION['connect'] = "userConnected";
            $_SESSION['alert'] = [
                "type" => "success",
                "msg" => "Bonjour ".$user[0]->getFirstname()
            ];
            header('location:'.URL.'toDoList');
        } catch(Exception $e){
            $_SESSION['alert'] = [
                "type" => "error",
                "msg" => $e->getMessage()
            ];
            header('Location: '.URL.'login');
        }
    }

    public function logout(){
        session_start();
        session_unset();
        session_destroy();
        header('Location: '.URL);
        exit();
    }
}