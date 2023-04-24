<?php
    require_once('db.php');
    $email = $_POST['mod-email'];
    $phone = $_POST['mod-phone'];
    $firstname = $_POST['mod-firstname'];
    $lastname = $_POST['mod-lastname'];
    $university = $_POST['mod-university'];
    $major = $_POST['mod-major'];
    $workexp = explode(';', $_POST['workexp']);
    $query_update_phone = "UPDATE USER
        SET PHONENUMBER='$phone'
        WHERE EMAIL='$email'";
    $result_update_phone = mysqli_query($conn, $query_update_phone) or die('Query failed: ' . mysqli_error($conn));
    $query_update = "UPDATE JOBSEEKER
        SET FIRSTNAME='$firstname', LASTNAME='$lastname', UNIVERSITY='$university', MAJOR='$major'
        WHERE EMAIL='$email'";
    $result_update = mysqli_query($conn, $query_update) or die('Query failed: ' . mysqli_error($conn));
    $query_delete_workexp = "DELETE FROM JOBSEEKERWORKEXPERIENCE WHERE EMAIL='$email'";
    $result_delete_workexp = mysqli_query($conn, $query_delete_workexp) or die('Query failed: ' . mysqli_error($conn));
    for ($i = 0; $i < count($workexp); $i++)
    {
        $query_workexp = "INSERT INTO JOBSEEKERWORKEXPERIENCE
            VALUES ('$email', '$workexp[$i]')";
        $result_workexp = mysqli_query($conn, $query_workexp) or die('Query failed: ' . mysqli_error($conn));
    }
    header("Location: job-seeker-main.php");
    exit;
?>