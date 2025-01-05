<?php
include_once __DIR__ . '/controller/userController.php';

if(isset($_GET['action'])){
    $action = $_GET['action'];
    switch($action){
        case 'signUp':
            $user = new UserController();
            $user->create();
    }
}
?>