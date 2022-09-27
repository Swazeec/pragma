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

    public function getTaskById($id){
        for($i = 0; $i < count($this->tasks); $i++){
            if($this->tasks[$i]->getId() == $id){
                return $this->tasks[$i]->getId();
            }
        }
        throw new Exception("Cette tâche n'existe pas...");
    }

    public function deleteTask($id){
        // on supprime la tâche de la BDD
        $req = 'DELETE FROM tasks WHERE id = :id';
        $stmt = $this->getBdd()->prepare($req);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $result = $stmt->execute();

        if($result > 0){
            // on supprime la tâche du tableau de tâches
            $mytask = $this->getTaskById($id);
            unset($mytask);
        }
    }

    public function addTaskBd($name, $comments, $dueDate, $priority){
        
        if($dueDate ===""){
            $dueDate = null;
        }
        if($comments ===""){
            $comments = null;
        }

        $req = 'INSERT INTO tasks (name, comments, dueDate, priority_id) VALUES (:name, :comments, :dueDate, :priority) ';
        $stmt = $this->getBdd()->prepare($req);
        $stmt->bindValue(':name', $name, PDO::PARAM_STR);
        $stmt->bindValue(':comments', $comments, PDO::PARAM_STR);
        $stmt->bindValue(':dueDate', $dueDate, PDO::PARAM_STR);
        $stmt->bindValue(':priority', $priority, PDO::PARAM_INT);
        $result = $stmt->execute();
        if($result > 0){
            $t = new Task($this->getBdd()->lastInsertId() ,$name, $comments, $dueDate, $priority, 1);
            $this->addTask($t);
        } else{
            throw new Exception("Impossible d'ajouter cette tâche");
        }
    }

}