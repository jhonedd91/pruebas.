<?php

require_once '..\Core\DataBase.php';
//require_once 'IndexModel.php';

$model = new IndexModel();
$resultado = $model->traerUsuario('1234567890');

foreach ($resultado as $fila) {
    echo $fila->nombre;
}

?>
