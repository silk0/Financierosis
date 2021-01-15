<?php
include "../config/conexion.php";
$accion = $_REQUEST['bandera'];
$baccion  = $_REQUEST["baccion2"];
if($accion==1){
$id = $_POST["id_clasificacion"];
$nombre   = $_POST['nombre'];
$correlativo    = $_REQUEST['correlativo'];
$depreciacion   = $_REQUEST['tiempo_depreciacion'];
    $consulta  = "UPDATE tclasificacion set nombre='" . $nombre. "',correlativo='" . $correlativo . "',tiempo_depreciacion='" . $depreciacion . "' 
    where id_clasificaion='" . $id . "'";
    $resultado = $conexion->query($consulta);
      if ($resultado) {
        header('Location:../clasificacionActivo.php?bandera=1');
      } else {
        header('Location:../clasificacionActivo.php?bandera=2');
      }
    }
    ?>

