<?php
include "../config/conexion.php";
$bandera = $_REQUEST['bandera'];
$baccion  = $_REQUEST["idD"];

if ($bandera==1) {
$tipo= $_REQUEST["tipo"];
$clasi= $_REQUEST["clasi"];
$correlativo= $_REQUEST["correlativo"];


    $consulta  = "UPDATE ttipo_activo set nombre='" . $tipo. "',id_clasificacion='" . $clasi . "',correlativo='" . $correlativo . "' where id_tipo=".$baccion;
    $resultado = $conexion->query($consulta);
      if ($resultado) {
        header('Location:../listaTipoActivo.php?bandera=1');
      } else {
        header('Location:../listaTipoActivo.php?bandera=2');
      }
    }


?>