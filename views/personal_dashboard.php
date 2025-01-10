<?php
require_once('../model/Task.php');
require_once('../model/user.php');

// session_start();

$userId = $_SESSION['user_id']; 
$statistics = Task::getUserStatistics($userId);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mon Dashboard Personnel</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
<?php include("includes/header.php"); ?>
    <div class="container mx-auto p-6">
    <a href="<?= isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : '#' ?>" class="text-blue-500 underline">Retour</a>

        <h1 class="text-3xl font-bold text-gray-800 mb-6 text-center">Mon Dashboard Personnel</h1>
        
        <!-- Statistiques -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
            <div class="bg-white shadow-lg rounded-lg p-6 text-center">
                <h2 class="text-xl font-semibold text-gray-700">Total Tâches</h2>
                <p class="text-4xl font-bold text-blue-500 mt-4"><?= $statistics['total_tasks'] ? $statistics['total_tasks'] : 0 ?></p>
            </div>
            <div class="bg-white shadow-lg rounded-lg p-6 text-center">
                <h2 class="text-xl font-semibold text-gray-700">À Faire</h2>
                <p class="text-4xl font-bold text-yellow-500 mt-4"><?= $statistics['to_do'] ? $statistics['to_do'] : 0 ?></p>
            </div>
            <div class="bg-white shadow-lg rounded-lg p-6 text-center">
                <h2 class="text-xl font-semibold text-gray-700">En Cours</h2>
                <p class="text-4xl font-bold text-orange-500 mt-4"><?= $statistics['in_progress'] ? $statistics['in_progress'] : 0 ?></p>
            </div>
            <div class="bg-white shadow-lg rounded-lg p-6 text-center">
                <h2 class="text-xl font-semibold text-gray-700">Terminées</h2>
                <p class="text-4xl font-bold text-green-500 mt-4"><?= $statistics['done'] ? $statistics['done'] : 0 ?></p>
            </div>
        </div>

        
    </div>
    <script src="./../assets/js/main.js"></script>
</body>
</html>
