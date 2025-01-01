<?php
    require_once __DIR__ . '/../config/Database.php';

    class Projet{
        private $db;


        public function __construct(){
            $database = new Database();
            $this->db = $database->getConnection();
        }

        public function create($name, $description, $userId, $visibility, $userIds) {
            $sql = "INSERT INTO projects (name, description, created_by, visibility) VALUES (?, ?, ?, ?)";
            $stmt = $this->db->prepare($sql);
            $stmt->execute([$name, $description, $userId, $visibility]);
            $projectId = $this->db->lastInsertId();
            $sqlUsers = "INSERT INTO project_user (project_id, user_id) VALUES (?, ?)";
            $stmtUsers = $this->db->prepare($sqlUsers);
            foreach ($userIds as $user) {
                $stmtUsers->execute([$projectId, $user]);
            }
            echo "Project create";
        }
    }

?>