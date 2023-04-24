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
        $employer = mysqli_fetch_assoc($result_employer);
    ?>
    <header class="header">
        <h1 class="welcome">Welcome, <?php echo $employer['COMPANYNAME']?></h1>
        <button class="logout" onclick="location.href='logout.php'">Logout</button>
    </header>

    <button class="modify-data-btn" onclick="openProfile()">View Profile</button>

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

    <button class="modify-data-btn" onclick="openPostJob()">Post a Job</button>
    <div class="modal">
        <div class="modal-content">
            <span class="modal-close">&times;</span>
            <form action="add-job.php" method="POST">
                <h2>Post Job Information</h2>
                Job Title: <input type="text" name="jobtitle"><br>
                Job Description: <textarea name="description"></textarea><br>
                Salary: <input type="number" step="0.01" name="salary"><br>
                Location: <input type="text" name="location"><br>
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
    <div class="row">
        <div class="item">
            <p>Job title: none</p>
            <p>Email: none</p>
            <p>Surname: none</p>
            <p>First Name: none</p>
            <p>Most Recent University: none</p>
            <p>Most Recent Degree: none</p>
        </div>
        <div class="item">
            <p>Job title: none</p>
            <p>Email: none</p>
            <p>Surname: none</p>
            <p>First Name: none</p>
            <p>Most Recent University: none</p>
            <p>Most Recent Degree: none</p>
        </div>
        <div class="item">
            <p>Job title: none</p>
            <p>Email: none</p>
            <p>Surname: none</p>
            <p>First Name: none</p>
            <p>Most Recent University: none</p>
            <p>Most Recent Degree: none</p>
        </div>
    </div>
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
