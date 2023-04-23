<?php
    session_start();
?>
<!DOCTYPE html>
<head>
    <title>Welcome</title>
    <link rel="stylesheet" href="style.css"/>
</head>
<body>
    <?php
        require('db.php');
        if (isset($_SESSION['email'])) {
            $email = $_SESSION['email'];
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
            exit;
        }
    ?>
    <h1>Login</h1>
    <form action="login.php" method="POST">
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required>
        <br>
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required>
        <br>
        <input type="submit" value="Login">
    </form>
    <p>Don't have an account? <a href="register-job-seeker.php">Register as Job Seeker</a> or <a href="register-employer.php">Register as Employer</a></p>
</body>
</html>
