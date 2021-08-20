<?php

function getById_id($table, $where1, $what1, $where2, $what2)
{
    $query = "SELECT id FROM " . $table . " WHERE $where1 = '$what1' AND $where2 = '$what2' ";
    $result = QuerySelect($query);
    if ($result) {
        return $result[0];
    } else {
        return $result;
    }
}

function isNumber($c)
{
    return preg_match('/[0-9]/', $c);
}

function getAllTsp($table, $value)
{
    $query = "SELECT DISTINCT Tsp_N_Eng,Tsp_N_Myn,Dist_N_Eng,Dist_N_Myn FROM $table WHERE Dist_N_Eng='$value';";
    $result = QuerySelect($query);
    return $result;

}
function getAllWard($table, $value)
{
    $query = "SELECT DISTINCT Ward_N_Eng,Ward_N_Myn,Tsp_N_Eng,Tsp_N_Myn,Dist_N_Eng,Dist_N_Myn FROM $table WHERE Tsp_N_Eng='$value';";
    $result = QuerySelect($query);
    return $result;

}

function getById_value($table, $value, $limit)
{
    $value = str_replace(",", " ", $value);
    $value = str_replace(".", " ", $value);
    $value = str_replace("။", " ", $value);
    $value = str_replace("၊", " ", $value);

    if (preg_match('~[0-9]+~', $value)) {
        $string = $value;
        $chars = '';
        $nums = '';
        for ($index = 0; $index < strlen($string); $index++) {
            if (isNumber($string[$index])) {
                $nums .= $string[$index];
            } else {
                $chars .= $string[$index];
            }
        }

        $value = $nums . " " . $chars;
    }

    $searchSplit = explode(' ', $value);
    $searchQueryItems = array();

    //  foreach ($searchSplit as $searchTerm) {
    //      $searchQueryItems[] = "DPS_Address_Eng LIKE '%" .$searchTerm . "%'";
    //  }
    // $query = 'SELECT DPS_ID,DPS_Address_Eng FROM '.$table.'' . (!empty($searchQueryItems) ? ' WHERE ' . implode(' AND ', $searchQueryItems) : '');

    foreach ($searchSplit as $searchTerm) {
        $searchQueryItems[] = "(
        HN_Eng LIKE '%" . $searchTerm . "%' ||
        HN_Myn LIKE '%" . $searchTerm . "%' ||
        Postal_Cod LIKE '%" . $searchTerm . "%' ||
        St_N_Eng LIKE '%" . $searchTerm . "%' ||
        St_N_Myn LIKE '%" . $searchTerm . "%' ||
        Ward_N_Eng LIKE '%" . $searchTerm . "%' ||
        Ward_N_Myn LIKE '%" . $searchTerm . "%' ||
        Tsp_N_Eng LIKE '%" . $searchTerm . "%' ||
        Tsp_N_Myn LIKE '%" . $searchTerm . "%'   ||
        Dist_N_Eng LIKE '%" . $searchTerm . "%'   ||
        Dist_N_Myn LIKE '%" . $searchTerm . "%'
           )
        ";
    }
    implode(' AND ', $searchQueryItems);

    $query = 'SELECT DPS_ID,
    HN_Eng,HN_Myn,Postal_Cod,St_N_Eng,St_N_Myn,Ward_N_Eng,Ward_N_Myn
    ,Tsp_N_Eng,Tsp_N_Myn,Dist_N_Eng,Dist_N_Myn,S_R_N_Eng
    ,S_R_N_Myn,Country_N,Longitude,Latitude FROM ' . $table . '' . (!empty($searchQueryItems) ? ' WHERE ' . implode(' AND ', $searchQueryItems) : '');
    $result = QuerySelect($query . ' LIMIT ' . $limit);

    return $result;
}

function getByLocation($table, $lat, $lon)
{
    $query = "  SELECT *, ((ACOS(SIN($lat * PI() / 180) *
    SIN(Latitude * PI() / 180) + COS($lat * PI() / 180) *
    COS(Latitude * PI() / 180) * COS(($lon - Longitude) * PI() / 180)) * 180 / PI()) * 60 * 1.1515)
    as distance FROM $table HAVING distance <= 5 ORDER BY distance ASC LIMIT 20;";
    $result = QuerySelect($query);

    return $result;
}
function getById_dps($table, $id)
{
    $query = "SELECT DPS_ID,
    HN_Eng,HN_Myn,Postal_Cod,St_N_Eng,St_N_Myn,Ward_N_Eng,Ward_N_Myn
    ,Tsp_N_Eng,Tsp_N_Myn,Dist_N_Eng,Dist_N_Myn,S_R_N_Eng
    ,S_R_N_Myn,Country_N,Longitude,Latitude
       FROM $table WHERE DPS_ID='$id'";
    $result = QuerySelect($query);
    if ($result) {
        return $result[0];
    } else {
        return '';
    }
}
function clean_text($string)
{
    $string = trim($string);
    $string = stripslashes($string);
    $string = htmlspecialchars($string);
    return $string;
}

function getById($table, $id)
{
    $query = "SELECT id FROM " . $table . " WHERE id=" . $id . "";
    $result = QuerySelect($query);
    if ($result) {
        return $result[0];
    } else {
        return $result;
    }
}

function QuerySelect($query, $object = null)
{
    global $link;
    $result = mysqli_query($link, $query);
    $result = mysqli_fetch_all($result, MYSQLI_ASSOC);;
    return $result;
}
function mysqli_result($res, $row = 0, $col = 0)
{
    $numrows = mysqli_num_rows($res);
    if ($numrows && $row <= ($numrows - 1) && $row >= 0) {
        mysqli_data_seek($res, $row);
        $resrow = (is_numeric($col)) ? mysqli_fetch_row($res) : mysqli_fetch_assoc($res);
        if (isset($resrow[$col])) {
            return $resrow[$col];
        }
    }
    return false;
}

function query_log($id, $status)
{
    global $link, $date;
    $query = mysqli_query($link, "SELECT * FROM log WHERE user = '$id' AND date = '$date' AND status='$status'");
    if (mysqli_num_rows($query) >= 1) {
        $row = mysqli_fetch_array($query);
        $query_count = $row['query'] + 1;
        $query = "UPDATE log SET query='$query_count' WHERE user='$id' AND date = '$date' AND status='$status'";
    } else {
        $query = "INSERT INTO log (user,date,query,status) VALUES ('$id','$date','1','$status')";
    }
    mysqli_query($link, $query);
}
