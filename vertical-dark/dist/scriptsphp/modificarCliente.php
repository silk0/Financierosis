<?php
include "../config/conexion.php";
$accion = $_REQUEST['bandera'];
$baccion  = $_REQUEST["baccion2"];
if($accion==1){
  $id = $_POST["id_cliente"];
  $nombre   = $_POST['nombre'];
  $apellido   = $_POST['apellido'];
  $direccion   = $_POST['direc'];
  $cartera   = $_POST['cartera'];
  $email   = $_POST['email'];
  $tel   = $_POST['telefono'];
  $cel  = $_POST['celular'];
  $tipo = $_POST['tipo'];
  $prof = $_POST['profecion'];
  $salario = $_POST['salario'];
  $observ  = $_POST['observ'];
  $egres  = $_POST['egreso'];
  $consulta  = "UPDATE tclientes set nombre='" . $nombre . "',
      apellido='" . $apellido . "',
      id_cartera='" . $cartera . "',
      direccion='" . $direccion . "',
      profecion='". $prof ."',
      tipo_ingreso='".$tipo."',
      salario='" . $salario . "',
      telefono='" . $tel . "',
      celular='" . $cel . "',
      correo='" . $email . "',
      observaciones='" . $observ . "',
      egreso='" . $egres . "' 
      where id_cliente='". $id ."'";
  $resultado = $conexion->query($consulta);
  if ($resultado) {   
    header('Location:../listaCliente.php?bandera=1');
  } else {
    header('Location:../listaCliente.php?bandera=2');
  }   
}
?>