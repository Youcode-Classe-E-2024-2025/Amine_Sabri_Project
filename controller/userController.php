<?php
require_once __DIR__ . '/../model/user.php';

class UserController {
    public function create() {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $name = $_POST["name"];
            $email = $_POST["email"];
            $password = $_POST["password"];

            if (empty(trim($name)) || empty(trim($email)) || empty(trim($password))) {
                echo "Remplis tous les champs.";
                return;
            }

            $userModel = new User();
            $UserRegistered = $userModel->signUp($name, $email, $password);

            if ($UserRegistered) {
                header("Location: ../views/sign/signIn.html");
                exit;
            } else {
                header("Location: ../views/sign/signUp.html");
                exit;
            }
        }
    }

    public function connexion() {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $email = $_POST["email"];
            $password = $_POST["password"];

            if (empty(trim($email)) || empty(trim($password))) {
                echo "Remplis tous les champs.";
                return;
            }

            $userModel = new User();
            $user = $userModel->signIn($email, $password);
            if ($user) {    
                if($user['role'] == 'user'){
                    header("Location: ../views/layouts/user.php");
                }elseif($user['role'] == 'admin'){
                    header("../views/layouts/admin.php");
                }else{
                    header("Location: ../index.php");
                }
            } else {
                header("Location: ../views/sign/signIn.html");
                exit;
            }
        }
    }
}

// $user = new UserController();
// if (isset($_POST['action']) && $_POST['action'] === 'signup') {
//     $user->create();
// } elseif (isset($_POST['action']) && $_POST['action'] === 'signin') {
//     $user->connexion();
// }
?>
