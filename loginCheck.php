<?php

session_start();
$phone = '';
$pass = '';

function text_input($data) {
    $data = stripcslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $phone = text_input($_POST["phone"]);
    $password = text_input($_POST["password"]);
}

include("connect.php");

$sql = "select * from user where user_phone='$phone' and user_password='$password'";
$result = mysqli_query($con, $sql);   

if ($row = mysqli_fetch_array($result)) {
    $_SESSION['user_id'] = $row['user_id'];
    $_SESSION['usre_name'] = $row['user_name'];
    $_SESSION['user_email'] = $row['user_email'];
    $_SESSION['user_phone'] =  $phone;
    $_SESSION['user_image'] =  $row['user_image'];
    $_SESSION['user_role_id'] =   $row['user_role'];
    if($row['user_role'] == 1)
		$_SESSION['user_role'] = 'admin';
	elseif($row['user_role'] == 2)
		$_SESSION['user_role'] = 'supervisor';
	else
		$_SESSION['user_role'] = 'client';


    header("Location:dashboard.php");
} else {
    $_SESSION['error'] = "*Phone or Password in Invalid";
    header("Location:index.php");
}
$con->close();
?>
