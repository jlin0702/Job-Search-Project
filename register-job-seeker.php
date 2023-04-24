<!DOCTYPE html>
<html>
    <head>
        <title>Register Job Seeker</title>
        <link rel="stylesheet" href="styles.css"/>
    </head>
    <body class='login-register-body'>
        <?php
            require_once('db.php');
            $email = $_POST['email'];
            $password = $_POST['password'];
            $phone = $_POST['phone'];
            $firstname = $_POST['firstname'];
            $lastname = $_POST['lastname'];
            $university = $_POST['university'];
            $major = $_POST['major'];
            #check if email already exists
            $query_email = "SELECT * FROM USER WHERE EMAIL = '$email'";
            $result_email = mysqli_query($conn, $query_email) or die(mysqli_error($conn));
            $email_rows = mysqli_num_rows($result_email);
            if ($email_rows == 0)
            {
                $query_user = "INSERT INTO USER
                    VALUES ('$email', '$phone', '$password')";
                $result_user = mysqli_query($conn, $query_user) or die('Query failed: ' . mysqli_error($conn));
                $query_jobseeker = "INSERT INTO JOBSEEKER
                    VALUES ('$email', '$firstname', '$lastname', '$major', '$university')";
                $result_jobseeker = mysqli_query($conn, $query_jobseeker) or die('Query failed: ' . mysqli_error($conn));

                echo "<div>
                    <h3>You are registered successfully.</h3>
                    <p>Click here to <a href='index.php'>Login</a></p>
                    </div>";
            }
            else
            {
                echo "<div>
                    <h3>Email already exists</h3>
                    <p>Click here to <a href='register-job-seeker.html'>go back</a></p>
                    </div>";
            }
            // Close connection
            mysqli_close($conn);
        ?>
    </body>
</html>