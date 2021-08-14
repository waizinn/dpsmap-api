<?php

if ($role == "Admin") {
    $query = 'SELECT * FROM dps';
    $result = mysqli_query($link, $query);

    $output .= '
    <table border="1">
    <tr>
    <th>ID</th>
    <th>DPS_ID</th>
    <th>HN_Eng</th>
    <th>HN_Myn</th>
    <th>Postal_Cod</th>
    <th>St_N_Eng</th>
    <th>St_N_Myn</th>
    <th>Ward_N_Eng</th>
    <th>Ward_N_Myn</th>
    <th>Tsp_N_Eng</th>
    <th>Tsp_N_Myn</th>
    <th>Dist_N_Eng</th>
    <th>Dist_N_Myn</th>
    <th>S_R_N_Eng</th>
    <th>S_R_N_Myn</th>
    <th>Country_N</th>
    <th>Longitude</th>
    <th>Latitude</th>


                        </tr>
      ';

    while ($row = mysqli_fetch_array($result)) {
        $output .= '
        <tr>
        <td>' . $row["ID"] . '</td>
        <td>' . $row["DPS_ID"] . '</td>
        <td>' . $row["HN_Eng"] . '</td>
        <td>' . $row["HN_Myn"] . '</td>
        <td>' . $row["Postal_Cod"] . '</td>
        <td>' . $row["St_N_Eng"] . '</td>
        <td>' . $row["St_N_Myn"] . '</td>
        <td>' . $row["Ward_N_Eng"] . '</td>
        <td>' . $row["Ward_N_Myn"] . '</td>
        <td>' . $row["Tsp_N_Eng"] . '</td>
        <td>' . $row["Tsp_N_Myn"] . '</td>
        <td>' . $row["Dist_N_Eng"] . '</td>
        <td>' . $row["Dist_N_Myn"] . '</td>
        <td>' . $row["S_R_N_Eng"] . '</td>
        <td>' . $row["S_R_N_Myn"] . '</td>
        <td>' . $row["Country_N"] . '</td>
        <td>' . $row["Longitude"] . '</td>
        <td>' . $row["Latitude"] . '</td>





                        </tr>
       ';
    }
    $output .= '</table>';
    header('Content-Type: application/xls');
    header('Content-Disposition: attachment; filename=dps' . $date . '.xls');
    echo $output;
} else {
    echo "<script>alert('Permission Error!'); window.close();</script>";
}
mysqli_close($link);
