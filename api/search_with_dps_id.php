<?php
$dps_id = mysqli_real_escape_string($link, $dps_id);

$dataArrays = getById_dps('dps', $dps_id);

$data = array(
    'DPS_ID' => $dataArrays['DPS_ID'],
    'HN_Eng' => $dataArrays['HN_Eng'],
    'HN_Myn' => $dataArrays['HN_Myn'],
    'Postal_Cod' => $dataArrays['Postal_Cod'],
    'St_N_Eng' => $dataArrays['St_N_Eng'],
    'St_N_Myn' => $dataArrays['St_N_Myn'],
    'Ward_N_Eng' => $dataArrays['Ward_N_Eng'],
    'Ward_N_Myn' => $dataArrays['Ward_N_Myn'],
    'Tsp_N_Eng' => $dataArrays['Tsp_N_Eng'],
    'Tsp_N_Myn' => $dataArrays['Tsp_N_Myn'],
    'Dist_N_Eng' => $dataArrays['Dist_N_Eng'],
    'Dist_N_Myn' => $dataArrays['Dist_N_Myn'],
    'S_R_N_Eng' => $dataArrays['S_R_N_Eng'],
    'S_R_N_Myn' => $dataArrays['S_R_N_Myn'],
    'Country_N' => $dataArrays['Country_N'],
    'Longitude' => $dataArrays['Longitude'],
    'Latitude' => $dataArrays['Latitude'],
);

if ($dataArrays != '' && $dataArrays != []) {
    $code = 200;
    $data = array("code" => $code, "message" => "Ok", "data" => $data);
    query_log($result['id'], 'Get Info');
} else {
    $code = 404;
    $data = array("code" => $code, "message" => "Not Found");
}
