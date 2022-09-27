<?php

class task{
    private $id;
    private $name;
    private $comments;
    private $dueDate;
    private $priority;
    private $state;

    public function __construct($id, $name, $comments, $dueDate, $priority, $state)
    {
        $this->id = $id;
        $this->name = $name;
        $this->comments = $comments;
        $this->dueDate = $dueDate;
        $this->priority = $priority;
        $this->state = $state;
    }

    public function getId(){return $this->id;}
    public function setId($id){$this->id = $id;}

    public function getName(){return $this->name;}
    public function setName($name){$this->name = $name;}

    public function getComments(){return $this->comments;}
    public function setComments($comments){$this->comments = $comments;}

    public function getDueDate(){return $this->dueDate;}
    public function setDueDate($dueDate){$this->dueDate = $dueDate;}

    public function getPriority(){return $this->priority;}
    public function setPriority($priority){$this->priority = $priority;}

    public function getState(){return $this->state;}
    public function setState($state){$this->state = $state;}
    
}