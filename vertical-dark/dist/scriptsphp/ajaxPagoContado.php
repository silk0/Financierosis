<?php 
   
    include '../config/conexion.php';
    $bandera=$_REQUEST['bandera'];
    
    //  Obtener la cartera a la que pertenece el cliente.
    $id_cl = $_POST['id_cliente'];
    $codI = $_POST['ventaId'];
    $codC = $_POST['ventaCod'];
    $emp = $_POST['id_empleado'];
    $totalV = $_POST['totalV'];
    echo $totalV;
    if($bandera==0){

       
        $result = $conexion->query("insert into
            tventas(
            id_cliente,
            codigo,
            id_plan,
            id_empleado,
            prestamo_original,
            saldo_actual,
            mora_acumulada,
            intereses_acumulados,
            estado,
            proximo_pago,
            fecha,
            interes,
            prima)
            values ('".$id_cl."', 
            '".$codC."', 
            null,
            '".$emp."',
            '".$totalV."','".$totalV."',0,0,'Cancelado',now(),now(),0,0 );");
        if ($result) {            
            $result = $conexion->query("insert into tdetalle_venta(
            id_venta,
            id_producto,
            cantidad,
            preciovendido,
            tipo)
            select '".$codI."',t.id_producto,
            t.cantidad,
            (select p.precio_venta from tproducto p where t.id_producto = p.id_producto),0
            from tcarrito t;
               ");
            if ($result) {
                $result = $conexion->query("insert into kardex( id_producto, fecha, descripcion, movimiento, cantidad,
                vunitario, cantidads, vunitarios, vtotals)
                select t.id_producto, now(), concat('Venta  No.','".$codC."',' al contado.'),2, t.cantidad,p.precio_compra,
                    p.stock-t.cantidad,p.precio_compra,p.precio_compra*(p.stock-t.cantidad)
                from tcarrito t inner join tproducto p on t.id_producto = p.id_producto;
                ");
                if ($result) {
                    
                    $result = $conexion->query("update tproducto  as p
                    join tcarrito c
                    on p.id_producto = c.id_producto
                    set p.stock = (p.stock-c.cantidad);");
                    if ($result) {
                        $result = $conexion->query("insert into tbanco(descripcion, cantidad, id_venta)  
                        values(concat('Venta al contado el ',DATE_FORMAT(now(), '%d/%m/%Y'),' No.',
                        '".$codC."'),'".$totalV."','".$codI."');");
                        if ($result) {
                            $result = $conexion->query("TRUNCATE TABLE tcarrito;");
                            if ($result) {
                                
                                header('Location:../venderContado.php?bandera=1');                                   
                                        
                            }else
                                echo "no se elimino los datos del carrito";      
                        }else{
                            echo "no se guardo dinero en el la tabla banco"; 
                        }  
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