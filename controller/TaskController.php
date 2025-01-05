<?php
require_once '../model/Task.php';


class TaskController{
    public function createTask(){
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $project_id = $_POST['project_id'];
            $task_name = $_POST['name'];
            $status = $_POST['status'];
            $assigned_to = $_POST['create_by'];
            $userIds = $_POST['assignUsers'];
            $tagIds = $_POST['assignTags'];
            $category_name = $_POST['category'];

            $taskModel = new Task();
            $task = $taskModel->create($project_id, $task_name, $status, $assigned_to, $userIds, $tagIds, $category_name);

            if($task){
                header('Location: ../views/layouts/todo.php');
            }

            // echo '<pre>';
            // print_r([$project_id, $task_name, $status,$assigned_to, $userIds, $tagIds, $category_name]);
            // echo '</pre>';
            
        }
    }


    public function updateTaskStatus(){
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $taskId = $_POST['taskId'];
            $status = $_POST['status'];

            $taskModel = new Task();
            $task = $taskModel->updateStatustask($status,$taskId);

            if($task){
                header('Location: ../views/layouts/todo.php');
            }else{
                "error de modification status task";
            }


        }
    }

    
}

$crete = new TaskController();
$crete->createTask();
?>