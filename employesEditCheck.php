<?php

session_start();
$reg_id = '';
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
    $reg_id = text_input($_POST["reg_id"]);
    $reg_name = text_input($_POST["reg_name"]);
    $reg_email = text_input($_POST["reg_email"]);
    $reg_phone = text_input($_POST["reg_phone"]);
    $reg_password = text_input($_POST["reg_password"]);
    $reg_active = text_input($_POST["reg_active"]);
    $reg_role = text_input($_POST["reg_role"]);
    $date = date('Y-m-d H-i-s');
    $user_id = $_SESSION['user_id'];

    $sql = "select * from user where user_phone = $reg_phone and user_id != reg_id";
    $result = mysqli_query($con, $sql);

    if (mysqli_num_rows($result) >= 1) {
        $_SESSION['error1'] = "Phone number is already registered";
        header("Location:editEmployes.php?user_id=".$reg_id);
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
            $sql = "UPDATE user SET user_name='".$reg_name."',
                                    user_email='".$reg_email."',
                                    user_phone='".$reg_phone."',
                                    user_password='".$reg_password."',
                                    user_active=".$reg_active.",
                                    user_role=".$reg_role.",
                                    user_image='".$image."',
                                    updated_by=".$user_id.",
                                    updated_on='".$date."'
                                    WHERE user_id=".$reg_id;

            if(mysqli_query($con, $sql)){
                $_SESSION['error1'] = "Successfully Updated";
                move_uploaded_file($_FILES['reg_image']['tmp_name'], $image);
            }
            else
                $_SESSION['error1'] = "Some error occured";
        }
        else{
            $sql = "UPDATE user SET user_name='".$reg_name."',
                                    user_email='".$reg_email."',
                                    user_phone='".$reg_phone."',
                                    user_password='".$reg_password."',
                                    user_active=".$reg_active.",
                                    user_role=".$reg_role.",
                                    updated_by=".$user_id.",
                                    updated_on='".$date."'
                                    WHERE user_id=".$reg_id;

            if(mysqli_query($con, $sql))
                $_SESSION['error1'] = "Successfully Updated";
        }
    }
}
header('Location:editEmployes.php?user_id='.$reg_id);
$con->close();
?>
