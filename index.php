<?php
session_start();
require_once('controllers/TasksController.controller.php');
$taskController = new TasksController;

define("URL", str_replace("index.php", "",(isset($_SERVER["HTTPS"]) ? "https": "http")."://$_SERVER[HTTP_HOST]$_SERVER[PHP_SELF]"));

try {
    if(empty($_GET['page'])){
        require_once 'views/toDoList.php';
        $taskController->showTasks();

    } else {
        $url = explode('/', filter_var($_GET['page']), FILTER_SANITIZE_URL);
        switch($url[0]){
            case "toDoList":
                if(empty($url[1])){
                    $taskController->showTasks();
                } else if ($url[1] === 's'){
                    $taskController->deleteTask($url[2]);
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