<?php
require_once __DIR__ . '/../config/Database.php';

class Permission {
    private $db;

    public function __construct() {
        $database = new Database();
        $this->db = $database->getConnection();
    }

    public function createPermission($name) {
        $sql = 'INSERT INTO permissions (name) VALUES (?)';
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([$name]);
    }

    public function updatePermission($id, $name) {
        $sql = 'UPDATE permissions SET name = ? WHERE id = ?';
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([$name, $id]);
    }

    public function deletePermission($id) {
        $sql = 'DELETE FROM permissions WHERE id = ?';
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([$id]);
    }

    public function getAllPermissions() {
        $sql = 'SELECT * FROM permissions';
        $stmt = $this->db->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getPermissionById($id) {
        $sql = 'SELECT * FROM permissions WHERE id = ?';
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
