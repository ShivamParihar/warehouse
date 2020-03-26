<?php

try {
    $con = mysqli_connect("localhost", "root", "", "test");
} catch (Exception $err) {
    echo $err->getMessage();
}
?>