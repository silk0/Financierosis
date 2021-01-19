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

/*"bandera":$bandera,
"producto" :$id_produc,
"proveedor" :$id_proveed,
"factura" :$factura,
"cantidad" :$cantidad,
"precio" :$precio,
"total" :$total*/
$bandera = $_POST["bandera"];
$idproducto = $_POSTREQUEST["producto"];
$cantidad = $_POST["cantidad"];
$vunitario = $_POST["precio"];
$subtotalK = $_POST["total"];

if ($bandera==1) {
  //codigo para guardar en la tabla kardex
  //Primero obgtendremos el numero de productos disponibles del que queremos Agregar
  $consulta="select * from tproducto where id_producto=".$idproducto;
  $resultado=$conexion->query($consulta);
  if ($resultado) {
    while ($fila=$resultado->fetch_object()) {
      $productosDisponibles=$fila->stock;
      $margen=($fila->margen)/100;
    }
  }
  //Obtendremos el ultimo valor total del saldo en el kardex
  $consulta1="select * from kardex where id_producto='".$idproducto."' order by id_kardex";
  $resultado1=$conexion->query($consulta1);
  if($resultado1->num_rows<1)
  {
    $vtotalS=0;
    $descripcion="Primer ingreso de productos.";
  }else {
    if ($resultado1) {
      while ($fila1=$resultado1->fetch_object()) {
        $vtotalS=$fila1->vtotals;
      }
    }else {
      echo "Error en consulta resultado1";
        msg(mysqli_error($conexion));
    }
  }
  if ($bandera==1) {
    $nuevoValorTotalS=$vtotalS+$subtotalK;
    $nuevoValorTotalS=number_format($nuevoValorTotalS, 2, ".", "");
    $valorUnitarioS=$nuevoValorTotalS/$productosDisponibles;
    $valorUnitarioS=number_format($valorUnitarioS, 2, ".", "");
    $descripcion = "Compra de productos factura No.";
    $descripcion .= $factura;
    $consulta3  = "INSERT INTO kardex VALUES('null','" . $idproducto . "',curdate(),'" . $descripcion . "','" . $bandera . "','" . $cantidad . "','" . $vunitario . "','" . $productosDisponibles . "','" . $valorUnitarioS . "','" . $nuevoValorTotalS . "')";
    $resultado3 = $conexion->query($consulta3);
    if ($resultado3) {        
        echo "Guardo compra kardex";        
      } else {
        msg(mysqli_error($conexion));
    }
  }else {
    
    $nuevoValorTotalS=$vtotalS-$subtotalK;
    $nuevoValorTotalS=number_format($nuevoValorTotalS, 2, ".", "");
    $valorUnitarioS=$nuevoValorTotalS/$productosDisponibles;
    $valorUnitarioS=number_format($valorUnitarioS, 2, ".", "");
    $consulta3  = "INSERT INTO kardex VALUES('null','" . $idproducto . "',curdate(),'" . $descripcion . "','" . $bandera . "','" . $cantidad . "','" . $vunitario . "','" . $productosDisponibles . "','" . $valorUnitarioS . "','" . $nuevoValorTotalS . "')";
    $resultado3 = $conexion->query($consulta3);
    if ($resultado3) {       
        echo "Guardo venta";          
      } else {
        msg(mysqli_error($conexion));
    }
}
}

?>
