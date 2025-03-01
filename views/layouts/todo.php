<?php
require_once '../../model/user.php';
require_once '../../model/Task.php';
require_once '../../model/user.php';
require_once '../../core/Auth.php';
$auth = new Auth();
$project_id = $_GET['id'];


if (isset($_SESSION['message'])) {
    echo '<div id="alert-message" class="bg-red-100 border-l-4 flex justify-center fixed top-24 left-[34%] border-red-500 text-red-700 p-4 mb-4 rounded-lg shadow-lg transition-all" role="alert">
            <p class="font-medium">' . $_SESSION['message'] . '</p>
          </div>';
    unset($_SESSION['message']);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>
    <?php include('../includes/header.php')?>
    <main >

    <div class= "flex justify-between items-center  m-10">
        <form action="http://localhost/amine_Sabri_Project/index.php?action=exportTasks" method="post">
            <button type="submit" class="bg-gradient-to-r from-green-400 via-blue-500 to-purple-600 px-8 py-1 rounded-lg text-white font-bold">
                Exporter les Tâches en Excel
            </button>
        </form>
        <?php 
        if ($auth->hasPermission('create_task')) {
            echo '
            <div class="flex justify-end  pr-6">
                <button id="buttonAddTask" class="bg-gradient-to-r from-green-400 via-blue-500 to-purple-600 px-8 py-1 rounded-lg text-white font-bold">
                    <i class="bi bi-plus-circle mr-2"></i>Ajouter Task
                </button>
            </div>
            ';
        }
        ?>
        
    </div>

        <?php include('../includes/template.php')?>

        <section id="modelAddTask" class=" fixed top-24 left-[31%] hidden" >
                <form action="http://localhost/amine_Sabri_Project/index.php?action=createTask" method="POST" class="bg-gray-700 mx-auto bg-white p-6 rounded-lg shadow-lg">
                    <div id="closeModelTask" class= "flex justify-end "><i class="bi bi-x-lg cursor-pointer text-2xl "></i></div>
                    <h2 class="text-2xl mb-6 font-bold text-white text-center col-span-1 md:col-span-2"><u>CREATE TASK</u></h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <input type="hidden" name="project_id" value="<?php echo $project_id; ?>">

                <div class="">
                    <label for="name" class="block text-sm font-semibold text-white mb-2">Task Name :</label>
                    <input type="text" name="name" id="name" class="mt-1 block w-full p-3 border border-gray-300 rounded-md" required>
                </div>

                <div class="">
                    <label for="status" class="block text-sm font-semibold text-white mb-2">Status :</label>
                    <select name="status" id="status" class="mt-1 block w-full p-3 border border-gray-300 rounded-md">
                        <option value="to_do">To Do</option>
                        <option value="in_progress">In Progress</option>
                        <option value="done">Done</option>
                    </select>
                </div>

                <input type="hidden" id="create_by" name="create_by" value="<?php echo $_SESSION['user_id']; ?>">

                <div class="">
                    <label for="assignUsers" class="block text-sm font-semibold text-white mb-2">Users :</label>
                    <select name="assignUsers[]" id="assignUsers" class="block w-full p-3 border border-gray-300 rounded-md" multiple>
                        <?php
                            $users = User::getAll();
                            foreach ($users as $user) {
                                echo "<option value='{$user['id']}'>{$user['name']}</option>";
                            }
                        ?>
                    </select>
                </div>

                <div class="    ">
                    <label for="assignTags" class="block text-sm font-semibold text-white mb-2">Tags :</label>
                    <select name="assignTags[]" id="assignTags" class="block w-full p-3 border border-gray-300 rounded-md" multiple>
                        <?php
                            $tags = Task::getAllTags();
                            foreach ($tags as $tag) {
                                echo "<option value='{$tag['id']}'>{$tag['name']}</option>";
                            }
                        ?>
                    </select>
                </div>

                <div class="mb-4 col-span-1 md:col-span-2">
                    <label for="category" class="block text-sm font-semibold text-white mb-2">Category : </label>
                    <select name="category" id="category" class="mt-1 block w-full p-3 border border-gray-300 rounded-md">
                        <option value="web_development">Web Development</option>
                        <option value="ui_ux_design">UI/UX Design</option>
                        <option value="mobile_development">Mobile Development</option>
                        <option value="data_science">Data Science</option>
                        <option value="cybersecurity">Cybersecurity</option>
                        <option value="cloud_computing">Cloud Computing</option>
                        <option value="networking">Networking</option>
                        <option value="game_development">Game Development</option>
                        <option value="ai_ml">AI/ML (Artificial Intelligence & Machine Learning)</option>
                        <option value="devops">DevOps</option>
                        <option value="database_management">Database Management</option>
                        <option value="qa_testing">QA Testing</option>
                    </select>
                </div>


                <div class="flex justify-center col-span-1 md:col-span-2">
                    <input type="submit" value="Create Task" class="bg-blue-500 text-white px-6 py-2 rounded-lg shadow-md hover:bg-blue-600 focus:outline-none">
                </div>
            </div>
                
            </form>
        </section>

    </main>
    <script>
        window.onload = function() {
        const alertMessage = document.getElementById('alert-message');
        
        if (alertMessage) {
            setTimeout(function() {
                alertMessage.classList.add('opacity-0'); 
                alertMessage.classList.add('transition-opacity');
                setTimeout(function() {
                    alertMessage.remove();
                }, 300);
            }, 2000);
        }
    };
    </script>
        <script src="../../assets/js/main.js"></script>
</body>
</html>