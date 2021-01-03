<?php 
$id=$_POST['id'];
include "../config/conexion.php";
$result = $conexion->query("SELECT * from tcategoria where id_categoria=".$id);
if ($result) {
    while ($fila = $result->fetch_object()) {
            echo $fila->categoria;
        }
    }else{
        echo "Error";
    }

?>