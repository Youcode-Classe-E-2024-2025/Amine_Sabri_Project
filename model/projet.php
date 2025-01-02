<?php
    require_once __DIR__ . '/../config/Database.php';

    class Projet{
        private $db;


        public function __construct(){
            $database = new Database();
            $this->db = $database->getConnection();
        }

        public function create($name, $description, $userId, $visibility, $userIds) {
            try {
                $sql = "INSERT INTO projects (name, description, created_by, visibility) VALUES (?, ?, ?, ?)";
                $stmt = $this->db->prepare($sql);
                $stmt->execute([$name, $description, $userId, $visibility]);

                $projectId = $this->db->lastInsertId();
                $sqlUsers = "INSERT INTO project_user (project_id, user_id) VALUES (?, ?)";
                $stmtUsers = $this->db->prepare($sqlUsers);
        
                foreach ($userIds as $user) {
                    $stmtUsers->execute([$projectId, $user]);
                }
                return true;
            } catch (Exception $e) {
                return $e->getMessage();
            }
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
                return true;
        }
        

        public function delete($id){
            $sql =" DELETE FROM projects WHERE id = ?";
            $test = $this->db->prepare($sql);
            $delete = $test->execute([
                $id
            ]);

            if($delete){
                return $delete;
            }else{
                echo "projet n'est pas supprimer";
            }
        }

        public static function getAllProjet(){
            $database = new Database();
            $db = $database->getConnection();
            $sql = "SELECT * FROM projects";
            $test = $db->query($sql);
            $projet = $test->fetchAll(PDO::FETCH_ASSOC);
            return $projet;
        }

        public function getProjet($id){
            $sql = "SELECT * FROM projects u  WHERE id = ?";
            $stmt = $this->db->prepare($sql);
            $stmt->execute([$id]);
            return $stmt->fetch(PDO::FETCH_ASSOC);
        }
    }



    $project = new Projet();
    // $project->create("Nouveau Projet" , "Ceci est un projet test" , 1 , "public", [2, 3, 4]);


    // $name = "Project Name";
    // $description = "Updated Description";
    // $createdBy = 1;
    // $visibility = "public";
    // $id_projet = 1; 
    // $userIds = [16, 4, 5]; 
    // $project->update($name, $description, $createdBy, $visibility, $id_projet, $userIds);


    // $project->delete(10);
?>