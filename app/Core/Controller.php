<?php

class ConexionDB {

    private $db_host;
    private $db_user;
    private $db_password;
    private $db_name;

    function __construct($db_host, $db_user, $db_password, $db_name) {
        $this->db_host = $db_host;
        $this->db_user = $db_user;
        $this->db_password = $db_password;
        $this->db_name = $db_name;
    }

    public function connect() {
        $pgsqli = new pgsqli($this->db_host, $this->db_user, $this->db_password, $this->db_name);
        if ($pgsqli->connect_errno) {
            echo "Error al conectarse a pgSQL: (" . $pgsqli->connect_errno . ") " . $pgsqli->connect_error;
            exit();
        }
        return $pgsqli;
    }

    public function close($pgsqli) {
        $pgsqli->close();
    }
}

class Controller {

    private $conexion;

    function __construct($conexion) {
        $this->conexion = $conexion;
    }

    public function executeQuery($query, $params) {
        $stmt = $this->conexion->prepare($query);

        if (!$stmt) {
            echo "Error en la preparación de la consulta: (" . $this->conexion->errno . ") " . $this->conexion->error;
            return;
        }

        if ($params) {
            $types = '';
            foreach ($params as $param) {
                if (is_int($param)) {
                    $types .= 'i';
                } elseif (is_float($param)) {
                    $types .= 'd';
                } elseif (is_string($param)) {
                    $types .= 's';
                } else {
                    $types .= 'b';
                }
            }

            array_unshift($params, $types);
            call_user_func_array(array($stmt, 'bind_param'), $this->refValues($params));
        }

        $stmt->execute();
        $result = $stmt->get_result();
        $rows = array();
        while ($row = $result->fetch_assoc()) {
            $rows[] = $row;
        }

        $stmt->close();

        return $rows;
    }

    private function refValues($arr){
        $refs = array();
        foreach ($arr as $key => $value) {
            $refs[$key] = &$arr[$key];
        }
        return $refs;
    }

}

$db_host = 'localhost';
$db_user = 'usuario';
$db_password = 'contrasena';
$db_name = 'nombre_db';

$conexion_db = new ConexionDB($db_host, $db_user, $db_password, $db_name);
$conexion = $conexion_db->connect();
$controller = new Controller($conexion);

//Ejemplo de uso de la clase Controller para ejecutar una consulta SELECT
$query = "SELECT * FROM tbl_personas WHERE DNI=?";
$params = array('12345678A');
$rows = $controller->executeQuery($query, $params);

foreach ($rows as $row) {
    echo $row['DNI'] . ' - ' . $row['Nombre'] . ' - ' . $row['Fecha Nacimiento'] . ' - ' . $row['Dirección'] . ' - ' . $row['Teléfono'] . '<br>';
}

$conexion_db->close($conexion);

?>
