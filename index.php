
<?php
require_once("conf.php");
include("config.php")
?>
<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>phpChart -lalallasive!</title>
<link rel="stylesheet" href="css/bootstrap.min.css">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
</head>
<body>
<div class="button">
<a href="javascript:location.reload()" class="btn btn-lg btn-primary mt-3 ml-3"><i class="fas fa-sync"></i> Reload</a>
</div>
<?php

	$consulta = "SELECT * FROM temperatura ORDER BY id DESC LIMIT 10";
                $ejecutar= mysqli_query($con, $consulta);
                $i=0;
				$valores = array();
                while ($fila =  mysqli_fetch_array($ejecutar) and ($i<10)){
                    $id=$fila['id'];
					$valor=$fila['valor'];
				$i++;
				array_push($valores,floatval($valor));
                }
                $valores = array_reverse($valores);
				print_r($valores);
$pc = new C_PhpChartX(array($valores),'basic_chart');
$pc->set_title(array('text'=>'Historial de Temperaturas'));
$pc->set_animate(true);
$pc->set_grid(array(
    'background'=>'lightblue',
    'borderWidth'=>0,
    'borderColor'=>'#0101DF',
    'shadow'=>true,
    'shadowWidth'=>10,
    'shadowOffset'=>3,
    'shadowDepth'=>3,
    'shadowColor'=>'rgba(230, 230, 230, 0.7)'
    ));

$pc->draw();
?>

<style>
    .jqplot-target{
        position: relative !important;
        width: auto !important;
    }
</style>
<script>
jQuery(document).ready(function($){
    $(window).on("resize",function(event){
        $.each(_chart1.series, function(index, series) { series.barWidth = undefined; });
        _chart1.destroy(); // Destroy the chart..
        _chart1.replot(); // Replot the chart with new/old values..
    });
});
</script>
</body>
</html>
