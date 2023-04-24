<?php
    session_start();
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Register Employer</title>
        <link rel="stylesheet" href="styles.css"/>
    </head>
    <body class='login-register-body'>
        <?php
            require_once('db.php');
            $email = $_POST['email'];
            $password = $_POST['password'];
            $phone = $_POST['phone'];
            $companyname = $_POST['companyname'];

            #check if email already exists
            $query_email = "SELECT * FROM USER WHERE EMAIL = '$email'";
            $result_email = mysqli_query($conn, $query_email) or die(mysqli_error($conn));
            if (mysqli_num_rows($result_email) == 0)
            {
                $query_user = "INSERT INTO USER
                    VALUES ('$email', '$phone', '$password')";
                $result_user = mysqli_query($conn, $query_user) or die('Query failed: ' . mysqli_error($conn));
                $query_employer = "INSERT INTO EMPLOYER
                    VALUES ('$email', '$companyname')";
                $result_employer = mysqli_query($conn, $query_employer) or die('Query failed: ' . mysqli_error($conn));
                $_SESSION['email'] = $email;
                header('Location: employer-main.php');
                exit;
            }
            else
            {
        ?>
        <div>
            <h3>Email already exists</h3>
            <p>Click here to <a href='register-employer.html'>go back</a></p>
        </div>
        <?php
            }
        ?>
    </body>
</html>