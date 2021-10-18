<?php
include('conexion.php');
    $sql = "SELECT temperatura,humedad,lluvia,fecha_hora FROM registro ORDER BY fecha_hora DESC ";
    $datos_temp = array();
    $datos_hum = array();
    $fecha_hora = array();
    $lluvia = 0;
    $query = $conexion->query($sql);
    int cont = 0;
    while ($row = $query->fetch_assoc()){
        if($cont == 0){
            $lluvia = $row['temperatura'];
        }
        array_push($datos_temp,$row['temperatura']);
        array_push($datos_hum,$row['humedad']);
        array_push($fecha_hora,$row['fecha_hora']);
    }
?>