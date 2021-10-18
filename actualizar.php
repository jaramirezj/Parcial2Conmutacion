<?php
include('conexion.php');
    if(isset($_GET["temperatura"])&&isset($_GET["humedad"])&&isset($_GET["lluvia"])){
        $temperatura = $_GET["temperatura"];
        $humedad =  $_GET["humedad"];
        $lluvia = $_GET["lluvia"];
        $sql = "INSERT INTO registro (temperatura,humedad,lluvia) VALUES ($temperatura,$humedad,$lluvia)";
        $query = $conexion->query($sql);
        if(!$query){echo "Error de insercion";}
    }
?>