<?php
include "../config/conexion.php";
$bandera = $_REQUEST['bandera'];
$baccion  = $_REQUEST["idE"];
if ($bandera==1) {
$nombre     = $_REQUEST['nombre'];
$apellido   = $_REQUEST['apellido'];
$dui        = $_REQUEST['dui'];

    $consulta  = "UPDATE tencargado set nombre='" . $nombre . "',apellido='" . $apellido . "',dui='" . $dui . "' where id_encargado='" . $baccion . "'";
    $resultado = $conexion->query($consulta);
      if ($resultado) {
        header('Location:../listaEncargado.php?bandera=1');
      
      } else {
        header('Location:../listaEncargado.php?bandera=2');
      }
    }

?>