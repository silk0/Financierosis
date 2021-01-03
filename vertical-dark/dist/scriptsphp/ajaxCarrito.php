<?php 
error_reporting(E_ALL ^ E_NOTICE);
$id=$_POST['id'];
$op=$_POST['op'];
$cantidadDeseada=$_POST['cantidadDeseada'];
// echo "ID:".$id."-OP:".$op."Cantidad Deseada:".$cantidadDeseada;

// Primero validamos si existe en el carrito el producto que queremos agregar
include "../config/conexion.php";
if ($op==1) {
    $result = $conexion->query("SELECT * from tcarrito where id_producto=".$id);
if ($result->num_rows==0) {
    //Cuando no exista ese producto, entonces se va a agrregar a ala tabla temporal
    // echo "No existe ese  producto, agregara en tcarrito";
     $consulta  = "INSERT INTO tcarrito VALUES('null','".$id."','".$cantidadDeseada."')";
    $resultado = $conexion->query($consulta);
      if ($resultado) {
          $resultCant = $conexion->query("SELECT * from tcarrito");
        
         echo "<span>".$resultCant->num_rows."</span>";
      } else {
          echo "Ocurrio un error al agregar los datos al carrito.";
      }
    }else{
        //Cuando ya exista, nada amas se va a actualizar la cantidad que se desea
      
        $consulta  = "UPDATE tcarrito set cantidad='" . $cantidadDeseada . "' where id_producto='" . $id . "'";
        $resultado = $conexion->query($consulta);
   
      if ($resultado) {         
           //echo "Se modifico la cantidad deseada exitosamente.";
            $resultCant = $conexion->query("SELECT * from tcarrito");
        
         echo "<span>".$resultCant->num_rows."</span>";

      } else {
          echo "Error al modificar la cantidad deseada";
      }
    }
}else if($op==2){
    // Va a quitar del carrito
    
    $consulta  = "DELETE from tcarrito where id_producto='" . $id . "'";
    $resultado = $conexion->query($consulta);
    if($resultado){
        $resultCant = $conexion->query("SELECT * from tcarrito");
        
         echo "<span>".$resultCant->num_rows."</span>";

    }else{
        echo "No se pudo eliminar el producto del carrito.";
    }
}else{
     $consulta  = "TRUNCATE TABLE tcarrito";
    $resultado = $conexion->query($consulta);
    if($resultado){
        $resultCant = $conexion->query("SELECT * from tcarrito");
        
         echo "<span>".$resultCant->num_rows."</span>";

    }else{
        echo "No se pudo eliminar el producto del carrito.";
    }
}



?>