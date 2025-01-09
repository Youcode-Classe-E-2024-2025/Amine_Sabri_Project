<?php 
require_once '../../model/role.php';
$permissions = Role::getPermissions();
$roles = Role::getAllRoles(); // Méthode à ajouter dans ton modèle pour récupérer tous les rôles
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gérer les rôles</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 py-10">
    <div class="max-w-4xl mx-auto bg-white p-8 rounded-lg shadow-md">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            <!-- Formulaire de création d'un rôle -->
            <div>
                <h1 class="text-2xl font-semibold text-gray-700 mb-4">Créer un rôle</h1>
                <form action="http://localhost/amine_Sabri_Project/index.php?action=createRole" method="POST">
                    <!-- Champ pour le nom du rôle -->
                    <div class="mb-6">
                        <label for="role_name" class="block text-gray-700 font-medium mb-2">Nom du rôle :</label>
                        <input type="text" id="role_name" name="role_name" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-400" required>
                    </div>
                    
                    <!-- Liste déroulante des permissions -->
                    <div class="mb-6">
                        <label for="permissions" class="block text-gray-700 font-medium mb-2">Permissions :</label>
                        <select id="permissions" name="permissions[]" multiple class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-400">
                            <?php foreach ($permissions as $permission): ?>
                                <option value="<?= $permission['id'] ?>"><?= $permission['name'] ?></option>
                            <?php endforeach; ?>
                        </select>
                        <p class="text-gray-500 text-sm mt-2">Maintenez la touche Ctrl (ou Cmd sur Mac) pour sélectionner plusieurs permissions.</p>
                    </div>
                    
                    <!-- Bouton de soumission -->
                    <button type="submit" class="w-full py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-400">
                        Créer le rôle
                    </button>
                </form>
            </div>

            <!-- Formulaire de mise à jour d'un rôle -->
            <div>
                <h1 class="text-2xl font-semibold text-gray-700 mb-4">Mettre à jour un rôle</h1>
                <form action="http://localhost/amine_Sabri_Project/index.php?action=updateRolePermissions" method="POST">
                    <!-- Sélection du rôle -->
                    <div class="mb-6">
                        <label for="role_id" class="block text-gray-700 font-medium mb-2">Sélectionner un rôle :</label>
                        <select id="role_id" name="role_id" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-400" required>
                            <option value="" disabled selected>Choisir un rôle</option>
                            <?php foreach ($roles as $role): ?>
                                <option value="<?= $role['id'] ?>"><?= $role['name'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    
                    <!-- Liste déroulante des permissions -->
                    <div class="mb-6">
                        <label for="permissions_update" class="block text-gray-700 font-medium mb-2">Permissions :</label>
                        <select id="permissions_update" name="permissions[]" multiple class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-400">
                            <?php foreach ($permissions as $permission): ?>
                                <option value="<?= $permission['id'] ?>"><?= $permission['name'] ?></option>
                            <?php endforeach; ?>
                        </select>
                        <p class="text-gray-500 text-sm mt-2">Maintenez la touche Ctrl (ou Cmd sur Mac) pour sélectionner plusieurs permissions.</p>
                    </div>
                    
                    <!-- Bouton de soumission -->
                    <button type="submit" class="w-full py-2 bg-green-600 text-white rounded-md hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-400">
                        Mettre à jour
                    </button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>



