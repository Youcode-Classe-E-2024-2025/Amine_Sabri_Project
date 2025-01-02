<?php

class Database {
    private $pdo;
    private $host = 'localhost';
    private $dbname = 'projetTask';
    private $username = 'root'; 
    private $password = '';

    public function __construct() {
        try {
            $this->pdo = new PDO("mysql:host={$this->host};dbname={$this->dbname}", $this->username, $this->password);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            // echo "Connexion réussie à la base de données !";
        } catch (PDOException $e) {
            echo "Erreur de connexion : " . $e->getMessage();
        }
    }
    public function getConnection() {
        return $this->pdo;
    }
}


// $database = new Database();
// $pdo = $database->getConnection();

// if($pdo = true){
//     echo"<br>";
//     echo "connect";
// }
?>
