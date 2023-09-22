<?php
class Database {
    private $host = "localhost";
    private $username = "username";
    private $password = "password";
    private $database = "database_name";
    private $connection;

    public function __construct() {
        try {
            $this->connection = new PDO("pgsql:host=$this->host;dbname=$this->database", $this->username, $this->password);
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch(PDOException $e) {
            die("Error al conectar con la base de datos: " . $e->getMessage());
        }
    }

    public function query($sql, $params = []) {
        $statement = $this->connection->prepare($sql);
        $statement->execute($params);
        return $statement;
    }
}

class Censo {
    private $db;

    public function __construct() {
        $this->db = new Database();
    }

    public function getPersonas() {
        $sql = "SELECT * FROM tbl_personas";
        $statement = $this->db->query($sql);
        return $statement->fetchAll(PDO::FETCH_OBJ);
    }

    public function getLideres() {
        // consulta para obtener los líderes de los censistas
    }

    public function getHorarios() {
        // consulta para obtener los horarios para realizar los censos
    }

    public function insertarPersona($dni, $nombre, $fechaNacimiento, $direccion, $telefono) {
        $sql = "INSERT INTO tbl_personas (DNI, NOMBRE, FECNAC, DIR, TFNO) VALUES (?, ?, ?, ?, ?)";
        $params = [$dni, $nombre, $fechaNacimiento, $direccion, $telefono];
        $this->db->query($sql, $params);
    }

    public function actualizarPersona($dni, $nombre, $fechaNacimiento, $direccion, $telefono) {
        $sql = "UPDATE tbl_personas SET NOMBRE = ?, FECNAC = ?, DIR = ?, TFNO = ? WHERE DNI = ?";
        $params = [$nombre, $fechaNacimiento, $direccion, $telefono, $dni];
        $this->db->query($sql, $params);
    }

    public function eliminarPersona($dni) {
        $sql = "DELETE FROM tbl_personas WHERE DNI = ?";
        $params = [$dni];
        $this->db->query($sql, $params);
    }
}

// Ejemplo de uso
$censo = new Censo();
$personas = $censo->getPersonas();
foreach ($personas as $persona) {
    echo $persona->DNI . " " . $persona->NOMBRE . "<br>";
}
?>
