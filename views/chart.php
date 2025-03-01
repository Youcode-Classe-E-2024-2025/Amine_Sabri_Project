<?php
require_once('../model/Task.php');
require_once('../model/projet.php');
require_once('../model/user.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Graphiques avec Chart.js</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
</head>
<body>
    <?php include('./includes/header.php'); ?>

    <h2 class="text-center mt-[30px]">Graphiques : Distribution des Tâches, Projets et Utilisateurs</h2>

    <section class="flex mt-[80px] justify-between">
        <canvas id="pieChart"  style="width:100%;max-width:600px;"></canvas>
        <canvas id="barChart" style="width:100%;max-width:600px;"></canvas>
    </section>

    <script>
    <?php 

        $tasks = Task::getAllTask();
        $projects = Projet::getAllProjet();
        $users = User::getAll();

        $totalTask = count($tasks); 
        $totalProjet = count($projects);
        $totalUsers = count($users);

        echo "var xValues = ['Tasks', 'Projects', 'Users'];";
        echo "var yValues = [$totalTask, $totalProjet, $totalUsers];";
        echo "var barColors = ['#b91d47', '#00aba9', '#2b5797'];";
    ?>
    new Chart("pieChart", {
        type: "pie",
        data: {
            labels: xValues,
            datasets: [{
                backgroundColor: barColors,
                data: yValues
            }]
        },
        options: {
            title: {
                display: true,
                text: "Distribution des Tâches, Projets et Utilisateurs (Camembert)"
            }
        }
    });

    new Chart("barChart", {
        type: "bar",
        data: {
            labels: xValues,
            datasets: [{
                backgroundColor: barColors,
                data: yValues
            }]
        },
        options: {
            title: {
                display: true,
                text: "Distribution des Tâches, Projets et Utilisateurs (Barres)"
            },
            legend: { display: false },
            scales: {
                yAxes: [{ ticks: { beginAtZero: true } }]
            }
        }
    });
    </script>
    <script src="./../assets/js/main.js"></script>

    
</body>
</html>
