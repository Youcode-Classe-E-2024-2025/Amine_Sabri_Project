<?php
require_once __DIR__ . '/../model/role.php';

class RoleController {

    public function createRoleAction() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if (isset($_POST['role_name']) && !empty($_POST['role_name'])) {
                $roleName = $_POST['role_name'];
                $permissions = isset($_POST['permissions']) ? $_POST['permissions'] : [];

                $modelRole = new Role();
                $roleId = $modelRole->createRole($roleName, $permissions);
                $_SESSION['message'] = "Role created successfully!";
                header("Location: views/layouts/manager.php");
                exit();
            } else {
                $_SESSION['error'] = "Role name is required.";
                header("Location: views/layouts/manager.php");
                exit();
            }
        }
    }


    public function updateRolePermissionsAction() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if (isset($_POST['role_id']) && !empty($_POST['role_id'])) {
                $roleId = (int)$_POST['role_id'];
                $permissions = isset($_POST['permissions']) ? $_POST['permissions'] : [];

                $modelRole = new Role();
                $success = $modelRole->updateRolePermissions($roleId, $permissions);

                // if ($success) {
                //     $_SESSION['message'] = "Permissions mises à jour avec succès !";
                // } else {
                //     $_SESSION['error'] = "Une erreur est survenue lors de la mise à jour des permissions.";
                // }
                header("Location: views/layouts/manager.php");
                exit();
            } else {
                // $_SESSION['error'] = "ID du rôle est requis.";
                header("Location: views/layouts/manager.php");
                exit();
            }
        }

    
}

}