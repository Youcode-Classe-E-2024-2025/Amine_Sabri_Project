<?php
require_once 'model/Task.php';
require_once 'core/Auth.php';


class TaskController{
    public function createTask(){
        $isPermission = new Auth();
        $isPermission->checkPerm('create_task');
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $project_id = $_POST['project_id'];
            $task_name = $_POST['name'];
            $status = $_POST['status'];
            $assigned_to = $_POST['create_by'];
            $userIds = $_POST['assignUsers'];
            $tagIds = $_POST['assignTags'];
            $category_name = $_POST['category'];
            $_SESSION['projet_id'] = $project_id ;

            $taskModel = new Task();
            $task = $taskModel->create($project_id, $task_name, $status, $assigned_to, $userIds, $tagIds, $category_name);

            if($task){
                header('Location: views/layouts/todo.php?id='. $project_id );
            }

            // echo '<pre>';
            // print_r([$project_id, $task_name, $status,$assigned_to, $userIds, $tagIds, $category_name]);
            // echo '</pre>';
            
        }
    }


    public function updateTaskStatus(){
        $isPermission = new Auth();
        $isPermission->checkPerm('update_tas');
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $taskId = $_POST['taskId'];
            $status = $_POST['status'];
            $id_projet = $_POST['id_projet'];

            $taskModel = new Task();
            $task = $taskModel->updateStatustask($status,$taskId);

            if($task){
                header('Location: views/layouts/todo.php?id=' . $id_projet);
            }else{
                "error de modification status task";
            }


        }
    }

    
}

// $crete = new TaskController();
// $crete->createTask();
?>