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
        $sql = "SELECT u.*, r.name AS role_name FROM users u JOIN roles r ON r.id = u.role_id"; 
        $test = $db->query($sql);
        $users = $test->fetchAll(PDO::FETCH_ASSOC);
        return $users;
    }
    public static function getUserParId($id) {
        $database = new Database();
        $db = $database->getConnection();
        $sql = "SELECT * FROM users WHERE id = :id";
        $stmt = $db->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        return $user;
    }

    public function UpdateUser($id, $name, $email, $password, $role_id) {
        $hashPassword = password_hash($password, PASSWORD_DEFAULT);
        $sql = "UPDATE users SET name = ?, email = ?, role_id = ?, password = ? WHERE id = ?";
        try {
            $stmt = $this->db->prepare($sql);
            $updateUser = $stmt->execute([
                $name,
                $email,
                $role_id,
                $hashPassword,
                $id
            ]);

            if ($updateUser) {
                echo "Mise à jour réussie.";
                return true;
            } else {
                echo "Échec de la mise à jour.";
                return false;
            }
        } catch (PDOException $e) {
            echo "Erreur lors de la mise à jour de l'utilisateur : " . $e->getMessage();
            return false;
        }
    }

    public function deleteUser($id){
        $sql = 'DELETE FROM users WHERE id = ?';

        try{
            $test = $this->db->prepare($sql);
            $delete = $test->execute([$id]);
            if($delete){
                return true;
            }else{
                return false;
            }
        }catch (PDOException $e) {
            echo "Erreur lors de la supprision de l'utilisateur : " . $e->getMessage();
            return false;
        }
        
    }
    
}

$user = new User();
$user->deleteUser(2);
// $user->UpdateUser(1, 'Amine', 'amine@gmail.com', '123456', 2);
// $insert->signUp("user","user@gmail.com","123456");
// $insert->signIn("user@gmail.com","123456");


?>