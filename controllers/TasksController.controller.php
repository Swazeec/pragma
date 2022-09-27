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
}