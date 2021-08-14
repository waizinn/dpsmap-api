<?php

if ($_POST['table']) {
    $table = $_POST['table'];
    $key = mysqli_real_escape_string($link, $_POST['no']);

    if ($table == 'dps') {
        $no_ = 'DPS_ID';
    } else {
        $no_ = 'no';
    }

    $row_ = getByIds($table, $no_, $key);
    $check = $row_[$no_];
    if ($check == "") {
        $check = "error";
    } else {
        $check = "ok";
    }
}
?>



<!-- Modal Header -->
<div class="modal-header">
	<h6 class="modal-title">ID = <?php if ($table == 'dps') {
    echo $row_['DPS_ID'];
} else {
    echo $row_['no'];
}
echo ", Table = $table";?>
	</h6>

</div>

<!-- Modal body -->
<div class="modal-body">


	<?php

//table == property
if ($check == "error") {
    echo "<h3 align='center'>Not Found</h3>";
} elseif ($table == 'property') {
    if ($_POST['sts'] == 'data') {?>
	<table id="sorted" class="table table-striped table-bordered  table-sm" style="width:100%">

		<tr>
			<th>No</th>
			<td><?php echo $row_['no'] ?>
			</td>
			<td></td>
		</tr>
		<tr>
			<th>Contact Name</th>
			<td><?php echo $row_['Contact_Name'] ?>
			</td>
			<td></td>
		</tr>
		<tr>
			<th>Contact No</th>
			<td><?php echo $row_['Contact_No'] ?>
			</td>
			<td></td>
		</tr>
		<tr>
			<th>Contact Source</th>
			<td><?php echo $row_['Contact_Source'] ?>
			</td>
			<td></td>
		</tr>
		<tr>
			<th>Owner Price</th>
			<td><?php echo $row_['Owner_Price'] ?>
			</td>
			<td><?php echo $row_['Owner_Price_Date'] ?>
			</td>
		</tr>
		<tr>

			<th>Buyer Price</th>
			<td><?php echo $row_['Buyer_Price'] ?>
			</td>
			<td><?php echo $row_['Buyer_Price_Date'] ?>
			</td>
		</tr>
		<tr>

			<th>Broker Price</th>
			<td><?php echo $row_['Broker_Price'] ?>
			</td>
			<td><?php echo $row_['Broker_Price_Date'] ?>
			</td>
		</tr>
		<tr>

			<th>Online Price</th>
			<td><?php echo $row_['Online_Price'] ?>
			</td>
			<td><?php echo $row_['Online_Price_Date'] ?>
			</td>
		</tr>
		<tr>

			<th>Similar Sold Price</th>
			<td><?php echo $row_['Similar_Sold_Price'] ?>
			</td>
			<td><?php echo $row_['Similar_Sold_Price_Date'] ?>
			</td>
		</tr>
		<tr>

			<th>Govt Price</th>
			<td><?php echo $row_['Govt_Price'] ?>
			</td>
			<td><?php echo $row_['Govt_Price_Date'] ?>
			</td>
		</tr>
		<tr>

			<th>Other Price</th>
			<td><?php echo $row_['Other_Price'] ?>
			</td>
			<td><?php echo $row_['Other_Price_Date'] ?>
			</td>
		</tr>
		<tr>

			<th>Price USD</th>
			<td><?php echo $row_['Price_USD'] ?>
			</td>
			<td></td>
		</tr>
		<tr>
			<th>Land Area sq ft</th>
			<td><?php echo $row_['Land_Area_sq_ft'] ?>
			</td>
			<td></td>
		</tr>
		<tr>
			<th>Land Area acre</th>
			<td><?php echo $row_['Land_Area_acre'] ?>
			</td>
			<td></td>
		</tr>
		<tr>
			<th>Floor Area sq ft</th>
			<td><?php echo $row_['Floor_Area_sq_ft'] ?>
			</td>
			<td></td>
		</tr>
		<tr>
			<th>Construction status Infrastructures</th>
			<td><?php echo $row_['Construction_status_Infrastructures'] ?>
			</td>
			<td></td>
		</tr>
		<tr>
			<th>Property Type</th>
			<td><?php echo $row_['Property_Type'] ?>
			</td>
			<td></td>
		</tr>
		<tr>
			<th>G ID Address</th>
			<td><?php echo $row_['G_ID_Address'] ?>
			</td>
			<td></td>
		</tr>
		<tr>
			<th>Floor/Storey</th>
			<td><?php echo $row_['Floor/Storey'] ?>
			</td>
			<td></td>
		</tr>
		<tr>
			<th>Parking</th>
			<td><?php echo $row_['Parking'] ?>
			</td>
			<td></td>
		</tr>
		<tr>
			<th>Phone</th>
			<td><?php echo $row_['Phone'] ?>
			</td>
			<td></td>
		</tr>
		<tr>
			<th>Electricity</th>
			<td><?php echo $row_['Electricity'] ?>
			</td>
			<td></td>
		</tr>
		<tr>
			<th>Gas</th>
			<td><?php echo $row_['Gas'] ?>
			</td>
			<td></td>
		</tr>
		<tr>
			<th>Water</th>
			<td><?php echo $row_['Water'] ?>
			</td>
			<td></td>
		</tr>
		<tr>
			<th>AC</th>
			<td><?php echo $row_['AC'] ?>
			</td>
			<td></td>
		</tr>
		<tr>
			<th>Internet</th>
			<td><?php echo $row_['Internet'] ?>
			</td>
			<td></td>
		</tr>
		<tr>
			<th>Furniture</th>
			<td><?php echo $row_['Furniture'] ?>
			</td>
			<td></td>
		</tr>
		<tr>
			<th>Factory</th>
			<td><?php echo $row_['Factory'] ?>
			</td>
			<td></td>
		</tr>
		<tr>
			<th>Hospital</th>
			<td><?php echo $row_['Hospital'] ?>
			</td>
			<td></td>
		</tr>
		<tr>
			<th>Surveyor name</th>
			<td><?php echo $row_['Surveyor_name'] ?>
			</td>
			<td></td>
		</tr>
		<tr>
			<th>Collect Date</th>
			<td><?php echo $row_['Collect_Date'] ?>
			</td>
			<td></td>
		</tr>
		<tr>
			<th>Photo Name 1</th>
			<td><?php echo $row_['Photo_Name_1'] ?>
			</td>
			<td></td>
		</tr>
		<tr>
			<th>Photo Name 2</th>
			<td><?php echo $row_['Photo_Name_2'] ?>
			</td>
			<td></td>
		</tr>
		<tr>
			<th>X</th>
			<td><?php echo $row_['X'] ?>
			</td>
			<td></td>
		</tr>
		<tr>
			<th>Y</th>
			<td><?php echo $row_['Y'] ?>
			</td>
			<td></td>
		</tr>
		<tr>
			<th>Address</th>
			<td><?php echo $row_['Address'] ?>
			</td>
			<td></td>
		</tr>
		<tr>
			<th>Type</th>
			<td><?php echo $row_['Type'] ?>
			</td>
			<td></td>
		</tr>
		<tr>
			<th>Remark</th>
			<td><?php echo $row_['Remark'] ?>
			</td>
			<td></td>
		</tr>
		<tr>
			<th>DPS ID</th>
			<td><?php echo $row_['DPS_ID'] ?>
			</td>
			<td></td>
		</tr>
		<tr>
			<th>Survey Name</th>
			<td><?php echo $row_['Survey_Name'] ?>
			</td>
			<td></td>
		</tr>



	</table>

	<?php } elseif ($_POST['sts'] == 'photo') {?>


	<img src="<?php echo "../property/images/" . $row_['Photo_Name_1'] ?>"
		alt="Not found" width="100%">

	<?php } else {
        echo "error getting data from property table.";
    }
}

//table == map dowload
elseif ($table == 'map_download') {
    ?>

	<table id="sorted" class="table table-striped table-bordered  table-sm" style="width:100%">

		<tr>
			<th>No</th>
			<td><?php echo $row_['no'] ?>
			</td>
		</tr>
		<tr>

			<th>Name</th>
			<td><?php echo $row_['Name'] ?>
			</td>
		</tr>
		<tr>
			<th>Email</th>
			<td><?php echo $row_['Email'] ?>
			</td>
		</tr>
		<tr>
			<th>Status</th>
			<td><?php echo $row_['Status'] ?>
			</td>
		</tr>
		<tr>
			<th>Phone</th>
			<td><?php echo $row_['Phone'] ?>
			</td>
		</tr>
		<tr>
			<th>Download Map</th>
			<td><?php echo $row_['Download_Map'] ?>
			</td>
		</tr>
		<tr>
			<th>Download Date</th>
			<td><?php echo $row_['Download_Date'] ?>
			</td>
		</tr>
		<tr>
			<th>Reason</th>
			<td><?php echo $row_['Reason'] ?>
			</td>
		</tr>
		<tr>
			<th>WhereFrom</th>
			<td><?php echo $row_['WhereFrom'] ?>
			</td>
		</tr>
		<tr>



	</table>
	<?php
}

//table == dps
elseif ($table == 'dps') {
    ?>

	<table id="sorted" class="table table-striped table-bordered  table-sm" style="width:100%">

		<tr>
			<th>DPS_ID</th>
			<td><?php echo $row_['DPS_ID'] ?>
			</td>
		</tr>
		<tr>
			<th>HN_Eng</th>
			<td><?php echo $row_['HN_Eng'] ?>
			</td>
		</tr>
		<tr>
			<th>HN_Myn</th>
			<td><?php echo $row_['HN_Myn'] ?>
			</td>
		</tr>
		<tr>
			<th>Postal_Cod</th>
			<td><?php echo $row_['Postal_Cod'] ?>
			</td>
		</tr>
		<tr>
			<th>St_N_Eng</th>
			<td><?php echo $row_['St_N_Eng'] ?>
			</td>
		</tr>
		<tr>
			<th>St_N_Myn</th>
			<td><?php echo $row_['St_N_Myn'] ?>
			</td>
		</tr>
		<tr>
			<th>Ward_N_Eng</th>
			<td><?php echo $row_['Ward_N_Eng'] ?>
			</td>
		</tr>
		<tr>
			<th>Ward_N_Myn</th>
			<td><?php echo $row_['Ward_N_Myn'] ?>
			</td>
		</tr>
		<tr>
			<th>Tsp_N_Eng</th>
			<td><?php echo $row_['Tsp_N_Eng'] ?>
			</td>
		</tr>
		<tr>
			<th>Tsp_N_Myn</th>
			<td><?php echo $row_['Tsp_N_Myn'] ?>
			</td>
		</tr>
		<tr>
			<th>Dist_N_Eng</th>
			<td><?php echo $row_['Dist_N_Eng'] ?>
			</td>
		</tr>
		<tr>
			<th>Dist_N_Myn</th>
			<td><?php echo $row_['Dist_N_Myn'] ?>
			</td>
		</tr>
		<tr>
			<th>S_R_N_Eng</th>
			<td><?php echo $row_['S_R_N_Eng'] ?>
			</td>
		</tr>
		<tr>
			<th>S_R_N_Myn</th>
			<td><?php echo $row_['S_R_N_Myn'] ?>
			</td>
		</tr>
		<tr>
			<th>Country_N</th>
			<td><?php echo $row_['Country_N'] ?>
			</td>
		</tr>
		<tr>
			<th>Longitude</th>
			<td><?php echo $row_['Longitude'] ?>
			</td>
		</tr>
		<tr>
			<th>Latitude</th>
			<td><?php echo $row_['Latitude'] ?>
			</td>
		</tr>


	</table>

	<?php
}
mysqli_close($link);
?>

</div>

<!-- Modal footer -->
<div class="modal-footer">

	<button type="button" class="btn btn-primary btn-sm" data-dismiss="modal">Close</button>
</div>