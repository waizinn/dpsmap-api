<?php

if ($role == "Admin") {
    $query = "SELECT * FROM log";
    if (!$result = mysqli_query($link, $query)) {
        exit(mysqli_error($link));
    }

    $api = array();
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $api[] = $row;
        }
    }

    header('Content-Type: text/csv; charset=utf-8');
    header('Content-Disposition: attachment; filename=api-usage.csv');
    $output = fopen('php://output', 'w');
    fputcsv($output, array('id', 'user', 'date', 'query', 'status'));

    if (count($api) > 0) {
        foreach ($api as $row) {
            fputcsv($output, $row);
        }
    }
} else {
    echo "<script>alert('Permission Error!'); window.close();</script>";
}
