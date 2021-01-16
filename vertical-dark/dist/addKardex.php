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
include "config/conexion.php";

$bandera = $_REQUEST["bandera"];
$idproducto = $_REQUEST["id"];
$fecha = $_REQUEST["fechaR"];
$descripcion = $_REQUEST["descripcionR"];
$accion = $_REQUEST["accion"];
$cantidad = $_REQUEST["cantidadR"];
$vunitario = $_REQUEST["vunitarioR"];
$subtotalK = $_REQUEST["subtotalR"];

if ($bandera == 'enviar') {
    echo "<script type='text/javascript'>";
    echo "document.location.href='editproductos.php?id=" . $baccion . "';";
    echo "</script>";
    # code...
}
if ($bandera=="add") {
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
  if ($accion==1) {
    //va a ser compra
    // $productosDisponibles=$productosDisponibles+$cantidad;
    $nuevoValorTotalS=$vtotalS+$subtotalK;

    $nuevoValorTotalS=number_format($nuevoValorTotalS, 2, ".", "");
    $valorUnitarioS=$nuevoValorTotalS/$productosDisponibles;
    $valorUnitarioS=number_format($valorUnitarioS, 2, ".", "");
    $consulta3  = "INSERT INTO kardex VALUES('null','" . $idproducto . "','" . $fecha . "','" . $descripcion . "','" . $accion . "','" . $cantidad . "','" . $vunitario . "','" . $productosDisponibles . "','" . $valorUnitarioS . "','" . $nuevoValorTotalS . "')";
    $resultado3 = $conexion->query($consulta3);
    if ($resultado3) {
        //msg("Exito Compra");
        //AHORA A ACTUALIZAR LOS NUEVOS VALORES QUE TENDRA DICHO Producto
        //nuevo precio del productos
        // $tporcen=$valorUnitarioS*$margen;
        // $nuevoPrecio=$vunitario/(1-$margen);
        // $nuevoPrecio=number_format($nuevoPrecio, 2, ".", "");
        // $consulta4="UPDATE productos set cantidadproductos='".$cantidadP."',preciocompra='".$vunitario."',precioventa='".$nuevoPrecio."' where idproductos='".$idproducto."'";
        // $resultado = $conexion->query($consulta4);
        // if ($resultado) {
          //  msg("Exito Producto");
          // header('Location:Kardex.php?id='.$idproducto);
          echo "Guardo compra kardex";
        // } else {
        //     //msg("No Exito Producto");
        // }
      } else {
        msg(mysqli_error($conexion));
    }
  }else {
    //va a ser una venta
    // $productosDisponibles=$productosDisponibles-$cantidad;
    $nuevoValorTotalS=$vtotalS-$subtotalK;
    $nuevoValorTotalS=number_format($nuevoValorTotalS, 2, ".", "");
    $valorUnitarioS=$nuevoValorTotalS/$productosDisponibles;
    $valorUnitarioS=number_format($valorUnitarioS, 2, ".", "");
    $consulta3  = "INSERT INTO kardex VALUES('null','" . $idproducto . "','" . $fecha . "','" . $descripcion . "','" . $accion . "','" . $cantidad . "','" . $vunitario . "','" . $productosDisponibles . "','" . $valorUnitarioS . "','" . $nuevoValorTotalS . "')";
    $resultado3 = $conexion->query($consulta3);
    if ($resultado3) {
        //msg("Exito Compra");
        //AHORA A ACTUALIZAR LOS NUEVOS VALORES QUE TENDRA DICHO Producto
        //nuevo precio del productos
        // $consulta4="UPDATE productos set cantidadproductos='".$cantidadP."'where idproductos='".$idproducto."'";
        // $resultado = $conexion->query($consulta4);
        // if ($resultado) {
        //   //  msg("Exito Producto");
        echo "Guardo venta";
          // header('Location:kardex.php?id='.$idproducto);
        // } else {
        //     //msg("No Exito Producto");
        // }
      } else {
        msg(mysqli_error($conexion));
    }
}
}

?>
