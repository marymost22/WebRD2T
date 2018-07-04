function getContentInfoHTML(marker) {
    contentString =
        '<div class="content">' +
        '<h1 class="firstHeading"/' + marker.name + '>' +
        '<div class="bodyContent">' +
        '<table id="map-infowindow-attribute-table">' +
        '<tbody>' +
        '<tr id="map-infowindow-attr-Nivel-container">' +
        '<td class="infoDetailLabel-haAclf">' +
        '<div class="infoDetailLabel" id="map-infowindow-attr-Nivel-name" aria-label="Nivel" data-tooltip="Nivel">Nivel</div>' +
        '</td>' +
        '<td class="infoDetailContet-haAclf">' +
        '<div class="infoDetailContet" id="map-infowindow-attr-Nivel-value">' + marker.level + '</div>' +
        '</td>' +
        '</tr>' +
        '<tr id="map-infowindow-attr-Variable-container">' +
        '<td class="infoDetailLabel-haAclf">' +
        '<div class="infoDetailLabel" id="map-infowindow-attr-Variable-name" aria-label="Variable" data-tooltip="Variable">Variable</div>' +
        '</td>' +
        '<td class="infoDetailContet-haAclf">' +
        '<div class="infoDetailContet" id="map-infowindow-attr-Variable-value">' + marker.variable + '</div>' +
        '</td>' +
        '</tr>' +

        '<tr id="map-infowindow-attr-Latitud-container">' +
        '<td class="infoDetailLabel-haAclf">' +
        '<div class="infoDetailLabel" id="map-infowindow-attr-Latitud-name" aria-label="Latitud" data-tooltip="Latitud">Latitud</div>' +
        '</td>' +
        '<td class="infoDetailContet-haAclf">' +
        '<div class="infoDetailContet" id="map-infowindow-attr-Latitud-value">' + marker.lat + '</div>' +
        '</td>' +
        '</tr>' +
        '<tr id="map-infowindow-attr-Longitud-container">' +
        '<td class="infoDetailLabel-haAclf">' +
        '<div class="infoDetailLabel" id="map-infowindow-attr-Longitud-name" aria-label="Longitud" data-tooltip="Longitud">Longitud</div>' +
        '</td>' +
        '<td class="infoDetailContet-haAclf">' +
        '<div class="infoDetailContet" id="map-infowindow-attr-Longitud-value">' + marker.lon + '</div>' +
        '</td>' +
        '</tr>' +
        '<tr id="map-infowindow-attr-Previsión-container">' +
        '<td class="infoDetailLabel-haAclf">' +
        '<div class="infoDetailLabel" id="map-infowindow-attr-Previsión-name" aria-label="Previsión" data-tooltip="Previsión">Previsión</div>' +
        '</td>' +
        '<td class="infoDetailContet-haAclf">' +
        '<div class="infoDetailContet" id="map-infowindow-attr-Previsión-value">' + marker.content + '</div>' +
        '</td>' +
        '</tr>' +
        '</tbody>' +
        '</table>' +
        '</div>' +
        '</div>';

    return contentString;
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

function initMap(markersJSON) {

    let map;
    let googleMarkers = {};
    let mapOptions = {
        center: {lat: 42.85, lng: -7.55299},
        zoom: 8.2
    };
    map = new google.maps.Map(document.getElementById('map'), mapOptions);

    var infowindow;
    var contentString;

    console.log("HOLA!!!!");
 //   console.log(JSON.parse(markersJSON));
   /* for(let i =0 ; i<markers.length; i++){
        console.log(markers[i]);
    }*/
/*
    for (let i = 0; i < totalMarkers; i++) {
        infowindow = new google.maps.InfoWindow({
            content: getContentInfoHTML(markers['m' + i]),
            maxWidth: 325
        });

        let icon;
        setIcon(icon, markers['m' + i].level, markers['m' + i].variable);

        googleMarkers['c' + i] = new google.maps.Marker({
            position: new google.maps.LatLng(markers['m' + i].lat, markers['m' + i].lon),
            map: map,
            icon: icon,
            title: markers['m' + i].name,
            infowindow: infowindow
        });


        google.maps.event.addListener(googleMarkers['c' + i], 'click', function () {
            for (var key in marker) {
                googleMarkers[key].infowindow.close();
            }
            this.infowindow.open(map, this);

        });
    }

*/
}


