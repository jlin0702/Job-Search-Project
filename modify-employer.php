<?php
    require_once('db.php');
    $email = $_POST['mod-emp-email'];
    $phone = $_POST['mod-emp-phone'];
    $companyname = $_POST['mod-companyname'];
    $query_update_phone = "UPDATE USER
        SET PHONENUMBER='$phone'
        WHERE EMAIL='$email'";
    $result_update_phone = mysqli_query($conn, $query_update_phone) or die('Query failed: ' . mysqli_error($conn));
    $query_update = "UPDATE EMPLOYER
        SET COMPANYNAME='$companyname'
        WHERE EMAIL='$email'";
    $result_update = mysqli_query($conn, $query_update) or die('Query failed: ' . mysqli_error($conn));
    header("Location: employer-main.php");
    exit;
?>