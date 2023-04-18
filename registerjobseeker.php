<!DOCTYPE html>
<html>
    <head>
        <title>Register Job Seeker</title>
        <link rel="stylesheet" href="style.css"/>
    </head>
    <body>
        <?php
            $email = $_POST['email'];
            $password = md5($_POST['password']);
            $phone = $_POST['phone'];
            $firstname = $_POST['firstname'];
            $lastname = $_POST['lastname'];
            $degree = $_POST['mostrecentdegree'];
            $university = $_POST['mostrecentuniversity'];
            $workexp = array();
            for ($i = 1; $i <= 5; $i++)
            {
                array_push($workexp, $_POST['workexp'.$i]);
            }
            $query_user = "INSERT INTO USER
                VALUES ('$email', '$password', '$phone', '$firstname', '$lastname', '$degree', '$university')";
            $result_user = mysql_query($query) or die('Query failed: ' . mysql_error());

            // Free resultset
            mysql_free_result($result_user);
            mysql_free_result($result_workexp);
            // Close connection
            mysql_close($conn);
        ?>
        <div>
            <h3>You are registered successfully.</h3>
            <p>Click here to <a href='login.php'>Login</a></p>
        </div>
    </body>
</html>