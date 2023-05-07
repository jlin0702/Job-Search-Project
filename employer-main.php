<?php
    session_start();
    if (!isset($_SESSION['email'])) {
        header("Location: index.php");
        exit;
    }
    $email = $_SESSION['email'];
?>
<!DOCTYPE html>
<head>
    <title>Employer Main Page</title>
    <link rel="stylesheet" href="styles.css"/>
</head>
<body class='main-body'>
    <?php
        require_once('db.php');
        $email = $_SESSION['email'];
        $query_user = "SELECT PHONENUMBER FROM USER WHERE EMAIL = '$email'";
        $result_user = mysqli_query($conn, $query_user) or die('Query failed: ' . mysqli_error($conn));
        $user = mysqli_fetch_assoc($result_user);
        $query_employer = "SELECT * FROM EMPLOYER WHERE EMAIL = '$email'";
        $result_employer = mysqli_query($conn, $query_employer) or die('Query failed: ' . mysqli_error($conn));
        if (mysqli_num_rows($result_employer) == 0)
        {
            header("Location: index.php");
        }
        $employer = mysqli_fetch_assoc($result_employer);
    ?>
    <header class="header">
        <h1 class="welcome">Welcome, <?php echo $employer['COMPANYNAME']?></h1>
        <button class="logout" onclick="location.href='logout.php'">Logout</button>
    </header>

    <div class="modalbuttons">
        <button class="modify-data-btn" onclick="openProfile()">View Profile</button>
        <button class="modify-data-btn" onclick="openPostJob()">Post a Job</button>
    </div>
    
    <div class="modal">
        <div class="modal-content">
            <span class="modal-close">&times;</span>
            <form action="modify-employer.php" method="POST">
                <h2>Edit Profile</h2>
                Email: <input type="email" id="mod-emp-email" name="mod-emp-email" class="short-input" value="<?php echo $email ?>" readonly>
                Phone Number: <input type="tel" id="mod-emp-phone" name="mod-emp-phone" class="short-input" placeholder="123-456-7890" value="<?php echo $user['PHONENUMBER']?>" pattern="[0-9]{3}-[0-9]{3}-[0-9]{4}" required>
				Company Name: <input type="text" id="mod-companyname" name="mod-companyname" class="short-input" value="<?php echo $employer['COMPANYNAME']?>" required>
                <button type="submit">Submit</button>
            </form>
        </div>
    </div>

    
    <div class="modal">
        <div class="modal-content">
            <span class="modal-close">&times;</span>
            <form action="add-job.php" method="POST">
                <h2>Post Job Information</h2>
                Job Title: <input type="text" name="jobtitle" required><br>
                Job Description: <textarea name="description"></textarea><br>
                Salary: <input type="number" step="0.01" name="salary" required><br>
                Location: <input type="text" name="location" required><br>
                <button type="submit">Publish</button>
        </form>
        </div>
    </div>

    <h2 class="center">Published Jobs</h2>
    <div class="row">
        <?php
            $query_jobs = "SELECT * FROM JOB WHERE EMPLOYEREMAIL='$email'";
            $result_jobs = mysqli_query($conn, $query_jobs) or die('Query failed: ' . mysqli_error($conn));
            while ($job = mysqli_fetch_assoc($result_jobs))
            {
                echo "<div class='item'>
                    <p>Job Title: ".$job['JOBTITLE']."</p>
                    <p>Job Description: ".$job['DESCRIPTION']."</p>
                    <p>Salary: $".$job['SALARY']."</p>
                    <p>Location: ".$job['LOCATION']."</p>
                    </div>";
            }
        ?>
    </div>

    <h2 class="center">Application Information</h2>
        <?php
        $query_application = "SELECT * FROM APPLY
            LEFT JOIN JOBSEEKER ON JOBSEEKEREMAIL=JOBSEEKER.EMAIL
            LEFT JOIN JOB ON JOBID=ID
            LEFT JOIN USER ON JOBSEEKEREMAIL=USER.EMAIL
            WHERE JOB.EMPLOYEREMAIL='$email'";
        $result_application = mysqli_query($conn, $query_application) or die('Query failed: ' . mysqli_error($conn));
        while ($application = mysqli_fetch_assoc($result_application))
        {
            echo "<div class='row'>";
            echo "<div class='item'>
                <p><b>Job title:</b> ".$application['JOBTITLE']."</p>
                <p>Last Name: ".$application['LASTNAME']."</p>
                <p>First Name: ".$application['FIRSTNAME']."</p>
                <p>Phone: ".$application['PHONENUMBER']."</p>
                <p>Email: ".$application['JOBSEEKEREMAIL']."</p>
                <p>University: ".$application['UNIVERSITY']."</p>
                <p>Major: ".$application['MAJOR']."</p>
                <p>Date Applied: ".$application['APPLICATIONDATE']."</p>
                </div>";
            $query_workexp = "SELECT WORKEXPERIENCE FROM JOBSEEKERWORKEXPERIENCE WHERE EMAIL='".$application['JOBSEEKEREMAIL']."'";
            $result_workexp = mysqli_query($conn, $query_workexp) or die('Query failed: ' . mysqli_error($conn));
            echo "<div class='item'>
                <h3>Work Experience</h3>";
            if (mysqli_num_rows($result_workexp) == 0)
            {
                echo "(empty)";
            }
            else
            {
                while ($workexp = mysqli_fetch_assoc($result_workexp))
                {
                    echo "<p>".$workexp['WORKEXPERIENCE']."</p>";
                }
            }
            echo "</div>";
            echo "</div>";
        }
        ?>
    <script>
        function openProfile() {
            document.getElementsByClassName("modal")[0].style.display = "block";
        }

        function closeProfile() {
            document.getElementsByClassName("modal")[0].style.display = "none";
        }

        document.getElementsByClassName("modal-close")[0].addEventListener("click", function() {
            closeProfile();
        });

        function openPostJob() {
            document.getElementsByClassName("modal")[1].style.display = "block";
        }

        function closePostJob() {
            document.getElementsByClassName("modal")[1].style.display = "none";
        }

        document.getElementsByClassName("modal-close")[1].addEventListener("click", function() {
            closePostJob();
        });
    </script>
</body>
</html>
