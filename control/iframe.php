<?php

$_SESSION['table']=$table = 'log';
$order = 'DESC';
$export = "../export";
$_SESSION['sql']=$sql = "Select * from $table ORDER BY id $order";
$Paginator = new Paginator($link, $table, $export);
$results = $Paginator->getData($limit, $page, $sql);

?>



<table class="table table-striped table-bordered">
	<thead>
		<tr>
			<th align="center">Date</th>
			<th align="center">Query</th>
			<th align="center">User ID</th>
			<th align="center">Status</th>

		</tr>
	</thead>
	<tbody>
		<?php

if (isset($results) && count($results->data) > 0) {
    for ($i = 0; $i < count($results->data); $i++) {?>


		<tr>
			<?php
$user_id = $results->data[$i]['user'];
        //$bs=strlen($user_id);
        //$cs=$bs-6;
        //$ds=substr($user_id, $cs, $bs);
        ?>
			<td align="center"><?=$results->data[$i]['date']?>
			</td>
			<td align="center"><?=$results->data[$i]['query']?>
			</td>
			<td align="center"><?=$user_id?>
			</td>
			<td align="center"><?=$results->data[$i]['status']?>
			</td>


		</tr>
		<?php }
}?>

	</tbody>
</table>

<?php
echo $Paginator->createLinks($links, $class = "pagination pagination-sm"); //$class="pagination"
