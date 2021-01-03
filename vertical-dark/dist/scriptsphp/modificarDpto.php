<?php
include "../config/conexion.php";
$accion = $_REQUEST['bandera'];

if($accion==1){
$baccion = $_REQUEST['idD'];
$departamento     = $_REQUEST['departamento'];
$institucion     = $_REQUEST['institucion'];

    $consulta  = "UPDATE tdepartamento set nombre='".$departamento."', id_institucion='".$institucion."' where id_departamento='".$baccion."'";
    $resultado = $conexion->query($consulta);
      if($resultado){
        header('Location:../../listaDepartamentos.php?bandera=1');
      } else {
        header('Location:../../listaDepartamentos.php?bandera=2');
      }
      }


?>