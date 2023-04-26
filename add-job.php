<?php
    session_start();
    require_once('db.php');
    $jobtitle = $_POST['jobtitle'];
    $description = $_POST['description'];
    $salary = $_POST['salary'];
    $location = $_POST['location'];
    $email = $_SESSION['email'];
    $query_job = "INSERT INTO JOB (JOBTITLE, EMPLOYEREMAIL, DESCRIPTION, LOCATION, SALARY)
        VALUES ('$jobtitle', '$email', '$description', '$location', $salary)";
    $result_job = mysqli_query($conn, $query_job) or die('Query failed: ' . mysqli_error($conn));
    header("Location: employer-main.php");
    exit;
?>