<?php
require_once '../../model/user.php';
require_once '../../model/projet.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>
<header class="p-6 flex justify-between items-center shadow-lg ">
    <h1 class="text-2xl font-bold">TaskProjet</h1>
    <div class="flex space-x-2 items-center">
        <div class="relative">
            <img id="img_menu" src="https://cdn-icons-png.flaticon.com/512/3135/3135715.png" alt="" width="30px">
            <ul id="menu_navbar" class="absolute border-2 border-grey-400 right-[1px] top-14 w-28 p-2 hidden">
                <li>My Profile</li>
                <a href="../sign/signIn.php">signIn</a>
                <a href="../sign/signUp.php">signUp</a>
            </ul>
        </div>
    </div>
</header>
</body>

<main>
    <section>
        <div class="container mx-auto p-6">
            <h1 class="text-5xl font-bold text-center mb-8">Projects Desponible</h1>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                <?php
                    $projects = Projet::getAllProjetPublic();

                    if (!empty($projects)) {
                        foreach ($projects as $project) {
                            $visibilityColor = ($project['visibility'] == 'private') ? 'text-red-600' : 'text-green-600';
                            
                            echo "
                            <div class='bg-white border border-gray-300 shadow-lg rounded-lg overflow-hidden transform hover:scale-105 hover:shadow-xl transition duration-300'>
                                <a href='./todo.php?id=" . $project['id'] . "'>
                                    <div class='bg-gradient-to-r from-green-400 via-blue-500 to-purple-600 p-2'>
                                        <h2 class='text-xl font-bold mb-1 text-white'>{$project['name']}</h2>
                                    </div>
                                    <div class='p-4'>
                                        <p class='text-gray-700 mb-2'>
                                            <strong>Visibility:</strong> <span class='{$visibilityColor}'>" . ucfirst($project['visibility']) . "</span>
                                        </p>
                                        <p class='text-gray-700 mb-2'>
                                            <strong>Description:</strong> {$project['description']}
                                        </p>
                                        <p class='text-gray-700 mb-2'>
                                            <strong>Description:</strong> {$project['users_name']}
                                        </p>
                                        <div class=''>
                                            <a href='editProject.php?id={$project['id']}' class='text-indigo-500 py-1 px-3 rounded-full hover:text-indigo-700 transition duration-300'><i class='bi bi-pencil-square'></i></a>
                                        </div>
                                    </div>
                                </a>    
                            </div>";    
                        }
                    } else {
                        echo "<p class='text-center text-gray-500'>No projects available at the moment.</p>";
                    }
                ?>
            </div>
        </div>
    </section>

</main>

<script>
    const menu_navbar = document.querySelector("#menu_navbar");
    const img_menu = document.querySelector("#img_menu");

    img_menu.addEventListener('click', function() {
            menu_navbar.classList.toggle("hidden");
        });
</script>
</html>