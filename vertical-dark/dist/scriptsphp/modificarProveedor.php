<?php
include "../config/conexion.php";
$accion = $_REQUEST['bandera'];
$baccion  = $_REQUEST["baccion2"];
if($accion==1){
  $id = $_POST["id_proveedor"];
  $nombre   = $_POST['nombre'];
  $telefono   = $_POST['telefono'];
  $direccion   = $_POST['direc'];
  $represen   = $_POST['represen'];
  $dui   = $_POST['dui'];
  $nit  = $_POST['nit'];
  $celu  = $_POST['celu'];
  $email = $_POST['email'];
  $consulta  = "UPDATE tproveedor set nombre='" . $nombre . "',
  telefono='" . $telefono. "',
  direc='" . $direc. "',
  represen='" . $represen . "',
  dui='" . $dui . "',
  nit='" . $nit . "',
  celu='" . $celu . "',
  email='" . $email . "',
  where id_proveedor='". $id ."'";
  $resultado = $conexion->query($consulta);
  if ($resultado) {   
    header('Location:../ListaProveedor.php?bandera=1');
  } else {
    header('Location:../ListaProveedor.php?bandera=2');
  }   
}
?>