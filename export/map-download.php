<?php

if ($role == "Admin") {
    $query = "SELECT * FROM map_download";
    if (!$result = mysqli_query($link, $query)) {
        exit(mysqli_error($link));
    }

    $users = array();
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $users[] = $row;
        }
    }

    header('Content-Type: text/csv; charset=utf-8');
    header('Content-Disposition: attachment; filename=map_download.csv');
    $output = fopen('php://output', 'w');
    fputcsv($output, array('no', 'Name', 'Email', 'Status', 'Phone', 'Download_Map', 'Download_Date', 'Reason', 'WhereFrom'));

    if (count($users) > 0) {
        foreach ($users as $row) {
            fputcsv($output, $row);
        }
    }
} else {
    echo "<script>alert('Permission Error!'); window.close();</script>";
}
