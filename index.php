<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>RD2T</title>
    <link rel="stylesheet" href="style.css">
    <script type="text/javascript" src="mapFunctions.js"></script>
</head>

<body>
<?php
function debugFunction()
{
    echo 'I just ran a php function';
    echo "<h6>Name " . $_GET["file"] . "</h6>";
}


function initMapJS($markers)
{
    $jsMarkers = json_encode($markers);
    echo '<script type="text/javascript" src="mapFunctions.js">';
    echo 'var jsMarkers ='.$jsMarkers.';';
    echo 'initMap(jsMarkers);';
    echo '</script>';
}



function loadCSVdata()
{
    $data = file_get_contents('C:/Users/Mary Luz/Documents/Informatica/TFG/RD2T/output/' . $_GET["file"] . '/' . $_GET["file"] . '.csv');
    $lines = explode("\n\n", $data);

    foreach ($lines as $key => $value) {
        if ($key > 0 && strlen($value) > 10) { // skip csv header row and blank rows
            $line = explode(",", $value); // Separador ,
            // Nombre de estación, latitud, longitud, Nivel, Variable, Previsión
            $markers[$key] = trim($line[1]) . ',' . trim($line[2]) . ',' . trim($line[3]) . ',' . trim($line[4]) . ',' . trim($line[5]) . ',' . trim($line[6]);
        }
    }

$counter = 0;

    initMapJS($markers);
}

if (isset($_GET['loadData'])) {
    loadCSVdata();
}
?>


<section id="menuSection" class="menuSection">
    <a id="tituloMenu" class="menuItem">Pronósticos</a>
    <a href="index.php?loadData=true&file=Roadcast_2018-01-26" class="menuItem">Roadcast_2018-01-26</a>
    <a href="index.php?loadData=true&file=Roadcast_2018-02-14" class="menuItem">Roadcast_2018-02-14</a>
    <a href="index.php?loadData=true&file=Roadcast_2018-03-23" class="menuItem">Roadcast_2018-03-23</a>
    <a href="index.php?loadData=true&file=Roadcast_2018-04-01" class="menuItem">Roadcast_2018-04-01</a>
</section>
<section id="map" class="map"/>
<script type="text/javascript"
src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD_ohx4ay8JsbMcpbCDEcaxEUp36gMrUiQ"></script>

<script>
    google.maps.event.addDomListener(window, 'load', initMap);
</script>

</body>

</html>