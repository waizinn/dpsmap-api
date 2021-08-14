
<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $token = $_POST["token"];
    $dps_id = $_POST["dps_id"];
    $value = $_POST["value"];
    $lat = $_POST["lat"];
    $lon = $_POST["lon"];
    $filter = $_POST["filter"];

} else {
    $token = $_GET["token"];
    $dps_id = $_GET["dps_id"];
    $value = $_GET["value"];
    $lat = $_GET["lat"];
    $lon = $_GET["lon"];
    $filter = $_GET["filter"];

}

if (isset($token) && strlen($token) == 24) {
    require_once "config.php";
    require_once "api-data.php";
    $token = mysqli_real_escape_string($link, $token);
    $result = getById_id('api', 'token', $token, 'status', 'Active');

    if ($result['id']) {
        if (isset($filter) && $filter == 'tsp') {
            require_once "search_all_tsp_list.php";
        } elseif (isset($filter) && $filter == 'ward') {
            require_once "search_all_ward_list.php";
        } elseif (isset($value) && strlen($value) >= 3) {
            require_once "search_with_value.php";
        } elseif (isset($lat) && isset($lon)) {
            require_once "search_with_lat_lon.php";
        } elseif (isset($dps_id)) {
            require_once "search_with_dps_id.php";
        }
    }

}
if ($link) {
    mysqli_close($link);
}
