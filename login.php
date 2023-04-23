<?php
    session_start();
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Login</title>
        <link rel="stylesheet" href="style.css"/>
    </head>
    <body>
        <?php
            require('db.php');
            $email = $_POST['email'];
            $password = $_POST['password'];

            $query_user = "SELECT EMAIL FROM USER WHERE EMAIL = '$email' AND PASSWORD = '$password'";
            $result_user = mysqli_query($conn, $query_user) or die('Query failed: ' . mysqli_error($conn));
            if (mysqli_num_rows($result_user) == 1) {
                $_SESSION['email'] = $email;
                $query_jobseeker = "SELECT EMAIL FROM JOBSEEKER WHERE EMAIL = '$email'";
                $result_jobseeker = mysqli_query($conn, $query_jobseeker) or die('Query failed: ' . mysqli_error($conn));
                if (mysqli_num_rows($result_jobseeker) == 1)
                {
                    header("Location: job-seeker-main.php");
                }
                else
                {
                    header("Location: employer-main.php");
                }
            } else {
                echo "<div>
                        <h3>Incorrect email/password.</h3>
                        <p>Click here to <a href='index.php'>Login</a> again.</p>
                        </div>";
            }
            mysqli_close($conn);
        ?>
    </body>
</html>
