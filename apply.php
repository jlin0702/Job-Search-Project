<?php
    session_start();
    require_once('db.php');
    $job_id = $_POST['ID'];
    $email = $_SESSION['email'];
    $query_apply = "INSERT INTO APPLY
        VALUES ('$email', '$job_id', now())";
    $result_apply = mysqli_query($conn, $query_apply) or die('Query failed: ' . mysqli_error($conn));
    header("Location: job-seeker-main.php");
    exit;
?>