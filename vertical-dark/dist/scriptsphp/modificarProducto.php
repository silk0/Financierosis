<?php
include "../config/conexion.php";
$accion = $_REQUEST['bandera'];

if($accion==1){
  $baccion  = $_POST['idproducto'];
$nombre   = $_POST['nombre'];
$proveedor   = $_POST['idproveedor'];
$categoria   = $_POST['idcat'];
$margen  = $_POST['margen'];
$stock   = $_POST['stock'];
$descripcion   = $_POST['descrip'];

$consulta  = "UPDATE tproducto set nombre='" . $nombre . "',id_proveedor='" . $proveedor . "',id_categoria='" . $categoria . "',descripcion='" . $descripcion . "',margen='" . $margen . "',stock_minimo='". $stock ."' where id_producto='" . $baccion . "'";
$resultado = $conexion->query($consulta);
  if ($resultado) {   
    header('Location:../inventario.php?bandera=1');
  } else {
    header('Location:../inventario.php?bandera=2');
  }   
}
?>