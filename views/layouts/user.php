<?php
require_once '../../model/user.php';
require_once '../../model/projet.php';
require_once '../../core/Auth.php';
$auth = new Auth();
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
    <?php include("../includes/header.php"); ?>

<main class="mx-auto p-6">
    <div class= "flex justify-between items-center">
        <?php 
            if ($auth->hasPermission('create_project')) {
                echo '
                    <div class=" flex justify-end">
                        <button id="buttonAddProjet" class = "bg-gradient-to-r from-green-400 via-blue-500 to-purple-600 px-8 py-1 rounded-lg text-white font-bold "><i class="bi bi-plus-circle mr-2"></i>Ajouter Projet</button>
                    </div>
                ';
            }
        ?>

    </div> 
    
    <section>
        <div class="container mx-auto p-6">
            <h1 class="text-5xl font-bold text-center mb-8">Projects UserShowcase</h1>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                <?php
                if (isset($_SESSION['username'])) {
                    $username = $_SESSION['username'];
                    $projects = Projet::getAllProjetForUser($username);

                    if (!empty($projects)) {
                        foreach ($projects as $project) {
                            $visibilityColor = ($project['visibility'] == 'private') ? 'text-red-600' : 'text-green-600';
                            
                            echo "
                            <div class='bg-white border border-gray-300 shadow-lg rounded-lg overflow-hidden transform hover:scale-105 hover:shadow-xl transition duration-300'>
                                <a href='./todo.php?id=" . $project['id'] . "'>
                                    <div class='bg-gradient-to-r from-green-400 via-blue-500 to-purple-600 p-2'>
                                        <h2 class='text-xl font-bold mb-1 text-white'>{$project['name']}</h2>
                                    </div>
                                    <div class='p-4 flex justify-between items-center'>
                                        <p class='text-gray-700 mb-2'>
                                            <strong>Visibility:</strong> <span class='{$visibilityColor}'>" . ucfirst($project['visibility']) . "</span>
                                        </p>

                                        <div class=''>";
                                        
                                        if ($auth->hasPermission('update_project')) {
                                            echo "
                                            <a href='editProject.php?id={$project['id']}' class='text-indigo-500 py-1 px-3 rounded-full hover:text-indigo-700 transition duration-300'>
                                                <i class='bi bi-pencil-square'></i>
                                            </a>";
                                        }
                                        
                                        if ($auth->hasPermission('delete_project')) {
                                            echo "
                                            <form action='http://localhost/amine_Sabri_Project/index.php?action=deleteProjet' method='POST' class='inline'>
                                                <input type='hidden' name='id' value='{$project['id']}'>
                                                <button type='submit' class='text-green-500 py-1 px-3 rounded-full hover:text-green-700 transition duration-300'>
                                                    <i class='bi bi-trash-fill'></i>
                                                </button>
                                            </form>";
                                        }
                                        
                                        echo "
                                        </div>
                                    </div>
                                    <a href='readme.php?id={$project['id']}' class='inline-block mb-4 ml-4 text-blue-500 hover:text-blue-700 transition duration-300 ease-in-out transform hover:scale-110 hover:underline'>
                                        <i class='bi bi-file-earmark-text mr-2'></i> Voir le README
                                    </a>
                                </div>";   
                        }
                    } else {
                        echo "<p class='text-center text-gray-500'>No projects available at the moment.</p>";
                    }
                } else {
                    echo "<p class='text-center text-gray-500'>Please log in to see your projects.</p>";
                }
                ?>
            </div>
        </div>
    </section>

    <section id="ModelProjet" class="fixed top-32 left-[34%] hidden">
        <form action="http://localhost/amine_Sabri_Project/index.php?action=createProjet" method="POST" class="relative bg-yellow-500 shadow-md rounded-lg w-[400px] px-8 pt-6 pb-8 mb-4">
            <div id="closeModelProjet" class="flex justify-end w-fit mb-[22px] absolute left-[90%] bottom-[20%]">
                <i class="bi bi-x-lg cursor-pointer text-2xl "></i>
            </div>
            <h2 class="text-2xl font-bold mb-6 text-center text-gray-800">Create New Item</h2>
            <div class="grid grid-cols-2 space-x-5">
                <div class="mb-4">
                    <label for="name" class="block text-gray-700 text-sm font-bold mb-1">Name</label>
                    <input type="text" id="name" name="name" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                </div>
                
                <div class="mb-4">
                    <label for="visibility" class="block text-gray-700 text-sm font-bold mb-1">Visibility</label>
                    <div class="relative">
                        <select name="visibility" id="visibility" class="block appearance-none w-full bg-white border border-gray-300 text-gray-700 py-2 px-3 pr-8 rounded leading-tight focus:outline-none focus:shadow-outline">
                            <option value="public">Public</option>
                            <option value="private">Private</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="mb-4">
                <label for="description" class="block text-gray-700 text-sm font-bold mb-1">Description</label>
                <textarea id="description" name="description" rows="3" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required></textarea>
            </div>
            <div>
                <input type="hidden" id="create_by" name="create_by" value="<?php echo $_SESSION['user_id']; ?>">
            </div>
            <div class="mb-6">
                <label for="assignUsers" class="block text-gray-700 text-sm font-bold mb-1">Assign Users</label>
                <div class="relative">
                    <select name="assignUsers[]" id="assignUsers" class="block appearance-none w-64 bg-white border border-gray-300 text-gray-700 py-1 px-2 rounded leading-tight focus:outline-none focus:shadow-outline" multiple>
                        <?php
                            $users = User::getAll();
                            foreach ($users as $user) {
                                echo "<option value='{$user['id']}'>{$user['name']}</option>";
                            }
                        ?>
                    </select>
                </div>
            </div>
            <div class="flex items-center justify-center">
                <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline transition duration-300 ease-in-out transform hover:-translate-y-1 hover:scale-110">
                    Create Item
                </button>
            </div>
        </form>
    </section>

</main>
<script src="../../assets/js/main.js"></script>
</body>
</html>
