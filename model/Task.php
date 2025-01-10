<?php
require_once __DIR__ . '/../config/Database.php';

class Task {
    private $db;
    private $task_name;
    private  $status;
    private $assigned_to;

    public function __construct() {
        $database = new Database();
        $this->db = $database->getConnection();
    }

    public function create($project_id, $task_name, $status, $assigned_to, $userIds, $tagIds, $category_name) {
        try {
        
            $sql = "INSERT INTO tasks (project_id, name, status, assigned_to, created_at) VALUES (?, ?, ?, ?, NOW())";
            $stmt = $this->db->prepare($sql);
            $stmt->execute([$project_id, $task_name, $status, $assigned_to]);


            $taskId = $this->db->lastInsertId();


            $sqlUsers = "INSERT INTO user_task (user_id, task_id) VALUES (?, ?)";
            $stmtUsers = $this->db->prepare($sqlUsers);
            foreach ($userIds as $user) {
                $stmtUsers->execute([$user, $taskId]);
            }


            $sqlTags = "INSERT INTO task_tag (tag_id, task_id) VALUES (?, ?)";
            $stmtTags = $this->db->prepare($sqlTags);
            foreach ($tagIds as $tag) {
                $stmtTags->execute([$tag, $taskId]);
            }


            if (!empty($category_name)) {
                $sqlCategory = "INSERT INTO category (name, task_id) VALUES (?, ?)";
                $stmtCategory = $this->db->prepare($sqlCategory);
                $stmtCategory->execute([$category_name, $taskId]);
            }

            return true; 
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    public function delete($taskId) {
        try {
            $sqlTask = "DELETE FROM tasks WHERE id = ?";
            $stmtTask = $this->db->prepare($sqlTask);
            $stmtTask->execute([$taskId]);

            return true;
        } catch (Exception $e) {
            return $e->getMessage(); 
        }
    }

    public static function getAllTags(){
        $database = new Database();
        $db = $database->getConnection();

        $sql = 'SELECT * FROM tags';
        $test = $db->query($sql);
        $tags = $test->fetchAll(PDO::FETCH_ASSOC);
        return $tags;
    }

    public static function getAllTask() {
        $database = new Database();
        $db = $database->getConnection(); 
        $sql = '
            SELECT 
                tasks.name AS task_name,
                tasks.status AS task_status,
                GROUP_CONCAT(DISTINCT tags.name SEPARATOR ", ") AS tag_names,
                category.name AS category_name,
                GROUP_CONCAT(DISTINCT users.name SEPARATOR ", ") AS working_users
            FROM tasks
            LEFT JOIN task_tag ON tasks.id = task_tag.task_id
            LEFT JOIN tags ON task_tag.tag_id = tags.id
            LEFT JOIN category ON tasks.id = category.task_id
            LEFT JOIN user_task ON tasks.id = user_task.task_id
            LEFT JOIN users ON user_task.user_id = users.id
            GROUP BY tasks.id, category.name, tasks.status;
        ';
    
        try {
            $stmt = $db->prepare($sql);
            $stmt->execute();
            $tasks = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
            return $tasks;
        } catch (PDOException $e) {
            error_log("Erreur lors de l'exécution de la requête : " . $e->getMessage());
            return [];
        }
    }

    public static function getAllTaskForId($id) {
        $database = new Database();
        $db = $database->getConnection(); 
        $sql = '
            SELECT 
                tasks.id,
                tasks.name AS task_name,
                tasks.status AS task_status,
                GROUP_CONCAT(DISTINCT tags.name SEPARATOR ", ") AS tag_names,
                category.name AS category_name,
                GROUP_CONCAT(DISTINCT users.name SEPARATOR ", ") AS working_users
            FROM tasks
            LEFT JOIN task_tag ON tasks.id = task_tag.task_id
            LEFT JOIN tags ON task_tag.tag_id = tags.id
            LEFT JOIN category ON tasks.id = category.task_id
            LEFT JOIN user_task ON tasks.id = user_task.task_id
            LEFT JOIN users ON user_task.user_id = users.id
            WHERE tasks.project_id = ?
            GROUP BY tasks.id, category.name, tasks.status;
        ';
    
        try {
            $stmt = $db->prepare($sql);
            $stmt->execute([$id]);
            $tasks = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
            return $tasks;
        } catch (PDOException $e) {
            error_log("Erreur lors de l'exécution de la requête : " . $e->getMessage());
            return [];
        }
    }

    public function updateStatustask($status,$idtask){
        $sql = "UPDATE tasks SET status = ? WHERE id = ?" ;
        $test = $this->db->prepare($sql);
        return $test->execute([$status,$idtask]);
    }

    public function getTasks()
    {
        $query = "SELECT t.name AS task_name, t.status, u.name AS assigned_user, t.created_at 
                  FROM tasks t 
                  LEFT JOIN users u ON t.assigned_to = u.id";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


    public static function getUserStatistics($userId)
{
    // Obtenir la connexion PDO depuis la classe Database
    $database = new Database();
    $db = $database->getConnection(); 
    
    $query = "SELECT 
                COUNT(*) AS total_tasks,
                SUM(CASE WHEN status = 'to_do' THEN 1 ELSE 0 END) AS to_do,
                SUM(CASE WHEN status = 'in_progress' THEN 1 ELSE 0 END) AS in_progress,
                SUM(CASE WHEN status = 'done' THEN 1 ELSE 0 END) AS done
              FROM tasks
              WHERE assigned_to = :userId";

    $stmt = $db->prepare($query); // Remplacement de `$this->db` par `$db`
    $stmt->execute(['userId' => $userId]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

}



$task = new Task();
// $task->updateStatustask("done",9);

// $tasks = Task::getAllTask();
// $tasks = Task::getAllTaskForId(4);

// var_dump($tasks);


// create


// $create = $task->create(1, "Test Task for PHP", "to_do", 1, [1, 2, 3], [1, 3], "Development");
// if ($create === true) {
    //     echo "Task created successfully!";
    // } else {
        //     echo "Error: " . $create;
        // }


// delete

// $result = $task->delete(3);
// if ($result === true) {
//     echo "Task and related data deleted successfully!";
// } else {
//     echo "Error: " . $result;
// }


// Update()

$task = new Task();
// $result = $task->update(4, "Updated Task Name","in_progress", 1, [1, 2, 3], [2, 3], "New Category");

// if ($result === true) {
//     echo "Task updated successfully!";
// } else {
//     echo "Error: " . $result;
// }

?>
