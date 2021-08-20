<?php
$db_host="localhost";
$db_username="dps";
$db_password="welcomesql123";
$db_name="dps";
$link = mysqli_connect($db_host, $db_username, $db_password);
mysqli_select_db($link, $db_name);
mysqli_query($link, "SET CHARACTER SET utf8");
date_default_timezone_set("Asia/Rangoon");
$date = date("d-m-Y") . "(" . date("h:i A") . ")";

//mail server connection
$email_name = "DPSMAP";
$email_address = "noreply@dpsmap.com";
$email_password = "";
$email_host = "smtp.ethicaldigit.com";
$email_port = "465";

session_start();
$adminid = $_SESSION['adminid'];
$username = $_SESSION['username'];
$name = $_SESSION['name'];
$auth = $_SESSION['auth'];
$role = $_SESSION['role'];
