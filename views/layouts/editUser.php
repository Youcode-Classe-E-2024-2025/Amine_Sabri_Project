<?php
require_once '../../model/user.php';
require_once '../../model/role.php';

// Fetch the user data if the ID is provided in the URL
if (isset($_GET['id'])) {
    $userId = $_GET['id'];
    $user = User::getUserParId($userId); // Assuming this function retrieves a user by ID
    if (!$user) {
        // Handle the case where the user doesn't exist
        die('User not found.');
    }
} else {
    die('No user ID specified.');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Edit User</title>
</head>
<body>
<section id="modelUser" class="py-8 px-4 flex justify-center items-center w-full mt-24">
    <div class="bg-white shadow-md rounded-lg w-full max-w-md p-6">
        <div class="flex justify-end " id="closeModelUser">
            <svg class="w-8" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
            </svg>
        </div>
        <h2 class="text-2xl font-bold text-center text-gray-700 mb-6">Modifier un utilisateur</h2>
        <form action="http://localhost/amine_Sabri_Project/index.php?action=updateUser" method="POST">
            <!-- Hidden input for the user ID -->
            <input type="hidden" name="user_id" name="user_id" value="<?= $user['id']; ?>" />

            <div class="grid grid-cols-2 gap-x-5">
                <!-- Nom -->
                <div class="mb-4">
                    <label for="name" class="block text-gray-600 font-medium mb-2">Nom</label>
                    <input type="text" id="name" name="name" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring focus:ring-blue-200" placeholder="Entrer le nom" value="<?= htmlspecialchars($user['name']); ?>" required />
                </div>
                <!-- Email -->
                <div class="mb-4">
                    <label for="email" class="block text-gray-600 font-medium mb-2">Email</label>
                    <input type="email" id="email" name="email" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring focus:ring-blue-200" placeholder="Entrer l'email" value="<?= htmlspecialchars($user['email']); ?>" required />
                </div>
            </div>
                <!-- Rôle -->
                <div class="mb-4">
                    <label for="role_id" class="block text-gray-600 font-medium mb-2">Rôle</label>
                    <select id="role_id" name="role_id" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring focus:ring-blue-200">
                        <option value="" disabled>Sélectionnez un rôle</option>
                        <?php 
                            $roles = Role::getAllRoles();  // Récupère les rôles
                            foreach ($roles as $role) : 
                                // Check if the role is the user's current role
                                $selected = ($role['id'] == $user['role_id']) ? 'selected' : '';
                        ?>
                            <option value="<?= $role['id']; ?>" <?= $selected; ?>><?= htmlspecialchars($role['name']); ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            <!-- Bouton -->
            <button type="submit" class="w-full bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600 focus:outline-none">
                Mettre à jour
            </button>
        </form>
    </div>
</section>
</body>
</html>
