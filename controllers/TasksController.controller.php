<?php
require_once('models/taskManager.class.php');

class TasksController{
    private $taskManager;

    public function __construct()
    {
        $this->taskManager = new TaskManager;
        $this->taskManager->loadTasks();
    }

    public function showTasks(){
        $tasks = $this->taskManager->getTasks();
        require_once 'views/toDoList.php';
    }

    public function deleteTask($id){
        try{
            $this->taskManager->deleteTask($id);
            $_SESSION['alert'] = [
                "type" => "success",
                "msg" => "Tâche supprimée avec succès !"
            ];
            header('Location: '.URL.'toDoList');
        } catch(Exception $e) {
            $_SESSION['alert'] = [
                "type" => "error",
                "msg" => "Impossible de supprimer cette tâche..."
            ];
            header('Location: '.URL.'toDoList');
        }
    }

    public function addTask(){
        try{
            $this->taskManager->addTaskBd($_POST['taskname'],$_POST['comment'],$_POST['date'],$_POST['priority']);
        $_SESSION['alert'] = [
            "type" => "success",
            "msg" => "Tâche ajoutée avec succès !"
        ];
        header('Location: '.URL.'toDoList');
        } catch(Exception $e){
            $_SESSION['alert'] = [
                "type" => "error",
                "msg" => $e->getMessage()
            ];
            header('Location: '.URL.'toDoList');
        }
    }
}