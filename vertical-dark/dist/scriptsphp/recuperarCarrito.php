<?php  
$manu;
$menu='
                                    <div class="hd-mg-tt">
                                        <h2>Productos en carrito.</h2>
                                    </div>
                                    <div class="hd-message-info">';
include "../config/conexion.php";
$result = $conexion->query("select p.nombre as nombre, c.cantidad as cantidadDeseada from tcarrito as c, tproducto as p where c.id_producto=p.id_producto");
if ($result) {
    while ($fila = $result->fetch_object()) {
         $menu=$menu.' <a href="#">
                                            <div class="hd-message-sn">
                                                <div class="hd-message-img">
                                                    <img height="42" width="42" src="img/post/producto.png" alt="" />
                                                </div>
                                                <div class="hd-mg-ctn">
                                                    <h3>'.$fila->nombre.'</h3>
                                                    <p>En carrito:'.$fila->cantidadDeseada.' productos.</p>
                                                </div>
                                            </div>
                                        </a>';   

    }
}

$menu=$menu.' </div>
                                    <div class="hd-mg-va">
                                        <a href="verCarrito.php">Ir al carrito.</a>
                                    </div>';
echo $menu;                                                                            
                                   





?>