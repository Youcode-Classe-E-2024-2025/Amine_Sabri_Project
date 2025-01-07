<?php
require_once __DIR__ . '/../config/Database.php';

class RolePermission {
    private $db;

    public function __construct() {
        $database = new Database();
        $this->db = $database->getConnection();
    }

    public function assignPermission($role_id, $permission_id) {
        $sql = 'INSERT INTO role_permissions (role_id, permission_id) VALUES (?, ?)';
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([$role_id, $permission_id]);
    }

    public function revokePermission($role_id, $permission_id) {
        $sql = 'DELETE FROM role_permissions WHERE role_id = ? AND permission_id = ?';
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([$role_id, $permission_id]);
    }

    public function getPermissionsByRole($role_id) {
        $sql = 'SELECT p.* FROM permissions p 
                JOIN role_permissions rp ON p.id = rp.permission_id 
                WHERE rp.role_id = ?';
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$role_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
