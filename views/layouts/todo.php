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
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>
    <main>
        <section>
            <form action="../../controller/TaskController.php" method="POST" class="w-[40%] mx-auto bg-white p-6 rounded-lg shadow-lg grid grid-cols-1 md:grid-cols-2 gap-4">
                <h2 class="text-2xl font-bold mb-4 text-center col-span-1 md:col-span-2">Create Task</h2>

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
            </form>
        </section>

    </main>
</body>
</html>