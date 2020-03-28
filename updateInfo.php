<?php

session_start();

$user_email = '';
$user_name = '';
$user_phone = '';
$user_password = '';
$user_id = '';

function text_input($data) {
    $data = stripcslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

include("connect.php");
date_default_timezone_set("Asia/Kolkata");
$date = date('Y-m-d H-i-s');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_id = $_SESSION['user_id'];
    $user_email = text_input($_POST["user_email"]);
    $user_name = text_input($_POST["user_name"]);
    $user_phone = text_input($_POST["user_phone"]);
    $user_password = text_input($_POST["user_password"]);

    $query = "UPDATE user SET user_name = '".$user_name."', updated_by = ".$_SESSION['user_id'].", updated_on = '".$date."', user_email = '".$user_email."', user_phone = '".$user_phone."', user_password = '".$user_password."' WHERE user_id = ".$user_id;
        
    if (mysqli_query($con, $query)) {
        $_SESSION['user_name'] = $user_name;
        $_SESSION['user_email'] = $user_email;
        $_SESSION['user_password'] = $user_password;
        $_SESSION['user_phone'] =  $user_phone;
    }    
        
}
header("Location:dashboard.php");
?>
