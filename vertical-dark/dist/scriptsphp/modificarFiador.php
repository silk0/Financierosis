<?php
include "../config/conexion.php";
$baccion  = $_REQUEST["baccion2"];
$accion = $_REQUEST['bandera'];
if($accion==1){
  $id = $_POST["id_fiador"];
  $nombre   = $_POST['nombre'];
  $apellido   = $_POST['apellido'];
  $tel   = $_POST['telefono'];
  $cel  = $_POST['celular'];
  $direccion   = $_POST['direc'];
  $email   = $_POST['email'];
  $prof = $_POST['profecion'];
  $salario = $_POST['salario'];
  $consulta  = "UPDATE tfiador set nombre='" . $nombre . "',
  apellido='" . $apellido . "',
  telefono='" . $tel . "',
  celular='" . $cel . "',
  direccion='" . $direccion . "',
  correo='" . $email . "',
  profecion='". $prof ."',
  salario='" . $salario . "'
  where id_fiador='". $id ."'";
  $resultado = $conexion->query($consulta);
  if ($resultado) {   
    header('Location:../listaFiador.php?bandera=1');
  }  else {
    header('Location:../listaFiador.php?bandera=2');
  }   
}

/* $bandera = $_REQUEST['bandera'];
$baccion  = $_REQUEST["baccion"];

if ($bandera==1) {
$nombre     = $_REQUEST['nombre'];
$apellido   = $_REQUEST['apellido'];
$direccion  = $_REQUEST['direc'];
$dui        = $_REQUEST['dui'];
$nit        = $_REQUEST['nit'];
$email      = $_REQUEST['email'];
$telefono   = $_REQUEST['telefono'];
$celular    = $_REQUEST['celular'];
$trabajo    = $_REQUEST['trabajo'];
$salario    = $_REQUEST['salario'];


    $consulta  = "UPDATE tfiador set nombre='" . $nombre . "',apellido='" . $apellido . "',direccion='" . $direccion . "',dui='" . $dui . "',nit='" . $nit . "',correo='" . $email . "',profecion='" . $trabajo . "',salario='" . $salario . "',telefono='" . $telefono . "',celular='" . $celular . "' where id_fiador='" . $baccion . "'";
    $resultado = $conexion->query($consulta);
      if ($resultado) {
        header('Location:../listaFiador.php?bandera=1');
      } else {
        header('Location:../listaFiador.php?bandera=2');
      }
    }else if($bandera==2){
      $nombre     = $_POST['nombre'];
      $apellido   = $_POST['apellido'];
      $direccion  = $_POST['direc'];
      $dui        = $_POST['dui'];
  
      $usuario    = $_POST['usuario'];
      $contrasena = $_POST['contrasena'];
      $nivel      = $_POST['rol'];
      
      
      $consulta  = "UPDATE templeados set nombre='" . $nombre . "',apellido='" . $apellido . "',zona='" . $direccion . "',dui='" . $dui . "',usuario='" . $usuario . "',pass='" . $contrasena . "',rol='" . $nivel . "' where id_empleado='" . $baccion . "'";
          $resultado = $conexion->query($consulta);
            if ($resultado) {
              header('Location:../mostrarEmpleados.php?bandera=1');
            } else {
              header('Location:../mostrarEmpleados.php?bandera=2');
            }
      
      }else if ($bandera==3) {
$nombre     = $_REQUEST['nombre'];
$telefono   = $_REQUEST['telefono'];
$direccion  = $_REQUEST['direc'];
$representante  = $_REQUEST['representante'];
$dui        = $_REQUEST['dui'];
$nit        = $_REQUEST['nit'];
$celular    = $_REQUEST['celular'];
$email      = $_REQUEST['email'];

    $consulta  = "UPDATE tproveedor set nombre='" . $nombre . "',direccion='" . $direccion . "',telefono='" . $telefono . "',representante='" . $representante . "',dui='" . $dui . "',nit='" . $nit . "',celular='" . $celular . "',email='" . $email . "' where id_proveedor='" . $baccion . "'";
          $resultado = $conexion->query($consulta);
            if ($resultado) {
              header('Location:../mostrarProveedores.php?bandera=1');
            } else {
              header('Location:../mostrarProveedores.php?bandera=2');
            }
      
      } */
?>