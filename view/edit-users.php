<?php
include "includes/header.php";
$data = [];

$act = $_GET['act'];
if ($act == "edit") {
    $id = $_GET['id'];
    $users = getById("users", $id);
    $role_ = $users['role'];
} else {
    $role_ = 'User';
}

?>

<form method="post" action="/control/update" enctype='multipart/form-data' style="max-width:400px;" id="form"
	onsubmit="loading();">
	<fieldset>
		<legend class="hidden-first">Add New Users</legend>
		<input name="cat" type="hidden" value="users">
		<input name="id" type="hidden" value="<?=$id?>">
		<input name="act" type="hidden" value="<?=$act?>">
		<input name="token" type="hidden" value="<?=token()?>">

		<label>Name</label>
		<input class="form-control form-control-sm" type="text" name="name"
			value="<?=$users['name']?>"
			required /><br>
		<?php if ($role == 'Admin') {?>
		<label>Username/Email</label>
		<input class="form-control form-control-sm" type="text" name="username"
			value="<?=$users['username']?>"
			required /><br>


		<label>Role</label>

		<select class="form-control form-control-sm" name="role">
			<option value="Admin" <?php if ($role_ == 'Admin') {
    echo "selected";
}?> >Admin
			</option>
			<option value="User" <?php if ($role_ == 'User') {
    echo "selected";
}?> >User
			</option>
			<?php if ($act == "edit") {?>
			<option value="Suspend" <?php if ($role_ == 'Suspend') {
    echo "selected";
}?> >Suspend
			</option>
			<?php }?>
		</select>
		<?php }?>

		<br>
		<?php	if ($act == "edit") {?>

		<div class="form-check">
			<label class="form-check-label hand">
				<input type="checkbox" class="form-check-input" name="Change" id="Change_" value="Change"
					onclick="pschange()">Change Password
			</label>
		</div>


		<script>
			function pschange() {
				var checkBox = document.getElementById("Change_");
				var inp = document.getElementById("pschange_");
				if (checkBox.checked == true) {
					inp.style.display = "block";
				} else {
					inp.style.display = "none";
				}
			}
		</script>
		<?php
}?>
		<input class="form-control form-control-sm" type="text" id="pschange_" name="password" value=""
			style="display:none;" /><br>

		<br>
		<br>
		<a href="javascript:window.history.back();" class="btn btn-primary btn-sm">&nbsp; &#x2770; &nbsp; Back
			&nbsp;</a>
		<input type="submit" value="&nbsp;&nbsp; &#x2713; Save &nbsp;&nbsp;" class="btn btn-success btn-sm"
			style="margin-left:20px;">

</form>
<?php include "includes/footer.php";
