<?php 
include "../config/conexion.php";
$accion = $_REQUEST['bandera'];
if ($accion==1) {
    $id = $_POST["id_empleado"];
    $nomb = $_POST["nombrem"];
    $apellido = $_POST["apellidom"];
    $rol = $_POST["rolm"];
    $dir = $_POST["direcm"];
    $consulta="UPDATE templeados set nombre='".$nomb."',
    apellido='".$apellido."',
    rol='".$rol."', zona='".$dir."'
    where id_empleado='".$id."'";
    $resultado = $conexion->query($consulta);
    if ($resultado) {   
        header('Location:../listaEmpleado.php?bandera=1');
      } else {
        header('Location:../listaEmpleado.php?bandera=2');
      }  
}
?>