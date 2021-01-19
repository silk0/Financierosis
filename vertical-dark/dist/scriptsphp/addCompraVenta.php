<?php
//Codigo que muestra solo los errores exceptuando los notice.
error_reporting(E_ALL & ~E_NOTICE);
session_start();
if($_SESSION["logueado"] == TRUE) {
$usuario=$_SESSION["usuario"];
$nombre = $_SESSION["nombre"];
$tipo  = $_REQUEST["tipo"];
$id  = $_REQUEST["id"];
}else {
    header("Location:index.php");
  }
?>
<?php session_start(); ?>
<?php
include "../config/conexion.php";

$bandera = $_REQUEST["bandera"];

if ($bandera==1) {
  $cantidad =  $_POST["cantidadC"];
  $precioU = $_POST["precioC"];
  $subtotal = $_POST["PrecioTC"];
  $id_producto = $_POST["idC"];
  //codigo para guardar en la tabla kardex
  //Primero obgtendremos el numero de productos disponibles del que queremos Agregar
    $consulta="insert into tcompras(id_producto, id_proveedor, fecha, precio, cantidad) 
    select id_producto,id_proveedor,curdate(),'".$precioU."','".$cantidad"' from 
    tproducto where id_producto='".$id_producto."';";
    $resultado=$conexion->query($consulta);

    if ($resultado) {
        $consulta="update tproducto as p set p.precio_compra=compra, 
                  p.precio_venta=((p.margen/100)*compra)+compra, 
                  p.stock=p.stock+cantidad where p.id_producto=?;";
        $resultado=$conexion->query($consulta);
        if(){

        }else{

        }
    }else{
      echo "No se inserto compra";
    }
  }
?>
