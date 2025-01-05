<?php
require_once('../model/Task.php');
require_once('../model/projet.php');
require_once('../model/user.php');
?>
<!DOCTYPE html>
<html>
<head>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
</head>
<body>

<canvas id="myChart" style="width:100%;max-width:600px"></canvas>

<script>
<?php 
    
    $tasks = Task::getAllTask();
    $projects = Projet::getAllProjet();
    $Users = User::getAll();
    $totalTask = count($tasks); 
    $totalProjet = count($projects);
    $totalUsers = count($Users);
    echo "var xValues = ['Tasks', 'Projets', 'Users'];";
    echo "var yValues = [$totalTask, $totalProjet, $totalUsers,];";
    echo "var barColors = ['#b91d47', '#00aba9', '#2b5797'];";
?>
new Chart("myChart", {
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
            text: "World Wide Wine Production 2018"
        }
    }
});
</script>

</body>
</html>
