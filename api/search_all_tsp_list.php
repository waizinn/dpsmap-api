<?php
$value = mysqli_real_escape_string($link, $value);
$dataArrays = getAllTsp('dps', $value);
$data = array();

foreach ($dataArrays as $dataArray):

    $data[] = array(

        'Tsp_N_Eng' => $dataArray['Tsp_N_Eng'],
        'Tsp_N_Myn' => $dataArray['Tsp_N_Myn'],
        'Dist_N_Eng' => $dataArray['Dist_N_Eng'],
        'Dist_N_Myn' => $dataArray['Dist_N_Myn'],

    );
endforeach;
if ($dataArrays != '' && $dataArrays != []) {
    $code = 200;
    $data = array("code" => 200, "message" => "Ok", "data" => $data);
    query_log($result['id'], 'Tsp List');
} else {
    $code = 404;
    $data = array("code" => 404, "message" => "Not Found");

}
