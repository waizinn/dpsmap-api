<?php
include "includes/header.php";
?>



<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
	<h1 class="h3 mb-0 text-gray-800 text-secondary">Dashboard</h1>
	<?php if ($role=='Admin') { ?>
	<p>

		<a href="upload" class="d-none d-sm-inline-block btn btn-sm btn-outline-primary shadow-sm">
			<i class="glyphicon glyphicon-floppy-save"></i> Data Management</a>

		<a href="home-setting" class="d-none d-sm-inline-block btn btn-sm btn-outline-primary shadow-sm">
			<i class="glyphicon glyphicon-cog "></i> SMTP Settings</a>
	</p>
	<?php } ?>
</div>
<div class="row">

	<div class="col-xl-6 col-md-6 mb-4">
		<div class="card border-left-primary shadow h-100 py-2">
			<div class="card-body">
				<div class="row no-gutters align-items-center">
					<div class="col mr-2">
						<div class="text-xs font-weight-bold text-primary text-uppercase mb-1">DPS Data</div>
						<div class="h5 mb-0 font-weight-bold text-gray-800 text-secondary">
							<?=counting("dps", "id")?>
							<small>Row(s)</small>
						</div>
					</div>
					<div class="col-auto">
						<i class="glyphicon glyphicon-list-alt text-secondary" style="font-size:35px;"></i>
						<!-- <i class="fas fa-calendar fa-2x text-gray-300"></i>-->
					</div>
				</div>
			</div>
		</div>
	</div>


	



	<div class="col-xl-6 col-md-6 mb-4">
		<div class="card border-left-info shadow h-100 py-2">
			<div class="card-body">
				<div class="row no-gutters align-items-center">
					<div class="col mr-2">
						<div class="text-xs font-weight-bold text-info text-uppercase mb-1">
							Total Users
						</div>
						<div class="row no-gutters align-items-center">
							<div class="col-auto">
								<div class="h5 mb-0 mr-3 font-weight-bold text-gray-800 text-secondary">

									<?=counting("users", "id");?>
									<small>User(s)</small>
								</div>
							</div>
							</div>
					</div>
					<div class="col-auto">
						<i class="glyphicon glyphicon-user text-secondary" style="font-size:35px;"></i>
					</div>
				</div>
			</div>
		</div>
	</div>


</div>


<div class="row">
	<div class="col-lg-6 mb-4">
		<div class="card shadow mb-4">
			<div class="card-header py-3">
				<h6 class="m-0 font-weight-bold text-primary">Your Account Information <a
						href="edit-users?act=edit&id=<?=$adminid?>"
						class="text-secondary alink" style="font-size:12px;"><i class="glyphicon glyphicon-edit"></i>
						Edit</a></h6>
			</div>
			<div class="card-body">
				<div class="text-center">
					<!-- <img class="img-fluid px-3 px-sm-4 mt-3 mb-4" style="width: 25rem;" src="" alt="">-->
				</div>

				<?php $data=getById("users", $adminid)?>
				<table class="table table-borderless">
					<tr>
						<td>Name </td>
						<td><?=$data['name']?>
						</td>
					</tr>
					<tr>
						<td>Username </td>
						<td><?=$data['username']?>
						</td>
					</tr>
					<tr>
						<td>Role </td>
						<td><?=$data['role']?>
						</td>
					</tr>
					<tr>
						<td>Created </td>
						<td><?=$data['created']?>
						</td>
					</tr>
					<tr>
						<td>Updated </td>
						<td><?=$data['updated']?>
						</td>
					</tr>
				</table>

			</div>
		</div>
	</div>

	<?php if ($role=="Admin") { ?>
	<div class="col-lg-6 mb-4">
		<div class="card shadow mb-4">
			<div class="card-header py-3">
				<h6 class="m-0 font-weight-bold text-primary">Last 5 Active Sessions</h6>
			</div>
			<div class="card-body">
				<div class="text-center">
					<!--<img class="img-fluid px-3 px-sm-4 mt-3 mb-4" style="width: 25rem;" src="" alt="">-->
				</div>
				<?php
                  $data = getAll_Limit("users", "5");
                  ?>
				<table class="table table-borderless">
					<?php if ($data) foreach ($data as $datas): ?>
					<tr>
						<td><?=$datas['name']?>
						</td>
						<td> &nbsp; &nbsp; &nbsp;<?=$datas['active_session']?>
						</td>
					</tr>
					<?php endforeach ?>
				</table>

			</div>
		</div>
	</div>
	<?php } ?>
</div>
<?php include "includes/footer.php";
