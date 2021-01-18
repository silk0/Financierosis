<?php
    include "../config/conexion.php";
    
    $bandera = $_POST["bandera"];
        if($bandera=="Guardar"){
            $tipoA   = $_POST["tipoA"];
            $depa   = $_POST["depa"];
            $emple   = $_POST["emple"];
            $prove   = $_POST["prove"];
            $corre   = $_POST["correlativo"];
            $f  = $_POST["fecha"];
            $fechaBD = date("Y-m-d", strtotime($f));
            $observ   = $_POST["observ"];
            $valor   = $_POST["valor"];
            $marca   = $_POST["marca"];
            $tipo   = $_POST["tipo"];
        if($tipo==1){
            $tipo="Nuevo";
        }else if($tipo==2){
            $tipo="Usado";
        }else if($tipo==3){
            $tipo="Donado";
        }

        $resultado = $conexion->query("insert into tactivo (id_tipo,id_departamento,id_encargado,id_proveedor,
        correlativo,fecha_adquisicion,descripcion,estado,precio,marca, depreciacionacum,
        tipo_adquicicion)
        select(select id_tipo from ttipo_activo where correlativo='".$tipoA."'),
        (select id_departamento from tdepartamento where correlativo= '".$depa."'),
        '".$emple."','".$prove."','".$corre."','".$fechaBD."','".$observ."','1','".$valor."','".$marca."',0.0,'".$tipo."';");

        if ($resultado) {
            header('Location:../ingresoActivo.php');  
        } else {
            echo 'No funciona';  
        }        
       
    }
?>