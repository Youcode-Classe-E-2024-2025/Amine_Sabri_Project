<?php
    require_once __DIR__ . '/../model/projet.php';

    class ProjetController{
        public function createProject(){
            if($_SERVER["REQUEST_METHOD"] == "POST"){
                $name = $_POST["name"];
                $description = $_POST["description"];
                $create_by = $_POST["create_by"];
                $visibility = $_POST["visibility"];
                $assignUsers = $_POST["assignUsers"];

                if(empty(trim($name)) || empty(trim($description)) || empty(trim($create_by)) || empty(trim($visibility)) || (is_array($assignUsers) && empty($assignUsers))) {
                    echo "Remplir les inputs";
                    return;
                }                

                $project = new Projet();
                $createPrj = $project->create($name,$description,$create_by,$visibility,$assignUsers);
                if($createPrj){
                    header('Location: ../views/layouts/admin.php');
                }else{
                    echo "problem created Projet";
                }
            }
        }
    }

    // $projet = new ProjetController();
    // $projet->createProject();
?>