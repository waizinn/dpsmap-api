<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="" type="image/gif"
        sizes="16x16">
    <meta name="description" content="Admin Panel">
    <title>Password Reset</title>
    <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">-->
    <link href="https://maxcdn.bootstrapcdn.com/bootswatch/3.3.7/cosmo/bootstrap.min.css" rel="stylesheet">
</head>

<body>

    <div class="container" style="margin-top:30px">

        <?php

$message = '<h1 class="text-center">Your link was expired or invalid!</h1>
            <center>
            <button class="btn btn-block" style="width:400px;" onclick="window.location.href=`reset`">
            Try Again</button>

            <button class="btn btn-block" style="width:400px;" onclick="window.location.href=`index`">
            Enter Login Page</button>
            </center>';

//ps changing
if (isset($_POST['chk']) && isset($_POST["password"])) {
    $token = $link->real_escape_string($_POST['token']);
    $auth = $link->real_escape_string($_POST['chk']);
    $password = $link->real_escape_string($_POST['password']);

    $query = counts("users", 'chk', $auth);

    if ($query == 1 && valid_token($token) == 'ok') {
        if (ps($password, $auth) == 'ok') {
            $message = '<h1 class="text-center">Successfully changed!</h1>
            <center>
            <button class="btn btn-default btn-block" style="width:400px;" onclick="window.location.href=`index`">
            Enter Login Page</button>
            </center>';
        }
    }
}

//ps request submission
elseif (isset($_POST['username']) && !isset($_GET['auth'])) {
    $username = $link->real_escape_string($_POST['username']);
    $token = $link->real_escape_string($_POST['token']);
    if (filter_var($username, FILTER_VALIDATE_EMAIL)) {

        //$query = getByIds("users", 'username', $username);
        $query = counts("users", 'username', $username);

        if ($query == 1 && valid_token($token) == 'ok') {
            $permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyz';
            $chk = substr(str_shuffle($permitted_chars), 0, 16);
            if (updates('users', 'chk', $chk, 'username', $username) == 'ok') {
                function clean_text($string)
                {
                    $string = trim($string);
                    $string = stripslashes($string);
                    $string = htmlspecialchars($string);
                    return $string;
                }

                $auth = "https://api.dpsmap.com/reset?auth=$chk";

                $message = "
                        <html>
                        <p>We received a request to reset your password. Please create a new password by clicking this button:</p>
                        <center><a href='" . $auth . "'><button>Click Here To Reset Your Password</button></a></center>
                        <p>This request will expire in 1 hour. <span style='color:red'>If you did not request this change, no changes have been made to your account.</span></p>
                        <p>You can also reach us by responding to info@ethicaldigit.com</p>
                        <p>Regards,<br>
                        DPS Team</p>
                        </html>";

                $sts = mail_sending($username, 'You', 'Reset Your Password', $message);

                if ($sts == 'ok') {
                    $message = '
                            <center><img src="./modal/email_sending.gif" style="width:300px;"></center>
                            <div class="alert alert-secondary text-center">
                The system will send you a link to reset your password!<br>
                <strong>Note!</strong> It could take up to 1 to 5 minutes. Please check your inbox & spam folder.
              </div>';
                } else {
                    $message = '<div class="alert alert-info text-center">There is an Error!</div>';
                }
            }
        }
    } else {
        $message = '<h1 class="text-center">Invalid Email!</h1>
            <center>
            <button class="btn btn-default btn-block" style="width:400px;" onclick="window.location.href=`reset`">
            Try Again</button>
            <br>
            <button class="btn btn-default btn-block" style="width:400px;" onclick="window.location.href=`index`">
            Enter Login Page</button>
            </center>';
    }
}
//auth with link (get method)
elseif (isset($_GET['auth'])) {
    $auth = $link->real_escape_string($_GET['auth']);
    $query = getByIds("users", 'chk', $auth);

    if ($query['id'] > 0 && $query['username'] != '') {
        $updated = $query['updated'];

        //        $updated = "2020-07-06 02:00:01";
        //utc time and mm time (-1 hour - 6:30 hour)
        //        $date = date('Y-m-d H:i:s', strtotime('-7 hour')); //30 minutes
        date_default_timezone_set("UTC");
        $date = date('Y-m-d H:i:s', strtotime('-1 hour'));
        //    echo $updated."<br>";
        //    echo $date;
        //    $d=var_dump($updated > $date);
        //    echo $d;
        $d = $updated > $date;
        if ($d == true) {
            $message = '<div class="row" style="margin-top:30px">
                        	<h1 class="text-center">Reset Your Password</h1>
                        	<h4 class="text-center">Enter Your New Password</h4>
                        		<div class="col-sm-6 col-md-4 col-md-offset-4">
                        			<form action="" method="post">
                        <input type="hidden" name="chk" value="' . $auth . '">
                        <input name="token" type="hidden" value="' . token() . '">
                     <input type="text" class="form-control" placeholder="Enter New Password" name="password"  minlength="6" maxlength="30" required><br>

                     <button class="btn btn-default btn-block" type="submit">
                     Save</button>
                     </form>
                  </div>
                  </div>';
        } else {
            $message = '
                  <h1 class="text-center">Your link was expired or invalid!</h1>
            <center>
            <button class="btn btn-default btn-block" style="width:400px;" onclick="window.location.href=`index`">
            Enter Login Page</button>
            </center>
                  ';
        }
    }
}
//firstly, email input
else {
    $message = '<script>function show(){document.getElementById("sub").style.display = "none";document.getElementById("loading").style.display = "block";}</script>
                <center style="display:none;" id="loading"><img src="./modal/checking.gif" loop="0" style="width:300px;"></center>
                  <div class="row" id="sub">
                     <div class="col-sm-6 col-md-4 col-md-offset-4">
                        <h1 class="text-center">Admin Panel</h1>
                        <h4 class="text-center">Password Reset</h4>
                        <div style="margin-top:30px">
                           <form action="" method="post" name="login" onsubmit="return show();">
                           <input name="token" type="hidden" value="' . token() . '">
                              <input type="email" class="form-control" placeholder="Enter Your Email" name="username" required autofocus><br>

                              <button class="btn btn-default btn-block" type="submit">
                              Submit to Reset Your Password</button>

                           </form>
                           <a href="index">	<button class="btn btn-link btn-block">
            					Enter Login Page</button></a>
                        </div>
                        <br>
                        <p>Please contact to the administrator, if you don`t have email address in your account.</p>

                     </div>

                  </div>
                  ';
}

echo $message;if ($link) {
    mysqli_close($link);
}?>




    </div>
</body>

</html>