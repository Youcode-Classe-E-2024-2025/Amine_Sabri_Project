<?php
require_once '../../controller/projectController.php';
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
<section id="ModelUpdateProjet" class="fixed top-32 left-[34%]">
        <?php
            $users = ProjetController::getProjetId(); 
        ?>
    <form action="../../controller/projectController.php?id=<?= $users['id'] ?>" method="POST" class="relative bg-green-500 shadow-md rounded-lg w-[400px] px-8 pt-6 pb-8 mb-4">

        <div id="closeModelProjet" class="flex justify-end w-fit mb-[22px] absolute left-[92%] bottom-[89%]">
            <i class="bi bi-x-lg cursor-pointer text-2xl"></i>
        </div>
        <h2 class="text-2xl font-bold mb-6 text-center text-gray-800">Update Projet</h2>

        <div class="grid grid-cols-2 space-x-5">
            <div class="mb-4">
                <label for="name" class="block text-gray-700 text-sm font-bold mb-1">Name</label>
                <input 
                    type="text" 
                    id="name" 
                    name="name" 
                    value="<?php echo htmlspecialchars($users['name']); ?>" 
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" 
                    required
                >
            </div>
            <div class="mb-4">
                <label for="visibility" class="block text-gray-700 text-sm font-bold mb-1">Visibility</label>
                <div class="relative">
                    <select 
                        name="visibility" 
                        id="visibility" 
                        class="block appearance-none w-full bg-white border border-gray-300 text-gray-700 py-2 px-3 pr-8 rounded leading-tight focus:outline-none focus:shadow-outline"
                    >
                        <option value="public" <?php echo $users['visibility'] === 'public' ? 'selected' : ''; ?>>Public</option>
                        <option value="private" <?php echo $users['visibility'] === 'private' ? 'selected' : ''; ?>>Private</option>
                    </select>
                </div>
            </div>
        </div>

        <div class="mb-4">
            <label for="description" class="block text-gray-700 text-sm font-bold mb-1">Description</label>
            <textarea 
                id="description" 
                name="description" 
                rows="3" 
                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" 
                required
            ><?php echo $users['description']; ?></textarea>
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
            <button 
                type="submit" 
                class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline transition duration-300 ease-in-out transform hover:-translate-y-1 hover:scale-110"
            >
                Update Projet
            </button>
        </div>
    </form>
</section>
</body>
</html>