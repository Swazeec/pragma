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
        $req = 'SELECT id, name, comments, DATE_FORMAT(dueDate, "%d/%m/%Y") AS dueDate, priority_id, state_id from tasks';
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

    public function nameValidation($value){
        $name = htmlspecialchars($value);
        // Jusqu'à 150 caractères en BD
        // Tous les caractères sont autorisés
        if(strlen($name) == 0 || strlen($name) > 150 || $name === true || $name === false){
            return false;
        }
        return $name;
    }

    public function commentsValidation($value){
        $comments = htmlspecialchars($value);
        // Jusqu'à 150 caractères en BD
        // Tous les caractères sont autorisés
        if($comments === true || $comments === false){
            return false;
        } elseif($comments ===""){
            $comments = null;
        }
        return $comments;
    }

    public function dateValidation($value){
        $dueDate = htmlspecialchars($value);
        if($dueDate !== ''){
            $dateToCompare = new DateTime($dueDate);
            $today = new DateTime();
            if($dateToCompare < $today || $dateToCompare === true || $dateToCompare === false){
                return false;
            } 
        } else {
            $dueDate = null;
        }
        return $dueDate;
    }

    public function priorityValidation($value){
        $priority = intval(htmlspecialchars($value));
        if($priority !== 1 && $priority !== 2 && $priority !== 3){
            return false;
        }
        return $priority;
    }

    public function addTaskBd($name, $comments, $dueDate, $priority){

        $comments = $this->commentsValidation($comments);
        $name = $this->nameValidation($name);
        $dueDate = $this->dateValidation($dueDate);
        $priority = $this->priorityValidation($priority);

        if($name !== false && $comments !== false && $dueDate !== false && $priority !== false){

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
        } else {
            throw new Exception("Une erreur est survenue lors de l'ajout de votre tâche, veuillez réessayer");
        } 

    }

}