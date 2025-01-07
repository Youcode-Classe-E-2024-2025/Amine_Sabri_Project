<?php
include_once __DIR__ . '/controller/userController.php';
include_once __DIR__ . '/controller/projectController.php';
include_once __DIR__ . '/controller/TaskController.php';

if (isset($_GET['action'])) {
    $action = $_GET['action'];
    switch ($action) {

        case 'signUp':
            $user = new UserController();
            $user->create();
            break;
        case 'signIn':
            $user = new UserController();
            $user->connexion();
            break;
        case 'updateUser':
            $user = new UserController();
            $user->update();
            break;
        case 'deleteUser':
            $user = new UserController();
            $user->deleteUser();
            break;
        case 'createProjet':
            $projet = new ProjetController();
            $projet->createProject();
            break;

        case 'updateProjet':
            $projet = new ProjetController();
            $projet->upadteProjet(); 
            break;

        case 'deleteProjet':
            $projet = new ProjetController();
            $projet->deleteProjet();
            break;

        case 'createTask':
            $task = new TaskController();
            $task->createTask();
            break;
        case 'updateTaskStatus':
            $task = new TaskController();
            $task->updateTaskStatus();
            break;

        // Uncomment and complete if needed
        // case 'updateTask':
        //     $task = new TaskController();
        //     $task->updateTaskStatus();
        //     break;

        // case 'deleteTask':
        //     $task = new TaskController();
        //     $task->deleteTask();
        //     break;

        default:
            header("Location: ./404.php");
            exit();
    }
} else {
    header("Location: ./views/layouts/guest.php");
    exit();
}
?>
