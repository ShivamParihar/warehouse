<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location:index.php");
}
function text_input($data) {
    $data = stripcslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $user_id = text_input($_GET["user_id"]);
	include("connect.php");
	$sql = "delete from user where user_id = $user_id";
	$result = mysqli_query($con, $sql);
	$con->close();
}
header("Location:employesList.php");

?>
