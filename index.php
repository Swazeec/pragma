<?php
session_start();
require_once('controllers/TasksController.controller.php');
require_once('controllers/UsersController.controller.php');
$taskController = new TasksController;
$userController = new UserController;

define("URL", str_replace("index.php", "",(isset($_SERVER["HTTPS"]) ? "https": "http")."://$_SERVER[HTTP_HOST]$_SERVER[PHP_SELF]"));

try {
    if(empty($_GET['page'])){
        if(!empty($_SESSION['connect'] ) && $_SESSION['connect'] === 'userConnected'){
            $taskController->showTasks();   
        } else {
            $userController->showLogInForm();
        } 
    } else {
        $url = explode('/', filter_var($_GET['page']), FILTER_SANITIZE_URL);
        switch($url[0]){
            case "toDoList":
                if(!empty($_SESSION['connect'] ) && $_SESSION['connect'] === 'userConnected'){
                    if(empty($url[1])){
                        $taskController->showTasks();
                    } else if ($url[1] === 's'){
                        $taskController->deleteTask($url[2]);
                    }  else if ($url[1] === 'a'){
                        $taskController->addTask();
                    } else if ($url[1] === 'm'){
                        $taskController->modifyTask($url[2]);
                    } else if($url[1] === 'f'){
                        $taskController->filterTasks();
                    } else {
                        throw new Exception("La page que vous demandez n'existe pas...");
                    }
                } else {
                    header('location:'.URL);
                }
                break;

            case 'logout':
                $userController->logout();
                break;

            case 'login':
                if(!empty($_SESSION['connect'] ) && $_SESSION['connect'] === 'userConnected'){
                    header('location:'.URL);
                } else {
                    if(empty($url[1])){
                        $userController->showLogInForm();
                    } elseif($url[1] === 'li'){
                        $userController->login();
                    }else {
                        throw new Exception("oups...");
                    }
                }
                break;

            default:
                throw new Exception("La page que vous demandez n'existe pas...");
        }
    
}

} catch (Exception $e) {
    $msg = $e->getMessage();
    require('views/error.php');
}
