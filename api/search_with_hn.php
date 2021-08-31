<?php
$value = mysqli_real_escape_string($link, $value);
$tsp = mysqli_real_escape_string($link, $tsp);
$street = mysqli_real_escape_string($link, $street);
$dataArrays = getAllHn('dps',$tsp,$street,$value,$similar);
$data = array();

foreach ($dataArrays as $dataArray):

    $data[] = array(
        'DPS_ID' => $dataArray['DPS_ID'],
        'HN_Eng' => $dataArray['HN_Eng'],
        'HN_Myn' => $dataArray['HN_Myn'],
        'Ward_N_Eng' => $dataArray['Ward_N_Eng'],
        'Ward_N_Myn' => $dataArray['Ward_N_Myn'],
        'Tsp_N_Eng' => $dataArray['Tsp_N_Eng'],
        'Tsp_N_Myn' => $dataArray['Tsp_N_Myn'],
        'Dist_N_Eng' => $dataArray['Dist_N_Eng'],
        'Dist_N_Myn' => $dataArray['Dist_N_Myn'],
        'Longitude' => $dataArray['Longitude'],
        'Latitude' => $dataArray['Latitude'],
    );
endforeach;
if ($dataArrays != '' && $dataArrays != []) {
    $code = 200;
    $data = array("code" => 200, "message" => "Ok", "data" => $data);
    query_log($result['id'], 'Ward List');
} else {
    $code = 404;
    $data = array("code" => 404, "message" => "Not Found");
}
