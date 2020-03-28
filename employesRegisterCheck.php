<?php

session_start();
$reg_name = '';
$reg_email = '';
$reg_phone = '';
$reg_password = '';
$reg_image = '';
$reg_active = '';
$reg_role = '';

include("connect.php");
date_default_timezone_set("Asia/Kolkata");
    
function text_input($data) {
    $data = stripcslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $reg_name = text_input($_POST["reg_name"]);
    $reg_email = text_input($_POST["reg_email"]);
    $reg_phone = text_input($_POST["reg_phone"]);
    $reg_password = text_input($_POST["reg_password"]);
    $reg_active = text_input($_POST["reg_active"]);
    $reg_role = text_input($_POST["reg_role"]);
    $date = date('Y-m-d H-i-s');
    $user_id = $_SESSION['user_id'];

    $sql = "select * from user where user_phone = $reg_phone";
    $result = mysqli_query($con, $sql);
    $num = mysqli_num_rows($result);

    if ($num == 1) {
        $_SESSION['error'] = "Phone number is already registered";
        header("Location:employesRegister.php");
    }else{
        $user_image = $_FILES['reg_image']['name'];
        $target_dir = "dist/img/user_pic/";
        $target_file = $target_dir . basename($_FILES['reg_image']['name']);

        // Select file type
        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

        // Valid file extensions
        $extensions_arr = array("jpg","jpeg","png","gif");

        // Check extension
        if(in_array($imageFileType,$extensions_arr) ){
            $image = $target_dir.$date.$user_image;
            $sql = "insert into user (user_name, user_email, user_phone, user_password, user_active, user_role, created_by, user_image) values('$reg_name','$reg_email','$reg_phone','$reg_password', $reg_active, $reg_role, $user_id, '$image')";
            if(mysqli_query($con, $sql)){
                $_SESSION['error'] = "Successfully registered";
                move_uploaded_file($_FILES['reg_image']['tmp_name'], $image);
            }
            else
                $_SESSION['error'] = "Some error occured";
        }
        else{
            $_SESSION['error'] = "Image should be png, jpg, jpeg, gif";
        }
        header('Location:employesRegister.php');
    }
}
$con->close();
?>
