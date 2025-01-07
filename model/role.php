<?php
require_once __DIR__ . '/../config/Database.php';

class Role {
    private $db;

    public function __construct() {
        $database = new Database();
        $this->db = $database->getConnection();
    }

    public function createRole($name) {
        $sql = 'INSERT INTO roles (name) VALUES (?)';
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([$name]);
    }

    public function updateRole($id, $name) {
        $sql = 'UPDATE roles SET name = ? WHERE id = ?';
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([$name, $id]);
    }

    public function deleteRole($id) {
        $sql = 'DELETE FROM roles WHERE id = ?';
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([$id]);
    }

    public static function getAllRoles() {
        $database = new Database();
        $db = $database->getConnection();

        $sql = 'SELECT * FROM roles';
        $stmt = $db->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getRoleById($id) {
        $sql = 'SELECT * FROM roles WHERE id = ?';
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}


$role = new Role();

$roles = $role->getAllRoles();

// var_dump($roles);

// Exemples d'utilisation
// $role->createRole('Medecin');
// $role->updateRole(4, 'sportif');
// $role->deleteRole(4);
?>
