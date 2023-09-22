<?php
// incluir la clase DataBase
include 'ruta/hacia/DataBase.php';

// crear una instancia de la clase
$db = new DataBase();

// realizar una consulta con parámetros
$sql = "SELECT * FROM tabla WHERE campo1 = :valor1 AND campo2 = :valor2";
$db->consult($sql);
$db->bind(':valor1', 'valor1');
$db->bind(':valor2', 'valor2');
$db->execute();
$resultado = $db->showAll();

// recorrer el resultado
foreach($resultado as $fila) {
    echo $fila->campo1 . ' - ' . $fila->campo2 . '<br>';
}
?>
