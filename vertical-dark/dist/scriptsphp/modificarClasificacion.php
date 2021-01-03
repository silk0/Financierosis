<?php
include "../config/conexion.php";
$bandera = $_REQUEST['bandera'];

if ($bandera==1) {
$baccion  = $_REQUEST["idC"];
$clasificacion  = $_REQUEST['clasificacion'];
$correlativo    = $_REQUEST['correlativo'];
$depreciacion   = $_REQUEST['depreciacion'];
    $consulta  = "UPDATE tclasificacion set nombre='" . $clasificacion . "',correlativo='" . $correlativo . "',tiempo_depreciacion='" . $depreciacion . "' where id_clasificaion='" . $baccion . "'";
    $resultado = $conexion->query($consulta);
      if ($resultado) {
        header('Location:../listaClasificacion.php?bandera=1');
      } else {
        header('Location:../listaClasificacion.php?bandera=2');
      }
    }
    ?>
