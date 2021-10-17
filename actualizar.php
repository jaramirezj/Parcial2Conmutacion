<?php
include('conexion.php');
    if(isset($_GET["temperatura"])&&isset($_GET["temperatura"])){
        $temperatura = $_GET["temperatura"];
        $humedad =  $_GET["humedad"];
        $sql = "INSERT INTO registro (temperatura,humedad) VALUES ($temperatura,$humedad)";
        $query = $conexion->query($sql);
        if(!$query){echo "Error de insercion";}
    }
?>