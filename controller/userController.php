<?php
    require_once __DIR__ .'/../model/user.php';

    class UserController{
        public function create(){
            if($_SERVER["REQUEST_METHOD"] == "POST"){
                $name = $_POST["name"];
                $email = $_POST["email"];
                $password = $_POST["password"];

                if(empty(trim($name)) || empty(trim($name)) || empty(trim($password))){
                    echo "rempli les inputs";
                    return ;
                }
                $userModel = new User();
                $UserRegester = $userModel->signUp($name,$email,$password);
                if($UserRegester){
                    echo 'bienvenue to login';
                }else{
                    echo 'back to signUp';
                }

            }
        }
    }

$user = new UserController();
$user->create();
?>