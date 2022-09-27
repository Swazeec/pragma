<?php
require_once('models/Model.class.php');
require_once('models/task.class.php');

class TaskManager extends Model{
    private $tasks; // tableau de tâches

    // on ajoute une tâche au tableau de tâches
    public function addTask($task){
        $this->tasks[] = $task;
    }

    // on ajoute les tâches de la BDD dans le tableau de tâches
    public function loadTasks(){
        $req = 'SELECT * from tasks';
        $stmt = $this->getBdd()->prepare($req);
        $stmt->execute();
        $myTasks = $stmt->fetchAll(PDO::FETCH_ASSOC);
        foreach($myTasks as $task){
            $t = new task($task['id'], $task['name'], $task['comments'], $task['dueDate'], $task['priority_id'], $task['state_id']);
            $this->addTask($t);
        }
    }

    public function getTasks(){
        return $this->tasks;
    }

}