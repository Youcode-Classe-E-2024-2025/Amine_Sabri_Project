<?php
require_once '../../model/user.php';
require_once '../../model/Task.php';
require_once '../../model/user.php';

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
        <div class=" flex justify-end mt-10 pr-6">
                <button id="buttonAddTask" class = "bg-gradient-to-r from-green-400 via-blue-500 to-purple-600 px-8 py-1 rounded-lg text-white font-bold "><i class="bi bi-plus-circle mr-2"></i>Ajouter Projet</button>
        </div>

        <?php include('../includes/template.php')?>

        <section id="modelAddTask" class=" ">
            <form action="../../controller/TaskController.php" method="POST" class="bg-yellow-300 w-[40%] mx-auto bg-white p-6 rounded-lg shadow-lg">
                <div id="closeModelTask" class= "flex justify-end "><i class="bi bi-x-lg cursor-pointer text-2xl "></i></div>
                <h2 class="text-2xl font-bold  text-center col-span-1 md:col-span-2">Create Task</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <input type="hidden" name="project_id" value="<?php echo $_GET['id']; ?>">

                <div class="mb-4">
                    <label for="name" class="block text-sm font-semibold text-gray-700">Task Name</label>
                    <input type="text" name="name" id="name" class="mt-1 block w-full p-3 border border-gray-300 rounded-md" required>
                </div>

                <div class="mb-4">
                    <label for="status" class="block text-sm font-semibold text-gray-700">Status</label>
                    <select name="status" id="status" class="mt-1 block w-full p-3 border border-gray-300 rounded-md">
                        <option value="to_do">To Do</option>
                        <option value="in_progress">In Progress</option>
                        <option value="done">Done</option>
                    </select>
                </div>

                <input type="hidden" id="create_by" name="create_by" value="<?php echo $_SESSION['user_id']; ?>">

                <div class="mb-4">
                    <label for="assignUsers" class="block text-sm font-semibold text-gray-700">Users</label>
                    <select name="assignUsers[]" id="assignUsers" class="block w-full p-3 border border-gray-300 rounded-md" multiple>
                        <?php
                            $users = User::getAll();
                            foreach ($users as $user) {
                                echo "<option value='{$user['id']}'>{$user['name']}</option>";
                            }
                        ?>
                    </select>
                </div>

                <div class="mb-4">
                    <label for="assignTags" class="block text-sm font-semibold text-gray-700">Tags</label>
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
                    <label for="category" class="block text-sm font-semibold text-gray-700">Category Name</label>
                    <input type="text" name="category" id="category" class="mt-1 block w-full p-3 border border-gray-300 rounded-md">
                </div>

                <div class="flex justify-center col-span-1 md:col-span-2">
                    <input type="submit" value="Create Task" class="bg-blue-500 text-white px-6 py-2 rounded-lg shadow-md hover:bg-blue-600 focus:outline-none">
                </div>
            </div>
                
            </form>
        </section>

    </main>
    <script>
        const buttonAddTask = document.querySelector('#buttonAddTask');
        const modelAddTask = document.querySelector('#modelAddTask');

        buttonAddTask.addEventListener('click',function(){
            modelAddTask.classList.toggle('hidden')
        })
    </script>
</body>
</html>