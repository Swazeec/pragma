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
}