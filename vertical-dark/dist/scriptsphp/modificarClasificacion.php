<?php
include "../config/conexion.php";
$accion = $_REQUEST['bandera'];
if($accion==1){
$id = $_POST["id_clasificaion"];
$nombre   = $_POST['nombree'];
$correlativo    = $_REQUEST['correm'];
$depreciacion   = $_REQUEST['timpom'];
    $consulta  = "UPDATE tclasificacion set nombre='" . $nombre. "',
    correlativo='" . $correlativo . "',
    tiempo_depreciacion='" . $depreciacion . "' 
    where id_clasificaion='" . $id . "'";
    $resultado = $conexion->query($consulta);
      if ($resultado) {
        header('Location:../clasificacionActivo.php?bandera=1');
      } else {
        header('Location:../clasificacionActivo.php?bandera=2');
      }
    }
    ?>

