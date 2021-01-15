<?php
include "../config/conexion.php";
$accion = $_REQUEST['bandera'];
if($accion==1){
  $id = $_POST["id_departamento"];
  $nombre = $_POST['nombrem'];
  $insti = $_POST['instim'];
    $consulta  = "UPDATE tdepartamento set nombre='".$nombre."',
     id_institucion='".$insti."'
    where id_departamento='".$id."'";
    $resultado = $conexion->query($consulta);
      if($resultado){
        header('Location:../departamentos.php?bandera=1');
      } else {
        header('Location:../departamentos.php?bandera=2');
      }
  }
?>