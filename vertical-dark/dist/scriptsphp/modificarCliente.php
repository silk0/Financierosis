<?php
include "../config/conexion.php";
$accion = $_REQUEST['bandera'];
$baccion  = $_REQUEST["idfiador"];
if($accion==1){
$nombre   = $_POST['nombre'];
$apellido   = $_POST['apellido'];
$direccion   = $_POST['direc'];
$cartera   = $_POST['cartera'];
$dui  = $_POST['dui'];
$nit   = $_POST['nit'];
$email   = $_POST['email'];
$tel   = $_POST['telefono'];
$cel  = $_POST['celular'];
$tipo=$_POST['tipo'];
$prof=$_POST['profecion'];
$salario=$_POST['salario'];
$observ  = $_POST['observ'];
$consulta  = "UPDATE tclientes set nombre='" . $nombre . "',apellido='" . $apellido . "',id_cartera='" . $cartera . "',direccion='" . $direccion . "',dui='" . $dui . "',nit='" . $nit . "',profecion='". $prof ."',tipo_ingreso='".$tipo."',salario='" . $salario . "',telefono='" . $tel . "',celular='" . $cel . "',correo='" . $email . "',observaciones='".$observ."' where id_cliente='" . $baccion . "'";
$resultado = $conexion->query($consulta);
  if ($resultado) {   
    header('Location:../mostrarClientes.php?bandera=1');
  } else {
    header('Location:../mostrarClientes.php?bandera=2');
  }   
}
?>