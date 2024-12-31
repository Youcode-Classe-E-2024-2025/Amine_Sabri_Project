<?php
session_start();
require_once __DIR__ . '/../config/Database.php';



class User{
    private $db;
    private $sql;
    private $name;
    private $email;
    private $password;


    public function __construct(){
        $database = new Database();
        $this->db = $database->getConnection();
    }

    public function signUp($name,$email,$password){
        $hashPassword = password_hash($password,PASSWORD_DEFAULT);
        $sql = "INSERT INTO users (name,email,password) VALUES (?,?,?)";
        $test = $this->db->prepare($sql);
        $result = $test->execute([
            $name,
            $email,
            $hashPassword,
        ]);
        if($result){
            echo "insert user";
            return true;
        }else{
            echo "user not found";
            return false;
        }
    }
}

?>