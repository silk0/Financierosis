<?php
include "../config/conexion.php";
$accion = $_REQUEST['bandera'];

if ($accion==1) {
    $id= $_POST["id_tipo"];
    $nombre= $_POST["nomm"];
    $clasi= $_POST["clasim"];
    $consulta  = "UPDATE ttipo_activo set nombre='" . $nombre. "',
    id_clasificacion='" . $clasi . "'  where id_tipo='".$id."'";
    $resultado = $conexion->query($consulta);
      if ($resultado) {
        header('Location:../tiposActivo.php?bandera=1');
      } else {
        header('Location:../tiposActivo.php?bandera=');
      }
    }
?>