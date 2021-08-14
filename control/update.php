<?php

if (isset($role)) {
    $ids = $adminid;

    if (isset($_POST['token']) && valid_token($_POST['token']) == 'ok') {
        $act = $link->real_escape_string($_POST['act']);
        $id = $link->real_escape_string($_POST['id']);
        $cat = $link->real_escape_string($_POST['cat']);
    } else {
        $act = $link->real_escape_string($_GET['act']);
        $id = $link->real_escape_string($_GET['id']);
        $cat = $link->real_escape_string($_GET['cat']);
    }

} else {
    header("Location: /logout");
    exit();
}

//empty dps table
if ($act == 'clear' && $role == "Admin") {
    $sql = "TRUNCATE `dps` ";
    if ($link->query($sql) === true) {
        header("Location: /upload");
        exit();

    } else {
        echo "Error updating record: " . $link->error;
    }
}

//update smtp setting
elseif ($cat == 'settings' && $act == 'edit' && $role == "Admin") {
    $host = $link->real_escape_string($_POST["host"]);
    $port = $link->real_escape_string($_POST["port"]);
    $name = $link->real_escape_string($_POST["name"]);
    $username = $link->real_escape_string($_POST["username"]);
    $password = $link->real_escape_string($_POST["password"]);
    if (counts($cat, 'id', 1) == 0) {
        $sql = "INSERT INTO $cat (`id`, `smtp_host`, `smtp_port`, `sender_name`, `smtp_username`, `smtp_password`) VALUES
        ('1','$host','$port','$name','$username','$password')";
    } else {
        $sql = "UPDATE $cat SET smtp_host='$host',smtp_port='$port',sender_name='$name',
    smtp_username='$username',smtp_password='$password' WHERE id='1'";
    }

    if ($link->query($sql) === true) {
        header("Location: /");
        exit();

    } else { //echo "Error: " . $sql . "<br>" . $link->error;
        echo "<script>alert('Error');window.history.back();</script>";
    }
}

// update api, admin access ###############################

elseif ($cat == 'api' && $act == 'edit' && $role == "Admin") {
    $id = $_POST["id"];
    $remark = $_POST["remark"];
    $sql = "UPDATE api SET remark='$remark' WHERE id='$id'";

    if ($link->query($sql) === true) {
        header("Location: /api-key");
    } else {
        echo "Error updating record: " . $link->error;
    }
}

// create api ##############################

elseif ($cat == 'api' && $act == 'add' && $role == "Admin") {
    $api = $_POST["api"];
    $remark = $_POST["remark"];
    $sql = "INSERT INTO api (token, remark, status)
VALUES ('$api', '$remark', 'Active')";

    if ($link->query($sql) === true) {
        header("Location: /api-key");
    } else {
        echo "Error updating record: " . $link->error;
    }
}

// update user, admin access ###############################
elseif ($cat == 'users' && $act == 'edit' && $role == "Admin") {
    $id = $link->real_escape_string($_POST["id"]);
    $name = $link->real_escape_string($_POST["name"]);
    $username = $link->real_escape_string($_POST["username"]);
    $role = $link->real_escape_string($_POST["role"]);
    if ($_POST["Change"] == "Change" && $link->real_escape_string($_POST["password"] != "")) {
        $password = md5($_POST["password"]);
        $sql = "UPDATE $cat SET name='$name', username='$username', password='$password', role='$role' WHERE id='$id'";
    } else {
        $sql = "UPDATE $cat SET name='$name', username='$username', role='$role' WHERE id='$id'";
    }

    if ($link->query($sql) === true) {
        header("Location: /users");
        exit();

    } else {
        echo "Error updating record: " . $link->error;
    }
}

// update user, user access ###############################

elseif ($cat == 'users' && $act == 'edit' && $ids == $link->real_escape_string($_POST["id"]) && ($role == "User" || $role == 'someone')) {
    $name = $link->real_escape_string($_POST["name"]);
    $username = $link->real_escape_string($_POST["username"]);

    if ($_POST["Change"] == "Change" && $link->real_escape_string($_POST["password"] != "")) {
        $password = md5($_POST["password"]);
        $sql = "UPDATE $cat SET name='$name', password='$password' WHERE id='$id'";
    } else {
        $sql = "UPDATE $cat SET name='$name' WHERE id='$id'";
    }

    if ($link->query($sql) === true) {
        echo "<script>alert('Successfully changed!');</script>";
        header("Location: /users");
        exit();

    } else {
        echo "Error updating record: " . $link->error;
    }
}

// create user ##############################

elseif ($cat == 'users' && $act == 'add' && $role == "Admin") {
    $name = $link->real_escape_string($_POST["name"]);
    $username = $link->real_escape_string($_POST["username"]);
    $password = md5("welcome#");
    $role = $link->real_escape_string($_POST["role"]);

    $query = counts($cat, 'username', $username);

    if ($query == 0) {
        $sql = "INSERT INTO $cat (name, username, password, role)
VALUES ('$name', '$username', '$password', '$role')";

        if ($link->query($sql) === true) {
            if (filter_var($username, FILTER_VALIDATE_EMAIL)) {
                $permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyz';
                $chk = substr(str_shuffle($permitted_chars), 0, 16);
                if (updates('users', 'chk', $chk, 'username', $username) == 'ok') {
                    $auth = "https://dpsmap.com/reset?auth=$chk";

                    $message = "
                        <html>
                        <p>Welcome $name, <br>
                        Here is POST2U Admin Panel (admin.post2u.com.mm) <br>
                        Please create a new password by clicking this button:</p>
                        <center><a href='" . $auth . "'><button>Click Here To Create Your Password</button></a></center>
                        <p>This email is automatically generated from the system. You can also reach us by responding to info@dpsmap.com and contact info@ethicaldigit.com incase of any system errors.</p>
                        <p>Regards,<br>
                        DPS Team</p>
                        </html>";

                    $sts = mail_sending($username, $name, "Welcome $name! Create Your Password", $message);

                    if ($sts == 'ok') {
                        echo "<script>alert('The system will send a link to the user to creat the password!');</script>";
                        echo "<script>window.history.go(-2);</script>";
                    } else {
                        //                  echo $username." ".$name." ".$sts."<br>".$message;
                        echo "<script>alert('Mail sending error! Default password is welcome#');</script>";
                        echo "<script>window.history.go(-2);</script>";
                        //  $message = '<div class="alert alert-info text-center">There is an Error!</div>';
                    }
                }
            } else {
                echo "<script>alert('Success! Default password is welcome#');</script>";
                header("Location: /users");
                exit();

            }
        } else {
            echo "Error updating record: " . $link->error;
        }
    } else {
        echo "<script>alert('Username or email already exists');window.history.back()</script>";
    }
}

// api status change ##################################################
elseif ($act == 'api_change' && $role == "Admin") {
    $id = $_GET["id"];
    $status = $_GET["cat"];
    $sql = "UPDATE api SET status='$status' WHERE id='$id'";

    if ($link->query($sql) === true) {
        header("Location: /api-key");
    } else {
        echo "Error updating record: " . $link->error;
    }
}

// delete function ##################################################
elseif ($act == 'delete' && $role == "Admin") {
    if ($cat == 'users') {
        $sql = "DELETE FROM users WHERE id='$id'";
    } elseif ($cat == 'api-key') {
        $sql = "DELETE FROM api WHERE id='$id'";
    } elseif ($cat == 'dps') {
        $sql = "DELETE FROM dps WHERE DPS_ID='$id'";
    } elseif ($cat == 'map-download') {
        $sql = "DELETE FROM map_download WHERE no='$id'";
    } elseif ($cat == 'property') {
        $sql = "DELETE FROM property WHERE no='$id'";
    } else {
    }
    if ($link->query($sql) === true) {
        echo "<script>window.history.back();</script>";
    } else {
        echo "Error updating record: " . $link->error;
    }
} else {
    echo "<script>alert('Permission Error!'); window.history.back();</script>";
}

mysqli_close($link);
