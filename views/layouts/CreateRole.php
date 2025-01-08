<?php 
    require_once '../../model/role.php';
    $permissions = Role::getPermissions();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter un rôle</title>
</head>
<body>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Créer un rôle</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 py-10">
    <div class="max-w-3xl mx-auto bg-white p-8 rounded-lg shadow-md">
        <h1 class="text-2xl font-semibold text-gray-700 mb-4">Créer un rôle</h1>

        <form action="http://localhost/amine_Sabri_Project/index.php?action=createRole" method="POST">
            <div class="mb-6">
                <label for="role_name" class="block text-gray-700 font-medium mb-2">Nom du rôle:</label>
                <input type="text" id="role_name" name="role_name" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-400" required>
            </div>
            <h3 class="text-xl font-medium text-gray-700 mb-4">Permissions :</h3>
            <table class="w-full table-auto mb-6">
                <thead>
                    <tr>
                        <th class="px-4 py-2 text-left bg-gray-200 border-b">Sélectionner</th>
                        <th class="px-4 py-2 text-left bg-gray-200 border-b">Permission</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($permissions as $permission): ?>
                        <tr class="border-b hover:bg-gray-50">
                            <td class="px-4 py-2">
                                <input type="checkbox" name="permissions[]" value="<?= $permission['id'] ?>" class="h-5 w-5 text-blue-500 border-gray-300 rounded focus:ring-2 focus:ring-blue-400">
                            </td>
                            <td class="px-4 py-2"><?= $permission['name'] ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <button type="submit" class="w-full py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-400">
                Créer le rôle
            </button>
        </form>
    </div>
</body>
</html>

