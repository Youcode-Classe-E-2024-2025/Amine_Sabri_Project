<?php
require '../../vendor/erusev/parsedown/Parsedown.php';
require '../../model/projet.php'; 

$project = new Projet();
$projectId = $_GET['id'] ?? null;

if ($projectId) {
    // var_dump($projectId);
    // Obtenir tous les projets
    $data = $project->getAllProjetss();

    if ($data) {
        // Recherche le projet avec l'ID correspondant
        $projectData = null;
        foreach ($data as $projectItem) {
            if ($projectItem['id'] == $projectId) {
                $projectData = $projectItem;
                break;
            }
        }

        if ($projectData) {
            $parsedown = new Parsedown();
            $readme = $parsedown->text($projectData['description']);
        } else {
            die("Projet introuvable.");
        }
    } else {
        die("Aucun projet disponible.");
    }
} else {
    die("ID du projet manquant.");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>README - <?= htmlspecialchars($projectData['name']) ?></title>
    <script src="https://cdn.tailwindcss.com"></script> 
</head>
<body class="bg-gray-100 font-sans leading-normal tracking-normal">

    <div class="max-w-4xl mx-auto p-8 bg-white rounded-lg shadow-lg mt-10">
        <h1 class="text-3xl font-semibold text-center text-blue-600"><?= htmlspecialchars($projectData['name']) ?></h1> 
        <p class="text-center text-gray-500"><strong>Visibilité :</strong> <?= htmlspecialchars($projectData['visibility']) ?></p>  

        <hr class="my-4">

        <h2 class="text-2xl font-bold text-gray-700 mb-4">Description</h2>
        <div class="readme prose prose-lg text-gray-700">
            <?= $readme ?>
        </div>

        <a href="<?= $_SERVER['HTTP_REFERER'] ?>" class="text-blue-500 hover:text-blue-700 mt-6 inline-block">Retour à la liste des projets</a>    </div>

</body>
</html>
