<?php
require_once 'model/Task.php';
require_once 'core/Auth.php';
require 'vendor/autoload.php';
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;


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
        $isPermission->checkPerm('update_task');
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

    public function exportTasks()
    {
        $taskModel = new Task();
        $tasks = $taskModel->getTasks();


        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        $sheet->setCellValue('A1', 'Nom de la Tâche');
        $sheet->setCellValue('B1', 'Statut');
        $sheet->setCellValue('C1', 'Assigné à');
        $sheet->setCellValue('D1', 'Date de Création');

        $row = 2;
        foreach ($tasks as $task) {
            $sheet->setCellValue('A' . $row, $task['task_name']);
            $sheet->setCellValue('B' . $row, ucfirst(str_replace('_', ' ', $task['status'])));
            $sheet->setCellValue('C' . $row, $task['assigned_user'] ?? 'Non Assigné');
            $sheet->setCellValue('D' . $row, $task['created_at']);
            $row++;
        }

        $sheet->getStyle('A1:D1')->getFont()->setBold(true);
        $sheet->getStyle('A1:D1')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

        $writer = new Xlsx($spreadsheet);
        $filename = 'tasks_export.xlsx';
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="' . $filename . '"');
        $writer->save('php://output');
        exit;
    }


    public function destroy() {
        $isPermission = new Auth();
        $isPermission->checkPerm('delete_task');
        
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if (isset($_POST['taskId'])) {
                $taskId = $_POST['taskId'];
                $taskModel = new Task();
                $result = $taskModel->delete($taskId);
                
                if ($result === true) {
                    header("Location: " . $_SERVER['HTTP_REFERER']);
                    exit;
                } else {
                    echo "Erreur: " . $result;
                }
            }
        }
    }
    
}

// $crete = new TaskController();
// $crete->createTask();
?>