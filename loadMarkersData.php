<?php


$data = file_get_contents('C:/Users/Mary Luz/Documents/Informatica/TFG/RD2T/output/Roadcast_2018-01-26/Roadcast_2018-01-26.csv');
$lines = explode("\n\n", $data);

foreach ($lines as $key => $value) {
    if ($key > 0 && strlen($value) > 10) { // skip csv header row and blank rows
        $line = explode(",", $value); // Separador ,
        $markers[$key] = trim($line[1]) . ',' . trim($line[2]) . ',' . trim($line[3]) . ',' . trim($line[4]) . ',' . trim($line[5]) . ',' . trim($line[6]); // Nombre de estación, latitud, longitud, Nivel, Variable, Previsión

    }
}

