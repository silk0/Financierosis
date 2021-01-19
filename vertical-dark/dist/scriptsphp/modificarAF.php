<?php
include "../config/conexion.php";
$bandera = $_REQUEST['bandera'];
if ($bandera==1) {
$id   = $_REQUEST["id_activo"];
$estado    = $_REQUEST["estado"];
    $consulta  = "UPDATE tactivo set estado='".$estado."' where id_activo='" . $id . "'";
    $resultado = $conexion->query($consulta);
      if ($resultado) {
        header('Location:../listaActivos.php'); 
      } else {
        echo 'No funciona';  
      }
    }
    ?>