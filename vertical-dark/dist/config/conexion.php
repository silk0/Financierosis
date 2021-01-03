<?php

$conexion = new mysqli('localhost', 'root', '', 'finanzadb');
if ($conexion->connect_errno) {
    echo "Error de conexion";
}
?>