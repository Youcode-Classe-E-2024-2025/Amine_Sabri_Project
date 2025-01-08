<?php
require_once __DIR__ . '/../config/Database.php';
session_start();
class Auth {

    private $db;

    public function __construct() {
        $database = new Database();
        $this->db = $database->getConnection();
    }

    public function permParId($roleId) {
        $sql = "SELECT p.name
                FROM permissions p
                JOIN role_permissions rp ON p.id = rp.permission_id
                WHERE rp.role_id = :role_id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':role_id', $roleId, PDO::PARAM_INT);
        $stmt->execute();

        $permissions = $stmt->fetchAll(PDO::FETCH_COLUMN);

        if (!$permissions) {
            throw new Exception('Aucune permission trouvée pour ce rôle.');
        }

        return $permissions;
    }

    public function checkPerm($perm) {
        if (!isset($_SESSION['role_id'])) {
            header('Location: views/layouts/unauthorized.php');
            exit();
        }

        $permissions = $this->permParId($_SESSION['role_id']);
        $project_id = $_SESSION['projet_id'];
        if (!in_array($perm, $permissions)) {
            $_SESSION['message'] = 'You do not have permission to access this resource.';
            header('Location: views/layouts/todo.php?id='. $project_id );
            exit();
        }
    }
}
