<?php

require_once('models/Model.class.php');
require_once('models/User.class.php');

class UserManager extends Model{
    private $user;

    public function getUsers(){
        return $this->users;
    }
    public function getUser(){
        return $this->user;
    }

    public function logInCheck($email, $password){
        $email = htmlspecialchars($email);
        $password = htmlspecialchars($password);

        $req = 'SELECT * from users WHERE email = :email';
        $stmt = $this->getBdd()->prepare($req);
        $stmt->bindValue(':email', $email, PDO::PARAM_STR);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        if($result){
            if(!password_verify($password, $result['password'])){
                throw new Exception('Identifiants invalides');
            } else {
                $u = new User($result['id'], $result['firstname'], $result['lastname'], $result['email'], $result['password']);
                $this->user[] = $u;
                // [$result['firstname'], $result['lastname']];
            }
        } else{
            throw new Exception('Identifiants invalides');
        }
    }
}