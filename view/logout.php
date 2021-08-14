<?php
        
     
session_start();
unset($_SESSION['adminid']);
unset($_SESSION['username']);
unset($_SESSION['name']);
unset($_SESSION['auth']);
unset($_SESSION['role']);

$_SESSION['adminid']="";
$_SESSION['username']="";
$_SESSION['name']="";
$_SESSION['auth']="";
$_SESSION['role']="";

setcookie("adminid", "");

    setcookie("adminname", "");
    setcookie("adminemail", "");
    setcookie("adminpass", "");
    setcookie("auth", "");
    header("location:"."index.php");
