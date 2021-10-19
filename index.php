<!DOCTYPE html>
<html lang="es" dir="ltr">
  <head>
     <meta charset="utf-8">
     <title>Estación de monitoreo</title>

     <!--Links css de bootstrap-->
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" 
     rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" 
     crossorigin="anonymous">

     <!--Links js de bootstrap-->
     <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"
       integrity="sha384-q2kxQ16AaE6UbzuKqyBE9/u/KzioAlnx2maXQHiDX9d4/zp8Ok3f+M7DPm+Ib6IU" crossorigin="anonymous"></script>
     <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.min.js" 
      integrity="sha384-pQQkAEnwaBkjpqZ8RU1fF1AKtTcHJwFl3pblpTlHXybJjHpMYo79HY3hIi4NKxyj" crossorigin="anonymous"></script>

      <!--Links de font-awesome-->
      <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" 
      integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">

      <!--Links chart-js -->
      <script src="https://cdn.jsdelivr.net/npm/chart.js@latest/dist/Chart.min.js"></script>

     <!--Conexion con estilos.css-->
      <link rel="stylesheet" href="css/estilos.css"> 

  </head>
  <body>
  <?php
    include('conexion.php');
    $sql = "SELECT temperatura,humedad,lluvia,fecha_hora FROM registro ORDER BY fecha_hora DESC LIMIT 10";
    $datos_temp = array();
    $datos_hum = array();
    $fecha_hora = array();
    $lluvia = 0;
    $query = $conexion->query($sql);
    $cont = 0;
    while ($row = $query->fetch_assoc()){
        if($cont == 0){
            $lluvia = $row['lluvia'];
        }
        array_push($datos_temp,$row['temperatura']);
        array_push($datos_hum,$row['humedad']);
        array_push($fecha_hora,$row['fecha_hora']);
        $cont++;
    }
?>
    <nav class="navbar navbar-expand-sm navbar-dark">
        <div class="container-fluid bg-info py-4 text-center text-light">
           <div class="container">
                <h1 class="t1">Estación Meteorologica</h1>
            </div>
        </div>
    </nav>
    <div class="row c1">
        <div class="col-sm-1"></div>
        <div class="col-sm-3 alert alert-info alert-hover">
            <h2 class="text-center">Temperatura :</h2><br>
            <h2 class="text-center"><?php echo $datos_temp[0]." °C"; ?></h2>
        </div>
        <div class="col-sm-1"></div>
        <div class="col-sm-3 alert alert-success alert-hover">
            <h2 class="text-center">Humedad :</h2><br>
            <h2 class="text-center"><?php echo $datos_hum[0]." %"; ?></h2>
        </div>
        <div class="col-sm-1"></div>
        <div class="col-sm-2 alert alert-light alert-hover text-info">
            <h2 class="text-right">Lluvia :</h2>
            <?php if($lluvia == 1){ ?>
                <h3 class="text-center text-success">
                    <?php echo "Está lloviendo"; ?>
                    <p><i class="fas fa-cloud-rain fa-sm"></i></p>
                </h3>
                <?php }else{ ?>
                    <h3 class="text-center text-danger">
                    <?php echo "No se ha detectado lluvia"; ?>
                    <p><i class="fas fa-cloud-rain fa-sm"></i></p>
                </h3>
            <?php } ?>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-6">
        <canvas id="temperatureChart"  height="130px">
          <script>
            var temperatureCanvas = document.getElementById("temperatureChart");
            Chart.defaults.global.defaultFontFamily = "Lato";
            Chart.defaults.global.defaultFontSize = 18;
            var temperatureData = {   
                labels: 
                    [<?php for($i = count($fecha_hora)-1; $i >= 0; $i--){?>
                        "<?php echo $fecha_hora[$i]; ?>",
                    <?php } ?> ],
                datasets: [{
                    label: "Temperatura(°C) ",
                    data:
                        [<?php for($i = count($fecha_hora)-1; $i >= 0; $i--){ ?> 
                            <?php echo $datos_temp[$i]; ?>,
                        <?php } ?>   ],
                    lineTension: 0,
                    fill: false,
                    borderColor: 'blue',
                    backgroundColor: 'transparent',
                    borderDash: [5, 5],
                    pointBorderColor: 'orange',
                    pointBackgroundColor: 'rgba(255,150,0,0.5)',
                    pointRadius: 5,
                    pointHoverRadius: 10,
                    pointHitRadius: 30,
                    pointBorderWidth: 2,
                    pointStyle: 'rectRounded'
                }]
            };
            var chartOptions = {    
            legend: {
             display: true,
                 position: 'top',
                labels: {
                 boxWidth: 80,
                 fontColor: 'navy'
             }
             }
            };
            var lineChart = new Chart(temperatureCanvas, {
                type: 'line',
                data: temperatureData,
                options: chartOptions
            });
          </script>
         </canvas>
        </div>
        <div class="col-sm-6">
            <canvas id="humidityChart" height="130px">
                <script>
                    var humidityCanvas = document.getElementById("humidityChart");
                    Chart.defaults.global.defaultFontFamily = "Lato";
                    Chart.defaults.global.defaultFontSize = 18;
                    var humidityData = {   
                        labels: 
                            [<?php for($i = count($fecha_hora)-1; $i >= 0; $i--){?>
                                "<?php echo $fecha_hora[$i]; ?>",
                            <?php } ?> ],
                        datasets: [{
                            label: "Humedad(%) ",
                            data:
                                [<?php for($i = count($fecha_hora)-1; $i >= 0; $i--){?> 
                                    <?php echo $datos_hum[$i]; ?>,
                                <?php } ?>   ],
                            lineTension: 0,
                            fill: false,
                            borderColor: 'green',
                            backgroundColor: 'transparent',
                            borderDash: [5, 5],
                            pointBorderColor: 'orange',
                            pointBackgroundColor: 'rgba(255,150,0,0.5)',
                            pointRadius: 5,
                                pointHoverRadius: 10,
                            pointHitRadius: 30,
                            pointBorderWidth: 2,
                            pointStyle: 'rectRounded'
                        }]
                    };
                    var chartOptions = {    
                    legend: {
                    display: true,
                        position: 'top',
                        labels: {
                         boxWidth: 80,
                         fontColor: 'navy'
                    }
                    }
                    };
                    var lineChart = new Chart(humidityCanvas, {
                        type: 'line',
                        data: humidityData,
                        options: chartOptions
                    });
                </script>
            </canvas>
        </div>
    </div>
  </body>
</html>