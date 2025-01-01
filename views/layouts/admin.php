<?php
require_once '../../model/user.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Beautiful Example Page</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>
<body>
    <header class="p-6 flex justify-between items-center shadow-lg">
        <h1 class=" text-2xl font-bold">TaskProjet</h1>
        <div class="flex space-x-2 items-center">
            <h2><?php echo $_SESSION["username"]?></h2>
            <div class= "relative">
                <img id="img_menu" src="https://cdn-icons-png.flaticon.com/512/3135/3135715.png" alt="" width="30px">
                <ul id="menu_navbar" class = "absolute border-2 border-grey-400 right-[1px] top-14 w-28 p-2 hidden">
                    <li>My Profile</li>
                    <li>Logout</li>
                </ul>
            </div>
        </div>
    </header>

    <!-- Main content -->
    <main class="container mx-auto p-6">
        <div class=" flex justify-end">
            <button class = "border-2 border-green-500 px-8 py-1 rounded-lg bg-green-500 text-white font-bold "><i class="bi bi-plus-circle mr-2"></i>Ajouter Projet</button>
        </div>


        <section class="w-full max-w-md">
        <form action="../../controller/projectController.php" method="POST" class="bg-white shadow-md rounded-lg px-8 pt-6 pb-8 mb-4">
            <h2 class="text-2xl font-bold mb-6 text-center text-gray-800">Create New Item</h2>
            
            <div class="mb-4">
                <label for="name" class="block text-gray-700 text-sm font-bold mb-2">Name</label>
                <input type="text" id="name" name="name" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
            </div>
            
            <div class="mb-4">
                <label for="description" class="block text-gray-700 text-sm font-bold mb-2">Description</label>
                <textarea id="description" name="description" rows="3" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required></textarea>
            </div>
            
            <input type="hidden" id="create_by" name="create_by" value="<?php echo $_SESSION['user_id']; ?>">
            
            <div class="mb-4">
                <label for="visibility" class="block text-gray-700 text-sm font-bold mb-2">Visibility</label>
                <div class="relative">
                    <select name="visibility" id="visibility" class="block appearance-none w-full bg-white border border-gray-300 text-gray-700 py-2 px-3 pr-8 rounded leading-tight focus:outline-none focus:shadow-outline">
                        <option value="public">Public</option>
                        <option value="private">Private</option>
                    </select>
                </div>
            </div>
            
            <div class="mb-6">
                <label for="assignUsers" class="block text-gray-700 text-sm font-bold mb-2">Assign Users</label>
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
    <script>
        const menu_navbar = document.querySelector("#menu_navbar");
        const img_menu = document.querySelector("#img_menu");

        img_menu.addEventListener('click', function() {
            menu_navbar.classList.toggle("hidden");
        });
    </script>
</body>
</html>
