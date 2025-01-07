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
                header("Location: views/sign/signIn.php");
                exit;
            } else {
                header("Location: views/sign/signUp.php");
                exit;
            }
        }
    }

    public function connexion() {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            session_start();
            if (!isset($_POST['csrf_token']) || !hash_equals($_SESSION['csrf_token'], $_POST['csrf_token'])) {
                die("CSRF token invalide.");
            }

            $email = htmlspecialchars($_POST["email"], ENT_QUOTES, 'UTF-8');
            $password = htmlspecialchars($_POST["password"], ENT_QUOTES, 'UTF-8');

            if (empty(trim($email)) || empty(trim($password))) {
                echo "Remplis tous les champs.";
                return;
            }

            $userModel = new User();
            $user = $userModel->signIn($email, $password);
            if ($user) {    
                if($user['role_id'] == '1'){
                    header("Location: views/layouts/admin.php");
                }elseif($user['role_id'] == '3'){
                    header("Location: views/layouts/user.php");
                }else{
                    echo 'not found';
                }
            } else {
                header("Location: views/sign/signIn.php");
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
