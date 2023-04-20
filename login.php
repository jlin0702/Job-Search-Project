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
            if (isset($_SESSION['email'])) {
                $query_jobseeker = "SELECT * FROM USER WHERE EMAIL = '$email";
                $result_jobseeker = mysqli_query($conn, $query_jobseeker) or die('Query failed: ' . mysqli_error($conn));
                if (mysqli_num_rows($result_jobseeker) == 1)
                {
                    header("Location: job-seeker-main.html");
                }
                else
                {
                    header("Location: employer-main.html");
                }
                exit;
            }
            
            require('db.php');
            $email = $_POST['email'];
            $password = md5($_POST['password']);

            $query_user = "SELECT * FROM USER WHERE EMAIL = '$email' AND PASSWORD = '$password'";
            $result_user = mysqli_query($conn, $query_user) or die('Query failed: ' . mysqli_error($conn));
            if (mysqli_num_rows($result_user) == 1) {
                $_SESSION['email'] = $email;
                $query_jobseeker = "SELECT * FROM USER WHERE EMAIL = '$email";
                $result_jobseeker = mysqli_query($conn, $query_jobseeker) or die('Query failed: ' . mysqli_error($conn));
                if (mysqli_num_rows($result_jobseeker) == 1)
                {
                    header("Location: job-seeker-main.html");
                }
                else
                {
                    header("Location: employer-main.html");
                }
            } else {
                echo "<div>
                        <h3>Incorrect email/password.</h3>
                        <p>Click here to <a href='login.php'>Login</a> again.</p>
                        </div>";
            }
            mysqli_close($conn);
        ?>
    </body>
</html>
