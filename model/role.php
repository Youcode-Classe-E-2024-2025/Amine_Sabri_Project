<?php
require_once __DIR__ . '/../config/Database.php';

class Role {
    private $db;

    public function __construct() {
        $database = new Database();
        $this->db = $database->getConnection();
    }

    public function createRole($name, $permissions) {
        $name = htmlspecialchars(trim($name));
        $sql = 'INSERT INTO roles (name) VALUES (?)';
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$name]);

        $roleId = $this->db->lastInsertId();

        if (!empty($permissions)) {
            foreach ($permissions as $permissionId) {
                $permissionId = (int)$permissionId;
                $sql = 'INSERT INTO role_permissions (role_id, permission_id) VALUES (?, ?)';
                $stmt = $this->db->prepare($sql);
                $stmt->execute([$roleId, $permissionId]);
            }
        }

        return $roleId;
    }

    public static function getPermissions() {
        $database = new Database();
        $db = $database->getConnection(); 
        $sql = 'SELECT * FROM permissions';
        $stmt = $db->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function updateRolePermissions($roleId, $permissions) {
        try {
            $this->db->beginTransaction();

            $sqlDelete = 'DELETE FROM role_permissions WHERE role_id = ?';
            $stmtDelete = $this->db->prepare($sqlDelete);
            $stmtDelete->execute([$roleId]);

            $sqlInsert = 'INSERT INTO role_permissions (role_id, permission_id) VALUES (?, ?)';
            $stmtInsert = $this->db->prepare($sqlInsert);

            foreach ($permissions as $permissionId) {
                $permissionId = (int)$permissionId; 
                $stmtInsert->execute([$roleId, $permissionId]);
            }
            $this->db->commit();
            return true;
        } catch (Exception $e) {
            $this->db->rollBack();
            return false;
        }
    }
    

    

   
}

$role = new Role();
$roleId = 3; 
$newPermissions = [1]; 

if ($role->updateRolePermissions($roleId, $newPermissions)) {
    echo "Les permissions pour le rôle ID $roleId ont été mises à jour avec succès.";
} else {
    echo "Une erreur s'est produite lors de la mise à jour des permissions.";
}

// $role = new Role();

// $roles = $role->getAllRoles();

// var_dump($roles);

// Exemples d'utilisation
// $role->createRole('Medecin');
// $role->updateRole(4, 'sportif');
// $role->deleteRole(4);
?>
