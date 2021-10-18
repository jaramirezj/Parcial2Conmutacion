<?php
include('conexion.php');
    if(isset($_GET["lluvia"])){
        $lluvia = $_GET["lluvia"];
        $sql = "UPDATE INTO registro SET lluvia=$lluvia ORDER BY fecha_hora DESC LIMIT 1";
        $query = $conexion->query($sql);
        if(!$query){echo "Error de insercion";}
    }
?>