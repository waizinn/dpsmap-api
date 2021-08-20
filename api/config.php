<?php
$db_host="localhost";
$db_username="dps";
$db_password="welcomesql123";
$db_name="dps";
$link = mysqli_connect($db_host, $db_username, $db_password);
mysqli_select_db($link, $db_name);
mysqli_query($link, "SET CHARACTER SET utf8");
date_default_timezone_set("Asia/Rangoon");
$date = date("d-m-Y");
