<?php
require_once __DIR__ . '/../config/Database.php';

class Task {
    private $db;

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

    public function update($taskId, $task_name, $status, $assigned_to, $userIds, $tagIds, $category_name) {
        try {
            // 1. Update the task details
            $sql = "UPDATE tasks SET name = ?, status = ?, assigned_to = ? WHERE id = ?";
            $stmt = $this->db->prepare($sql);
            $stmt->execute([$task_name, $status, $assigned_to, $taskId]);

            // 2. Delete existing users linked to the task (before inserting the new ones)
            $sqlDeleteUsers = "DELETE FROM user_task WHERE task_id = ?";
            $stmtDeleteUsers = $this->db->prepare($sqlDeleteUsers);
            $stmtDeleteUsers->execute([$taskId]);

            // 3. Add the new users to the task
            $sqlUsers = "INSERT INTO user_task (user_id, task_id) VALUES (?, ?)";
            $stmtUsers = $this->db->prepare($sqlUsers);
            foreach ($userIds as $user) {
                $stmtUsers->execute([$user, $taskId]);
            }

            // 4. Delete existing tags linked to the task (before inserting the new ones)
            $sqlDeleteTags = "DELETE FROM task_tag WHERE task_id = ?";
            $stmtDeleteTags = $this->db->prepare($sqlDeleteTags);
            $stmtDeleteTags->execute([$taskId]);

            // 5. Add the new tags to the task
            $sqlTags = "INSERT INTO task_tag (tag_id, task_id) VALUES (?, ?)";
            $stmtTags = $this->db->prepare($sqlTags);
            foreach ($tagIds as $tag) {
                $stmtTags->execute([$tag, $taskId]);
            }

            // 6. Update the category if provided
            if (!empty($category_name)) {
                $sqlCategory = "INSERT INTO category (name, task_id) VALUES (?, ?) ON DUPLICATE KEY UPDATE name = ?";
                $stmtCategory = $this->db->prepare($sqlCategory);
                $stmtCategory->execute([$category_name, $taskId, $category_name]);
            } else {
                // Optionally delete category if no name is provided
                $sqlDeleteCategory = "DELETE FROM category WHERE task_id = ?";
                $stmtDeleteCategory = $this->db->prepare($sqlDeleteCategory);
                $stmtDeleteCategory->execute([$taskId]);
            }

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
}



$task = new Task();


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


// Update

// $task = new Task();
// $result = $task->update(4, "Updated Task Name","in_progress", 1, [1, 2, 3], [2, 3], "New Category");

// if ($result === true) {
//     echo "Task updated successfully!";
// } else {
//     echo "Error: " . $result;
// }

?>
