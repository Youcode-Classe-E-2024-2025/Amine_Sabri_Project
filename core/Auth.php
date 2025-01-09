<?php
require_once __DIR__ . '/../config/Database.php';
// session_start();
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

        if (!in_array($perm, $permissions)) {
            $_SESSION['message'] = 'You do not have permission to access this resource.';
            $currentPage = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : 'views/layouts/dashboard.php';
            header('Location: ' . $currentPage);
            exit();
        }
    }


    public function hasPermission($perm) {
        if (!isset($_SESSION['role_id'])) {
            return false; // إذا ما كانش الدور موجود فالجلسة
        }
    
        $permissions = $this->permParId($_SESSION['role_id']);
    
        return in_array($perm, $permissions); // تحقق واش الصلاحية كاينة
    }
    
}
