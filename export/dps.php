<?php

if ($role == "Admin") {
$query = $_SESSION['sql'];
$table = $_SESSION['table'];
$coll = array();
$cols = getAllQuery("SELECT `COLUMN_NAME` FROM `INFORMATION_SCHEMA`.`COLUMNS` WHERE `TABLE_SCHEMA`='$db_name' AND `TABLE_NAME`='$table';");
foreach ($cols as $col) {
    $coll[] = $col['COLUMN_NAME'];
}
$rows = getAllQuery($query);

header('Content-Type: text/csv; charset=utf-8');
header('Content-Disposition: attachment; filename=' . $table .'_'.$date. '.csv');
$output = fopen('php://output', 'w');
fputcsv($output, $coll);

if (count($rows) > 0) {
    foreach ($rows as $row) {
        fputcsv($output, $row);
    }
}


} else {
    echo "<script>alert('Permission Error!'); window.close();</script>";
}
mysqli_close($link);
