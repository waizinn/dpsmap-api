<?php

if (isset($_POST['username'])) {
    $username = $link->real_escape_string($_POST['username']);
    $token = $link->real_escape_string($_POST['token']);
    $pass = md5($_POST['password']);

    $query = login("users", $username, $pass, $token);
    if ($query['id'] > 0 && $query['username'] != '') {
        $id = $query['id'];
        $role = $query['role'];
        $name = $query['name'];
        $auth = 'logined';

        session_start();

        $_SESSION['adminid'] = $id;
        $_SESSION['username'] = $username;
        $_SESSION['name'] = $name;
        $_SESSION['auth'] = $auth;
        $_SESSION['role'] = $role;

        setcookie("adminid", $id);
        setcookie("adminemail", $username);
        setcookie("auth", $auth);
        setcookie("role", $role);

        header("location:" . "/");
    } else {
        echo "<script>alert('Incorrect! Please try again.');window.history.back();</script>";
        //header("location:"."index");
    }
} else {
    header("location:" . "/");
}
mysqli_close($link);
