<?php 
$id=$_POST['id_producto'];
$op=$_REQUEST['op'];
//echo "ID:".$id."-OP:".$op."Cantidad Deseada:".$cantidadDeseada;

// Primero validamos si existe en el carrito el producto que queremos agregar
include "../config/conexion.php";
if ($op==1) {    
    $cantidadDeseada=$_POST['carritoA'];
    $result = $conexion->query("SELECT * from tcarrito where id_producto=".$id);
    if ($result->num_rows==0) {
        //Cuando no exista ese producto, entonces se va a agrregar a ala tabla temporal
        // echo "No existe ese  producto, agregara en tcarrito";
        $consulta  = "INSERT INTO tcarrito VALUES('null','".$id."','".$cantidadDeseada."')";
        $resultado = $conexion->query($consulta);
        if ($resultado) {
            $resultCant = $conexion->query("SELECT * from tcarrito");
            
            header('Location:../listadoProducto.php');      
        } else {
            echo "Ocurrio un error al agregar los datos al carrito.";
        }
        }else{
            //Cuando ya exista, nada amas se va a actualizar la cantidad que se desea
        
            $consulta  = "UPDATE tcarrito set cantidad='" . $cantidadDeseada . "' where id_producto='" . $id . "'";
            $resultado = $conexion->query($consulta);
    
            if ($resultado) {         
                //echo "Se modifico la cantidad deseada exitosamente.";
                    header('Location:../listadoProducto.php');    
            } else {
                header('Location:../listadoProducto.php');
            }
        }
    }else if($op==2){
    // Va a quitar del carrito
    
    $consulta  = "DELETE from tcarrito where id_producto='" . $id . "'";
    $resultado = $conexion->query($consulta);
    if($resultado){
        $resultCant = $conexion->query("SELECT * from tcarrito");
        
        header('Location:../carrito.php');

    }else{
        echo "No se pudo eliminar el producto del carrito.";
    }
}else{
    $consulta  = "TRUNCATE TABLE tcarrito";
    $resultado = $conexion->query($consulta);
    if($resultado){
        $resultCant = $conexion->query("SELECT * from tcarrito");
        
         echo "<span>".$resultCant->num_rows."</span>";
         header('Location:../carrito.php');

    }else{
        echo "No se pudo eliminar el producto del carrito.";
    }
}



?>