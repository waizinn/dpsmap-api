<?php
header("Content-Type: text/json");
header('Access-Control-Allow-Origin:*');

$code = 401;
$data = array("code" => $code, "message" => "Unauthorized!");
require_once "route.php";

http_response_code($code);
echo json_encode($data);
