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
            #check if email already exists
            $query_email = "SELECT * FROM USER WHERE EMAIL = '$email'";
            $result_email = mysqli_query($query_email) or die(mysql_error());
            $email_rows = mysqli_num_rows($result_email);
            if ($email_rows == 0)
            {
                $query_user = "INSERT INTO USER
                    VALUES ('$email', '$phone', '$password')";
                $result_user = mysqli_query($query_user) or die('Query failed: ' . mysqli_error());
                $query_jobseeker = "INSERT INTO JOBSEEKER
                    VALUES ('$email', '$firstname', '$lastname', '$degree', '$university')";
                $result_jobseeker = mysqli_query($query_jobseeker) or die('Query failed: ' . mysqli_error());
            
                for ($i = 0; $i < count($workexp); $i++)
                {
                    $query_workexp = "INSERT INTO JOBSEEKERWORKEXPERIENCE
                        VALUES ('$email', '$workexp[$i]')";
                    $result_user = mysqli_query($query_workexp) or die('Query failed: ' . mysqli_error());
                }
        ?>
        <div>
            <h3>You are registered successfully.</h3>
            <p>Click here to <a href='index.html'>Login</a></p>
        </div>
        <?php
            }
            else
            {
        ?>
        <div>
            <h3>Email already exists</h3>
            <p>Click here to <a href='register-job-seeker.html'>go back</a></p>
        </div>
        <?php
            }
            // Close connection
            mysqli_close($conn);
        ?>
    </body>
</html>