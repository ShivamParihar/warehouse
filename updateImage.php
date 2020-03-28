<?php

session_start();

$user_image = '';
$user_id = '';

function text_input($data) {
    $data = stripcslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

include("connect.php");
date_default_timezone_set("Asia/Kolkata");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_id = text_input($_POST["user_id"]);
    $user_image = $_FILES['user_image']['name'];
    $target_dir = "dist/img/user_pic/";
    $target_file = $target_dir . basename($_FILES['user_image']['name']);

    // Select file type
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

    // Valid file extensions
    $extensions_arr = array("jpg","jpeg","png","gif");

    // Check extension
    if( in_array($imageFileType,$extensions_arr) ){
        $image = $target_dir.$user_image;
        $query = "UPDATE user SET user_image = '".$image."', updated_by = ".$_SESSION['user_id']."WHERE user_id = ".$user_id;
        mysqli_query($con,$query);
        move_uploaded_file($_FILES['user_image']['tmp_name'], $image);
        if($user_id == $_SESSION['user_id'])
            $_SESSION['user_image'] = $image;
    }
}
header("Location:dashboard.php");
?>
