<!DOCTYPE html>
<html lang="en">

<?php

if ($_SESSION["auth"] == "logined" && ($role == 'Admin' || $role == 'User')) {

    // global $date,$username,$adminid,$role,$auth;
    if (updates('users', 'active_session', $date, 'username', $username) == 'ok') {
        $rows = getById('users', $adminid);
        $role = $rows['role'];
        $_SESSION['role'] = $role;
    } else {
        header("Location: logout");
        exit;
    }
} else {
    header("Location: logout");
    exit;
}

$uri = substr($url_, 1, 3);
$uri_ = substr($url_, 6, 3);

?>

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<meta name="viewport"
		content="width=device-width, height=device-height, initial-scale=1.0, minimum-scale=1, maximum-scale=1.0, user-scalable=no">

	<link rel="icon" href="" type="image/gif" sizes="16x16" />
	<meta name="description" content="Admin Panel">
	<title>Admin Panel</title>
	<link rel="stylesheet" href="includes/style.css">

	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">


	<style>
		a:link {
			text-decoration: none;
		}
	</style>



</head>

<body>
	<div class="wrapper" style="height:100%;">
		<!-- Sidebar Holder -->
		<script>
			if (sessionStorage.getItem("status") != null) {
				var nav_status = sessionStorage.getItem("status");
			} else {
				var nav_status = '';
				sessionStorage.setItem("status", "");
				// var nav_status='active';sessionStorage.setItem("status", "active");
			}
			document.write("<nav id='sidebar' class='bg-primary " + nav_status + "'>");
		</script>
		<div class="sidebar-header">
			<center>
				<h3><?=$name?><br>
					<p style="font-size:13px;"><?=$username?>
					</p><i id="sidebarCollapse" class="glyphicon glyphicon-circle-arrow-left "></i>
				</h3>
				<strong>
					<h4 style="font-size:15px;"><?=$name?>
					</h4>
					<i id="sidebarExtend" class="glyphicon glyphicon-circle-arrow-right hand"></i>
				</strong>
			</center>
		</div><!-- /sidebar-header -->

		<ul class="list-unstyled components">
			<li class="<?php if ($uri == 'hom' || $uri_ == 'hom' || $uri == 'upl' || $uri_ == 'upl') {
    echo 'active';
}?>">

				<a href="home">
					<i class="glyphicon glyphicon-home"></i>Dashboard
				</a>
			</li>
			<li class="<?php if ($uri == 'dps' || $uri_ == 'dps') {
    echo 'active';
}?>">
				<a href="dps"> <i class="glyphicon
							glyphicon-screenshot"></i>DPS Data</a>
			</li>
            <li class="<?php if ($uri == 'api' || $uri_ == 'api') {
    echo 'active';
}?>"><a href="api-key"> <i class="glyphicon glyphicon-ok-circle"></i>API</a>
			</li>
			<li class="<?php if ($uri == 'use' || $uri_ == 'use') {
    echo 'active';
}?>"><a href="users"> <i class="glyphicon glyphicon-user"></i>Users</a>
			</li>
			
			<hr>
			<li><a href="logout" onclick="return navConfirm(this.href);"><i
						class="glyphicon glyphicon-log-out"></i>Logout</a></li>
		</ul>


		<p id="ed_"></p>
		</nav>


		<div id="content" style="width: 100%; max-height: 600px;  overflow: auto;   position: relative;">