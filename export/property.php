<?php

if ($role == "Admin") {

// get Users
    $query = "SELECT * FROM property";
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
    header('Content-Disposition: attachment; filename=property.csv');
    $output = fopen('php://output', 'w');
    fputcsv($output, array(
        'no', 'Contact_Name', 'Contact_No', 'Contact_Source', 'Owner_Price', 'Owner_Price_Date', 'Buyer_Price', 'Buyer_Price_Date', 'Broker_Price', 'Broker_Price_Date', 'Online_Price', 'Online_Price_Date', 'Similar_Sold_Price', 'Similar_Sold_Price_Date', 'Govt_Price', 'Govt_Price_Date', 'Other_Price', 'Other_Price_Date', 'Price_USD', 'Land_Area_sq_ft', 'Land_Area_acre', 'Floor_Area_sq_ft', 'Construction_status_Infrastructures', 'Property_Type', 'G_ID_Address', 'Floor/Storey', 'Parking', 'Phone', 'Electricity', 'Gas', 'Water', 'AC', 'Internet', 'Furniture', 'Factory', 'Hospital', 'Surveyor_name', 'Collect_Date', 'Photo_Name_1', 'Photo_Name_2', 'X', 'Y', 'Address', 'Type', 'Remark', 'DPS_ID', 'Survey_Name',
    ));

    if (count($users) > 0) {
        foreach ($users as $row) {
            fputcsv($output, $row);
        }
    }
} else {
    echo "<script>alert('Permission Error!'); window.close();</script>";
}
