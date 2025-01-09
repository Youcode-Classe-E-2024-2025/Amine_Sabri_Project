<?php
require_once '../../model/user.php';
require_once '../../model/role.php';
require_once '../../core/Auth.php';
$auth = new Auth();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>

    <title>Document</title>
</head>
<body>
    <?php include('../includes/header.php')?>

    <section class="p-6 bg-gray-100 min-h-screen">
    <div class="flex justify-between mb-4">
        <!-- <button id="addUser" class="px-4 py-2 bg-blue-600 text-white font-semibold rounded shadow hover:bg-blue-700">
            Ajouter un utilisateur
        </button> -->
        <a href = "./CreateRole.php" class="px-4 py-2 bg-green-600 text-white font-semibold rounded shadow hover:bg-green-700">
            Ajouter un rôle
        </a>
    </div>
    
    <?php
        $users = User::getAll(); // Récupérer les utilisateurs depuis la base de données
    ?>

    <div class="overflow-x-auto bg-white shadow-md rounded-lg">
        <table class="table-auto w-full text-left border-collapse">
            <thead class="bg-gray-200">
                <tr>
                    <th class="px-6 py-3 border-b">ID</th>
                    <th class="px-6 py-3 border-b">Nom</th>
                    <th class="px-6 py-3 border-b">Email</th>
                    <th class="px-6 py-3 border-b">Rôle</th>
                    <th class="px-6 py-3 border-b">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($users as $user): ?>
                    <tr class="hover:bg-gray-100">
                        <td class="px-6 py-4 border-b"><?php echo $user['id']; ?></td>
                        <td class="px-6 py-4 border-b"><?php echo htmlspecialchars($user['name']); ?></td>
                        <td class="px-6 py-4 border-b"><?php echo htmlspecialchars($user['email']); ?></td>
                        <td class="px-6 py-4 border-b"><?php echo htmlspecialchars($user['role_name']); ?></td>
                        <td class="px-6 py-4 border-b flex ">

                            <?php if ($auth->hasPermission('update_user')): ?>
                                <a href="editUser.php?id=<?php echo $user['id']; ?>" class="text-yellow-500 hover:text-yellow-600">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L6.832 19.82a4.5 4.5 0 0 1-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 0 1 1.13-1.897L16.863 4.487Zm0 0L19.5 7.125" />
                                    </svg>
                                </a>
                            <?php endif; ?>

                            <?php if ($auth->hasPermission('delete_user')): ?>
                                <form action="http://localhost/amine_Sabri_Project/index.php?action=deleteUser" method="POST" onsubmit="return confirm('Are you sure you want to delete this user?')">
                                    <input type="hidden" name="user_id" value="<?php echo $user['id']; ?>"> <!-- Correct field name -->
                                    <button type="submit" class="text-red-500 hover:text-red-600 ml-4">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                        </svg>
                                    </button>
                                </form>
                            <?php endif; ?>
                        </td>

                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</section>


</body>
<script src="../../assets/js/main.js"></script>
</html>