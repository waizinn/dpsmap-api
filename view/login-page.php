<?php
error_reporting(0);

if (!isset($_SESSION['auth'])) {
    $_SESSION['auth'] = "login";
} elseif ($_SESSION['auth'] == "logined") {
    header("location: home");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">

    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="icon" href="" type="image/gif" sizes="16x16" />
    <meta name="description" content="Admin Panel">
    <title>Admin Panel</title>


    <link href="https://maxcdn.bootstrapcdn.com/bootswatch/3.3.7/cosmo/bootstrap.min.css" rel="stylesheet">
    <style>
        .mobile-only {
            display: none;
        }

        @media (max-width: 768px) {
            .mobile-only {
                display: block;
            }
        }
    </style>

</head>

<body>
    <div class="container" style="margin-top:30px">
        <div class="row">
            <div class="col-sm-6 col-md-4 col-md-offset-4">
                <h1 class="text-center">Admin Panel</h1>
                <h4 class="text-center">Sign in</h4>
                <div style="margin-top:30px">
                    <form action="login" method="post" name="login">
                        <input type="hidden" name="token"
                            value="<?=token()?>">
                        <input type="text" class="form-control" placeholder="Username / Email" name="username" required
                            autofocus><br>
                        <input type="password" class="form-control" placeholder="Password" name="password" required><br>
                        <button class="btn btn-default btn-block" type="submit">
                            Sign in</button>
                    </form>

                    <a href="reset"> <button class="btn btn-link btn-block">
                            Reset Your Password</button></a>
                    <br>
                    <p class="mobile-only">Some parts of the admin dashboard wouldn't be display. Please enter by
                        computer.</p>
                </div>
            </div>
        </div>
    </div>
</body>

</html>