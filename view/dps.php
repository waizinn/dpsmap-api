<?php
include "includes/header.php";

$table = 'dps';
$order = 'DESC';
$export = "export/dps";
$sql = "Select * from $table";
$Paginator = new Paginator($link, $table, $export);
$results = $Paginator->getData($limit, $page, $sql);

?>



<div class="row mb-3">
	<!-- <div class="col col-2">
		<?php //if ($role=="Admin") {?>
	<a class="btn btn-primary btn-sm" href="edit-dps?act=add"> <i class="glyphicon glyphicon-plus-sign"></i>
		Add</a>
	<?php //}?>
</div> -->
</div>
<table class="table table-striped table-bordered">
	<thead>
		<tr>

			<th>DPS_ID</th>
			<th>HN_Eng</th>
			<th>Postal_Cod</th>
			<th>St_N_Eng</th>
			<th>Ward_N_Eng</th>
			<th>Tsp_N_Eng</th>
			<th class="not">Delete</th>
		</tr>
	</thead>
	<tbody>
		<?php if (isset($results) && count($results->data) > 0) {
    for ($i = 0; $i < count($results->data); $i++) {
        ?>

		<tr>

			<td class="alink" data-toggle="modal" data-target="#myModal"
				onclick="funs('','dps','<?php echo $results->data[$i]['DPS_ID'] ?>');">
				<?php echo $results->data[$i]['DPS_ID'] ?>
			</td>

			<td><?php echo $results->data[$i]['HN_Eng'] ?>
			</td>

			<td><?php echo $results->data[$i]['Postal_Cod'] ?>
			</td>

			<td><?php echo $results->data[$i]['St_N_Eng'] ?>
			</td>
			<td><?php echo $results->data[$i]['Ward_N_Eng'] ?>
			</td>

			<td><?php echo $results->data[$i]['Tsp_N_Eng'] ?>
			</td>

			<td align="center"><a
					href="/control/update?act=delete&id=<?=$results->data[$i]['DPS_ID']?>&cat=dps"
					onclick="return navConfirm(this.href);"><i class="glyphicon glyphicon-trash"></i></a></td>
		</tr>
		<?php
}
}
?>

	</tbody>
</table>

<?php
echo $Paginator->createLinks($links, $class = "pagination pagination-sm"); //$class="pagination"
 ?>
<?php
include "includes/footer.php";
