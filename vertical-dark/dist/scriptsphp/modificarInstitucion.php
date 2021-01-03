<?php
include "../config/conexion.php";
$accion = $_REQUEST['bandera'];
$baccion  = $_REQUEST["idinst"];
if($accion==1){
$nombre   = $_POST['inst'];
$consulta  = "UPDATE tinstitucion set nombre='" . $nombre . "' where id_institucion='" . $baccion . "'";
$resultado = $conexion->query($consulta);
  if ($resultado) {   
    header('Location:../listaInstituciones.php?bandera=1');
  } else {
    header('Location:../listaInstituciones.php?bandera=2');
  }   
}
?>