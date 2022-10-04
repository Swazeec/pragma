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

    public function modifyTask($id){
        try {
            $this->taskManager->modifyTask($id, $_POST['modifytaskname'], $_POST['modifycomment'], $_POST['modifydate'], $_POST['modifypriority'], $_POST['modifyState']);
            $_SESSION['alert'] = [
                "type" => "success",
                "msg" => "Tâche modifiée avec succès !"
            ];
            header('Location: '.URL.'toDoList');
        } catch (Exception $e) {
            $_SESSION['alert'] = [
                "type" => "error",
                "msg" => $e->getMessage()
            ];
            header('Location: '.URL.'toDoList');
        }

        
    }
    
    public function filterTaskByState($state){
            switch($state){
                case 'todo':
                    $id = 1;
                    break;
                case 'doing':
                    $id = 2;
                    break;
                case 'done':
                    $id = 3;
                    break;
                case 'archived':
                    $id = 4;
                    break;

                default:
                throw new Exception("La page demandée n'existe pas");
            }
            $this->taskManager->filterTaskByState($id);
            $this->showTasks();
        }

    public function filterTasks(){
        if($_POST['stateFilter'] == 0 && $_POST['priorityFilter'] == 0){
            header('Location: '.URL.'toDoList');
        } elseif($_POST['stateFilter'] != 0 && $_POST['priorityFilter'] == 0){
            $this->taskManager->filterTasksByState($_POST['stateFilter']);
        } elseif($_POST['stateFilter'] == 0 && $_POST['priorityFilter'] != 0){
            $this->taskManager->filterTasksbyPriority($_POST['priorityFilter']);
        } else {
            $this->taskManager->filterTasks($_POST['stateFilter'], $_POST['priorityFilter']);
        }
        $this->showTasks();
    }
}