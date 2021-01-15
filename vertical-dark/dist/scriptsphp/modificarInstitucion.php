<?php
include "../config/conexion.php";
$accion = $_REQUEST['bandera'];
$baccion  = $_REQUEST["baccion2"];
if($accion==1){
$id = $_POST["id_institucion"];
$nombre   = $_POST['nombree'];
//$correlativo   = $_POST['correlativo'];

$consulta  = "UPDATE tinstitucion set nombre='" . $nombre . "'
where id_institucion='" . $id ."'";
$resultado = $conexion->query($consulta);
  if ($resultado) {   
    header('Location:../ingresoInstituciones.php?bandera=1');
  } else {
    header('Location:../ingresoInstituciones.php?bandera=2');
  }   
}
?>