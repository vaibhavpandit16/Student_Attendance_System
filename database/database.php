<?php
class Database {
private $servername = "Localhost";
private $username = "root";
private $password = "V@!bh@v@16";
private $dbname = "attendance_db";
public $conn = null;

public function __construct() {
    try {
        $this->conn = new PDO("mysql:host=$this->servername;dbname=$this->dbname", $this->username, $this->password);
        // set the PDO error mode to exception
        $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
      
      } catch(PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
      }
}
}
?>
