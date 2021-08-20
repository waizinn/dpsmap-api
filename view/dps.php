<?php
include "includes/header.php";
if (isset($_GET['filter'])) {
    $text = $_GET['text'] = $_GET['text'];
	}	else{
	$text = $_SESSION['text'];
	}
	if ($text != "") {
    $ext = " WHERE DPS_ID LIKE '%$text%' OR HN_Eng LIKE '%$text%' OR St_N_Eng LIKE '%$text%' OR Ward_N_Eng LIKE '%$text%' OR 
	Tsp_N_Eng LIKE '%$text%' ";
	}else{$ext='';}
$_SESSION['table']=$table = 'dps';
$order = 'DESC';
$export = "/export";
$filter=$table.$ext;
$_SESSION['sql']=$sql = "Select * from $filter";
$Paginator = new Paginator($link, $filter, $export);
$results = $Paginator->getData($limit, $page, $sql);

?>




<div class="d-flex flex-row-reverse mb-2">
<form class="form-inline p-2" action="" method="get">
<input  type="text" name="text" placeholder="Search with DPS_ID, HN_Eng, St_N_Eng, Ward_N_Eng & Tsp_N_Eng"
value="<?=$text?>" class="form-control form-control-sm" style="width:400px;">
<input  type="submit" name="filter" class="btn btn-primary btn-sm " value="Search">
</form>
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
