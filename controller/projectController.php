<?php
    require_once __DIR__ . '/../model/projet.php';

    class ProjetController{
        public function createProject() {
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                session_start();
        
                $name = $_POST["name"];
                $description = $_POST["description"];
                $create_by = $_POST["create_by"];
                $visibility = $_POST["visibility"];
                $assignUsers = $_POST["assignUsers"];
        
                if (empty(trim($name)) || empty(trim($description)) || empty(trim($create_by)) || empty(trim($visibility)) || (is_array($assignUsers) && empty($assignUsers))) {
                    $_SESSION['error'] = "Tous les champs sont obligatoires.";
                    header('Location: ../views/layouts/admin.php');
                    exit;
                }

                $project = new Projet();
                $result = $project->create($name, $description, $create_by, $visibility, $assignUsers);
        
                if ($result === true) {
                    $_SESSION['success'] = "Projet créé avec succès.";
                } else {
                    $_SESSION['error'] = "Erreur lors de la création du projet : " . $result;
                }
        
                header('Location: ../views/layouts/admin.php');
                exit;
            }
        }

        public function deleteProjet(){
            if($_SERVER["REQUEST_METHOD"] == 'GET'){
                if($_GET['id']){
                    $getProjetId = $_GET['id'];
                    $project = new Projet();
                    $deleteProjet = $project->delete($getProjetId);
                    if($deleteProjet){
                        header("Location: ../views/layouts/admin.php");
                    }
                }
            }
        }
    }

    $projet = new ProjetController();
    $projet->createProject();
    $projet->deleteProjet();
?>