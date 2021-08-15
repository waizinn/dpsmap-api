<?php
$lat = mysqli_real_escape_string($link, $lat);
$lon = mysqli_real_escape_string($link, $lon);

$dataArrays = getByLocation('dps', $lat, $lon);
$data = [];

foreach ($dataArrays as $dataArray):
    $data[] = array(

        'DPS_ID' => $dataArray['DPS_ID'],
        'HN_Eng' => $dataArray['HN_Eng'],
        'HN_Myn' => $dataArray['HN_Myn'],
        'Postal_Cod' => $dataArray['Postal_Cod'],
        'St_N_Eng' => $dataArray['St_N_Eng'],
        'St_N_Myn' => $dataArray['St_N_Myn'],
        'Ward_N_Eng' => $dataArray['Ward_N_Eng'],
        'Ward_N_Myn' => $dataArray['Ward_N_Myn'],
        'Tsp_N_Eng' => $dataArray['Tsp_N_Eng'],
        'Tsp_N_Myn' => $dataArray['Tsp_N_Myn'],
        'Dist_N_Eng' => $dataArray['Dist_N_Eng'],
        'Dist_N_Myn' => $dataArray['Dist_N_Myn'],
        'S_R_N_Eng' => $dataArray['S_R_N_Eng'],
        'S_R_N_Myn' => $dataArray['S_R_N_Myn'],
        'Country_N' => $dataArray['Country_N'],
        'Longitude' => $dataArray['Longitude'],
        'Latitude' => $dataArray['Latitude'],

    );
endforeach;
if ($dataArrays != '' && $dataArrays != []) {
    $code = 200;
    $data = array("code" => 200, "message" => "Ok", "data" => $data);
    query_log($result['id'], 'Location');
} else {
    $code = 404;
    $data = array("code" => 404, "message" => "Not Found");
}
