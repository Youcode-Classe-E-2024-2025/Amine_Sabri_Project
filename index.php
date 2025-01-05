<?php
include_once __DIR__ . '/controller/userController.php';
include_once __DIR__ . '/controller/projectController.php';

if(isset($_GET['action'])){
    $action = $_GET['action'];
    switch($action){
        case 'signUp':
            $user = new UserController();
            $user->create();
        case 'signIn':
            $user = new UserController();
            $user->connexion();
        case 'createProjet':
            $projet = new ProjetController();
            $projet->createProject();
        case 'updateProjet':
            $projet = new ProjetController();
            $projet->upadteProjet();
        case 'deleteProjet':
            $projet = new ProjetController();
            $projet->deleteProjet();
    }
}
?>