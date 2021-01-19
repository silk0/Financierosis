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
  $facturaC = $_POST["facturaC"];
  $subtotal = $_POST["PrecioTC"];
  $id_producto = $_POST["idC"];
  //codigo para guardar en la tabla kardex
  //Primero obgtendremos el numero de productos disponibles del que queremos Agregar
    $consulta="insert into tcompras(id_producto, id_proveedor, fecha, precio, cantidad) 
      select id_producto,id_proveedor,curdate(),'".$precioU."','".$cantidad."' from 
      tproducto where id_producto='".$id_producto."';";
    $resultado=$conexion->query($consulta);

    if ($resultado) {
        $consulta=" update tproducto as p set p.precio_compra='".$precioU."', 
          p.precio_venta=((p.margen/100)*'".$precioU."')+'".$precioU."', 
          p.stock=p.stock+'".$cantidad."' where p.id_producto='".$id_producto."';";
        $resultado=$conexion->query($consulta);
        if($resultado){
          $consulta="insert into kardex(id_producto, fecha, descripcion, movimiento, 
          cantidad, vunitario, cantidads, vunitarios, 
          vtotals)
          select id_producto, now(), concat('Compra Factura No.', '".$id_producto."'), 1, '".$cantidad."',
          precio_compra, stock, precio_compra,round(precio_compra*tproducto.stock,2)
          from tproducto where id_producto='".$id_producto."';";
          $resultado=$conexion->query($consulta);
          if($resultado){
            echo "Se ingreso en el kardex";
          }else{
            echo "No se ingreso en el kardex";
          }
        }else{
          echo "No se actualizo producto y cantidad";
        }
    }else{
      echo "No se inserto compra";
    }
  }
  if ($bandera==2) {
    $cantidad =  $_POST["cantidadD"];
    $precioU = $_POST["precioD"];
    $facturaC = $_POST["facturaD"];
    $subtotal = $_POST["PrecioTD"];
    $id_producto = $_POST["idD"];
    //codigo para guardar en la tabla kardex
    //Primero obgtendremos el numero de productos disponibles del que queremos Agregar
      $consulta="insert into tdevolucion(id_producto, id_proveedor, fecha, precio, cantidad) 
        select id_producto,id_proveedor,curdate(),precio_compra,'".$cantidad."' from 
        tproducto where id_producto='".$id_producto."';";
      $resultado=$conexion->query($consulta);
  
      if ($resultado) {
          $consulta=" update tproducto as p set 
            p.stock=p.stock-'".$cantidad."' where p.id_producto='".$id_producto."';";
          $resultado=$conexion->query($consulta);
          if($resultado){
            $consulta="insert into kardex(id_producto, fecha, descripcion, movimiento, 
            cantidad, vunitario, cantidads, vunitarios, 
            vtotals)
            select id_producto, now(), concat('Devolucion de preoducto a ', (select t.nombre from tproveedor as t where
            t.id_proveedor=tproducto.id_proveedor)), 2, '".$cantidad."',
            precio_compra, stock, precio_compra,round(precio_compra*tproducto.stock,2)
            from tproducto where id_producto='".$id_producto."';";
            $resultado=$conexion->query($consulta);
            if($resultado){
              echo "Se ingreso en el kardex";
            }else{
              echo "No se ingreso en el kardex";
            }
          }else{
            echo "No se actualizo producto y cantidad";
          }
      }else{
        echo "No se inserto compra";
      }
    }
?>
