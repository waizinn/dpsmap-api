<?php
include "includes/header.php";
$data = [];

$act = $_GET['act'];

if ($act == "edit") {
    $id = $_GET['id'];
    $api = getById("api", $id);

    $api_key = $api['token'];
} else {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $api_key = '';
    for ($i = 0; $i < 24; $i++) {
        $api_key .= $characters[rand(0, $charactersLength - 1)];
    }
}

?>

<form method="post" action="/control/update" enctype='multipart/form-data' style="max-width:400px;">
	<fieldset>
		<legend class="hidden-first">Add New Users</legend>
		<input name="cat" type="hidden" value="api">
		<input name="id" type="hidden" value="<?=$id?>">
		<input name="act" type="hidden" value="<?=$act?>">
		<input name="token" type="hidden" value="<?=token()?>">


		<label>Token</label>

		<input class="form-control form-control-sm" type="text" name="api"
			value="<?=$api_key?>" readonly /><br>

		<label>Remark</label>
		<input class="form-control form-control-sm" type="text" name="remark"
			value="<?=$api['remark']?>" /><br>


		<br>
		<br>
		<a href="javascript:window.history.back();" class="btn btn-primary btn-sm">
			&nbsp; &#x2770; &nbsp; Back
			&nbsp;</a>
		<input type="submit" value="&nbsp;&nbsp; &#x2713; Save &nbsp;&nbsp;" class="btn btn-success btn-sm">

</form>
<?php include "includes/footer.php";
