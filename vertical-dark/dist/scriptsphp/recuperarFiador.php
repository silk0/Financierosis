<?php 
$id=$_POST['id'];
include "../config/conexion.php";
$result = $conexion->query("SELECT * from tfiador where id_fiador=".$id);
if ($result) {
    while ($fila = $result->fetch_object()) {
            echo $fila->nombre." ".$fila->apellido;
        }
    }else{
        echo "Error";
    }

?>