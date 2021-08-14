<?php
include "includes/header.php";
if ($role == 'Admin') {
    ?>

<p>
	<a class="btn btn-primary btn-sm" href="edit-users?act=add"> <i class="glyphicon glyphicon-plus-sign"></i> Add</a>
</p>
<?php
}?>

<table id="sorted" class="table table-striped table-bordered">
	<thead>
		<tr>
			<th>Id</th>
			<th>Name</th>
			<th>Username/Email</th>
			<th>Password(Encrypted)</th>
			<th>Last Active</th>
			<th>Role</th>

			<th class="not">Edit</th>
			<?php if ($role == 'Admin') {?>
			<th class="not">Delete</th>
			<?php }?>
		</tr>
	</thead>

	<?php
$users = getAll("users");
if ($users) {
    foreach ($users as $userss):
    ?>
	<tr>
		<td align="right"><?php echo $userss['id'] ?>
		</td>
		<td><?php echo $userss['name'] ?>
		</td>
		<td><?php echo $userss['username'] ?>
		</td>
		<td><?php if ($role == 'Admin') {
        echo $userss['password'];
    } else {
        echo '********';
    }?>
		</td>
		<td><?php echo $userss['active_session']; ?>
		</td>
		<td><?php echo $userss['role']; ?>
		</td>


		<td align="center">
			<?php if ($username == $userss['username'] || $role == 'Admin') {?>
			<a
				href="edit-users?act=edit&id=<?php echo $userss['id'] ?>"><i
					class="glyphicon glyphicon-edit"></i></a>
			<?php } else {?>
			<a href="javascript:alert('Permission Error')"><i class="glyphicon glyphicon-edit"></i></a>
			<?php }?>
		</td>

		<?php if ($role == 'Admin') {?>
		<td align="center">
			<a href="/control/update?act=delete&id=<?php echo $userss['id'] ?>&cat=users"
				onclick="return navConfirm(this.href);"><i class="glyphicon glyphicon-trash"></i></a>
		</td>
		<?php }?>
	</tr>
	<?php endforeach;}?>
</table>
<p><?php echo "Your are logged in as <b>" . $username . "</b>."; ?>
</p>
<?php include "includes/footer.php";