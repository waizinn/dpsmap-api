<?php

$link = mysqli_connect("localhost", "dps", "welcomesql123");
mysqli_select_db($link, "dps");
mysqli_query($link, "SET CHARACTER SET utf8");
date_default_timezone_set("Asia/Rangoon");
$date = date("d-m-Y");
