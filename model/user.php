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

    public function signIn($email,$password){
        $sql = "SELECT * FROM users WHERE email = ?";
        $test = $this->db->prepare($sql);
        $test->execute([$email]);
        $user = $test->fetch(PDO::FETCH_ASSOC);
        
        $_SESSION["username"] = $user["name"];
        $_SESSION["user_id"] = $user["id"];

        if ($user) {
            if (password_verify($password, $user['password'])) {
                echo "Connexion réussie!";
                return $user;
            } else {
                echo "Mot de passe incorrect.";
                return false;
            }
        } else {
            echo "Utilisateur non trouvé.";
            return false;
        }
    }

    public static function getAll() {
        $database = new Database();
        $db = $database->getConnection();
        $sql = "SELECT * FROM users";
        $test = $db->query($sql);
        $users = $test->fetchAll(PDO::FETCH_ASSOC);
        return $users;
    }
}

// $insert = new User();
// $insert->signUp("user","user@gmail.com","123456");
// $insert->signIn("user@gmail.com","123456");


?>