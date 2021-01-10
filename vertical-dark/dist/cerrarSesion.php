<?php
	@session_start();
	session_destroy();
    include "config/conexion.php";
	header("Location: ../../index.php");
 ?>