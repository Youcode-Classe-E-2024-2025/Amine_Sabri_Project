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
        
        
        
        public function update($name, $description, $userId, $visibility, $id_projet, $userIds) {
                $sql = "UPDATE projects SET name = ?, description = ?, created_by = ?, visibility = ? WHERE id = ?";
                $stmt = $this->db->prepare($sql);
                $stmt->execute([$name, $description, $userId, $visibility, $id_projet]);
                $sqlDeleteUsers = "DELETE FROM project_user WHERE project_id = ?";
                $stmtDelete = $this->db->prepare($sqlDeleteUsers);
                $stmtDelete->execute([$id_projet]);
                $sqlUsers = "INSERT INTO project_user (project_id, user_id) VALUES (?, ?)";
                $stmtUsers = $this->db->prepare($sqlUsers);
        
                foreach ($userIds as $user) {
                    $stmtUsers->execute([$id_projet, $user]);
                }
                echo "Project modifier ";
        }
        

        public function delete($id){
            $sql =" DELETE FROM projects WHERE id = ?";
            $test = $this->db->prepare($sql);
            $delete = $test->execute([
                $id
            ]);

            if($delete){
                echo "projet supprimer";
            }else{
                echo "projet n'est pas supprimer";
            }
        }
    }

?>