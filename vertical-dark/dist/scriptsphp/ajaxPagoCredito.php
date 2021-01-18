<?php 
   
    include '../config/conexion.php';
    $bandera=$_REQUEST['bandera'];    
    //  Obtener la cartera a la que pertenece el cliente.
    $id_cl = $_POST['id_cliente'];
    $codI = $_POST['ventaId'];
    $codC = $_POST['ventaCod'];    
    $emp = $_POST['id_empleado'];
    $totalV = $_POST['totalV'];

    $cuotaF = $_POST['primerC'];
    $inter = $_POST['interesN'];
    $meses = $_POST['meses'];    
    $total = str_replace("$","",$_POST['total']);
    

    /*echo $total;*/
    if($bandera==0){

       
        $result = $conexion->query("insert into
            tventas(id_cliente,codigo,id_plan,id_empleado,prestamo_original,saldo_actual,
            mora_acumulada,intereses_acumulados,estado,proximo_pago,fecha,interes,prima,meses)
            values ('".$id_cl."', 
            '".$codC."', 
            null,
            '".$emp."',
            '".$total."','".$total."',0,0,'Pendiente','".$cuotaF."',now(),'".$inter."',0,'".$meses."');");
        if ($result) {            
            $result = $conexion->query("insert into tdetalle_venta(
                id_venta,
                id_producto,
                cantidad,
                preciovendido,
                tipo)
            select '".$codI."',t.id_producto,
            t.cantidad,
            (select p.precio_venta from tproducto p where t.id_producto = p.id_producto),1
            from tcarrito t;
               ");
            if ($result) {
                $result = $conexion->query("insert into kardex( id_producto, fecha, descripcion, movimiento, cantidad,
                vunitario, cantidads, vunitarios, vtotals)
                select t.id_producto, now(), concat('Venta  No.','".$codC."',' al credito.'),2, t.cantidad,p.precio_compra,
                    p.stock-t.cantidad,p.precio_compra,p.precio_compra*(p.stock-t.cantidad)
                from tcarrito t inner join tproducto p on t.id_producto = p.id_producto;
                ");
                if ($result) {
                    
                    $result = $conexion->query("update tproducto  as p
                        join tcarrito c
                        on p.id_producto = c.id_producto
                        set p.stock = (p.stock-c.cantidad);"
                    );
                    if ($result) {                        
                        
                        $result = $conexion->query("TRUNCATE TABLE tcarrito;");
                        if ($result) {
                            $fecha = date("Y-m-d", strtotime($cuotaF));
                            for ($i = 1; $i <= $meses; $i++) {
                                
                                $result = $conexion->query("insert into 
                                tpago(id_venta, monto, fecha, mora, estado) 
                                values ('".$codI."','".$total/$meses."','".$fecha."',0,0);"
                                );
                                if(!$result)
                                    echo "Error en crear pagos";
                                $fecha = date("Y-m-d",strtotime($fecha."+ 1 month"));
                                
                            }
                            
                            header('Location:../venderCredito.php');                                   
                                    
                        }else
                            echo "no se elimino los datos del carrito";      
                          
                    }else
                    echo "No se actualizo inventario";      
                         
                }else{
                    echo "no se inserto kardex";      
                }                             
            }else
                echo "error no se realizo el detalle de venta";      
        }else
            echo "error no se realizo la venta al contado";  
    }

?>