<?php

if (isset($_GET['loadData'])) {
    $data = file_get_contents('C:/Users/Mary Luz/Documents/Informatica/TFG/RD2T/output/' . $_GET["file"] . '/' . $_GET["file"] . '.csv');
    $lines = explode("\n\n", $data);

    foreach ($lines as $key => $value) {
        if ($key > 0 && strlen($value) > 10) { // skip csv header row and blank rows
            $line = explode(",", $value); // Separador ,
            $markers[$key] = trim($line[1]) . ',' . trim($line[2]) . ',' . trim($line[3]) . ',' . trim($line[4]) . ',' . trim($line[5]) . ',' . trim($line[6]); // Nombre de estación, latitud, longitud, Nivel, Variable, Previsión

        }
    }
}
?>
<script type="text/javascript">
    var map;
    var marker = {};


    var icon = {
        url: ' ',
        fillColor: '#FF0000',
        fillOpacity: 1,
        anchor: new google.maps.Point(0, 0),
        strokeWeight: 0,
        scaledSize: new google.maps.Size(29, 29),

    }


    function initMap() {
        var mapOptions = {
            center: {lat: 42.85, lng: -7.55299}, //TODO: PONER EL CENTRO DE GALICIA
            zoom: 8.2
        };
        map = new google.maps.Map(document.getElementById('map'), mapOptions);
        var markers = [];
        <?php
        $counter = 0;

        foreach ($markers as $index => $list) {
            $marker_details = explode(',', $list);
            echo 'markers["m' . ($index - 1) . '"] = {};' . "\n";
            echo "markers['m" . ($index - 1) . "'].name = '" . $marker_details[0] . "';\n";
            echo "markers['m" . ($index - 1) . "'].lat = '" . $marker_details[1] . "';\n";
            echo "markers['m" . ($index - 1) . "'].lon = '" . $marker_details[2] . "';\n";
            echo "markers['m" . ($index - 1) . "'].level = '" . $marker_details[3] . "';\n";
            echo "markers['m" . ($index - 1) . "'].variable = '" . $marker_details[4] . "';\n";
            echo "markers['m" . ($index - 1) . "'].content = '" . $marker_details[5] . "';\n";
            $counter++;

        }
        ?>
        var totalMarkers = <?=$counter?>;
        var i = 0;
        var infowindow;
        var contentString;
        for (var i = 0; i < totalMarkers; i++) {

            contentString =
                '<div class="content">' +
                '<h1 class="firstHeading">' + markers['m' + i].name + '</h1>' +
                '<div class="bodyContent">' +
                '<table id="map-infowindow-attribute-table">' +
                '<tbody>' +
                '<tr id="map-infowindow-attr-Nivel-container">' +
                '<td class="infoDetailLabel-haAclf">' +
                '<div class="infoDetailLabel" id="map-infowindow-attr-Nivel-name" aria-label="Nivel" data-tooltip="Nivel">Nivel</div>' +
                '</td>' +
                '<td class="infoDetailContet-haAclf">' +
                '<div class="infoDetailContet" id="map-infowindow-attr-Nivel-value">' + markers['m' + i].level + '</div>' +
                '</td>' +
                '</tr>' +
                '<tr id="map-infowindow-attr-Variable-container">' +
                '<td class="infoDetailLabel-haAclf">' +
                '<div class="infoDetailLabel" id="map-infowindow-attr-Variable-name" aria-label="Variable" data-tooltip="Variable">Variable</div>' +
                '</td>' +
                '<td class="infoDetailContet-haAclf">' +
                '<div class="infoDetailContet" id="map-infowindow-attr-Variable-value">' + markers['m' + i].variable + '</div>' +
                '</td>' +
                '</tr>' +

                '<tr id="map-infowindow-attr-Latitud-container">' +
                '<td class="infoDetailLabel-haAclf">' +
                '<div class="infoDetailLabel" id="map-infowindow-attr-Latitud-name" aria-label="Latitud" data-tooltip="Latitud">Latitud</div>' +
                '</td>' +
                '<td class="infoDetailContet-haAclf">' +
                '<div class="infoDetailContet" id="map-infowindow-attr-Latitud-value">' + markers['m' + i].lat + '</div>' +
                '</td>' +
                '</tr>' +
                '<tr id="map-infowindow-attr-Longitud-container">' +
                '<td class="infoDetailLabel-haAclf">' +
                '<div class="infoDetailLabel" id="map-infowindow-attr-Longitud-name" aria-label="Longitud" data-tooltip="Longitud">Longitud</div>' +
                '</td>' +
                '<td class="infoDetailContet-haAclf">' +
                '<div class="infoDetailContet" id="map-infowindow-attr-Longitud-value">' + markers['m' + i].lon + '</div>' +
                '</td>' +
                '</tr>' +
                '<tr id="map-infowindow-attr-Previsión-container">' +
                '<td class="infoDetailLabel-haAclf">' +
                '<div class="infoDetailLabel" id="map-infowindow-attr-Previsión-name" aria-label="Previsión" data-tooltip="Previsión">Previsión</div>' +
                '</td>' +
                '<td class="infoDetailContet-haAclf">' +
                '<div class="infoDetailContet" id="map-infowindow-attr-Previsión-value">' + markers['m' + i].content + '</div>' +
                '</td>' +
                '</tr>' +
                '</tbody>' +
                '</table>' +
                '</div>' +
                '</div>';

            infowindow = new google.maps.InfoWindow({
                content: contentString,
                maxWidth: 325
            });

            setIcon(icon, markers['m' + i].level, markers['m' + i].variable);

            marker['c' + i] = new google.maps.Marker({
                position: new google.maps.LatLng(markers['m' + i].lat, markers['m' + i].lon),
                map: map,
                icon: icon,
                title: markers['m' + i].name,
                infowindow: infowindow
            });


            google.maps.event.addListener(marker['c' + i], 'click', function () {
                for (var key in marker) {
                    marker[key].infowindow.close();
                }
                this.infowindow.open(map, this);

            });
        }

    }

    function setIcon(icon, level, variable) {
        if (level === 'Negro') {
            switch (variable) {
                case 'Lluvia':
                    icon.url = '/rainBlack.svg';
                    break;
                case 'Visibilidad':
                    icon.url = '/fogBlack.svg';
                    break;
                case 'Nieve':
                    icon.url = '/snowBlack.svg';
                    break;
                case 'Viento':
                    icon.url = '/windBlack.svg';
                    break;
            }
        } else if (level === 'Rojo') {
            switch (variable) {
                case 'Lluvia':
                    icon.url = '/rainRed.svg';
                    break;
                case 'Visibilidad':
                    icon.url = '/fogRed.svg';
                    break;
                case 'Nieve':
                    icon.url = '/snowRed.svg';
                    break;
                case 'Viento':
                    icon.url = '/windRed.svg';
                    break;
            }
        } else if (level === 'Amarillo') {
            switch (variable) {
                case 'Lluvia':
                    icon.url = '/rainYellow.svg';
                    break;
                case 'Visibilidad':
                    icon.url = '/fogYellow.svg';
                    break;
                case 'Nieve':
                    icon.url = '/snowYellow.svg';
                    break;
                case 'Viento':
                    icon.url = '/windYellow.svg';
                    break;
            }
        } else if (level === 'Verde') {
            switch (variable) {
                case 'Lluvia':
                    icon.url = '/rainGreen.svg';
                    break;
                case 'Visibilidad':
                    icon.url = '/fogGreen.svg';
                    break;
                case 'Nieve':
                    icon.url = '/snowGreen.svg';
                    break;
                case 'Viento':
                    icon.url = '/windGreen.svg';
                    break;
            }
        } else {
            icon.url = '/default.svg';
        }
    }


    google.maps.event.addDomListener(window, 'load', initMap);

</script>