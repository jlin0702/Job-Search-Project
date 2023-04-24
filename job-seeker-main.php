<?php
    session_start();
    if (!isset($_SESSION['email'])) {
        header("Location: index.php");
        exit;
    }
?>
<!DOCTYPE html>
<head>
    <title>Job Seeker Main Page</title>
    <link rel="stylesheet" href="styles.css"/>
</head>
<body class='main-body'>
    <?php
        require_once('db.php');
        $email = $_SESSION['email'];
        $query_user = "SELECT PHONENUMBER FROM USER WHERE EMAIL = '$email'";
        $result_user = mysqli_query($conn, $query_user) or die('Query failed: ' . mysqli_error($conn));
        $user = mysqli_fetch_assoc($result_user);
        $query_jobseeker = "SELECT * FROM JOBSEEKER WHERE EMAIL = '$email'";
        $result_jobseeker = mysqli_query($conn, $query_jobseeker) or die('Query failed: ' . mysqli_error($conn));
        $jobseeker = mysqli_fetch_assoc($result_jobseeker);
    ?>
    <header class="header">
        <h1 class="welcome">Welcome, <?php echo $jobseeker["FIRSTNAME"] . ' ' . $jobseeker["LASTNAME"] ?></h1>
        <button class="logout" onclick="location.href='logout.php'">Logout</button>
    </header>

    <section class="personal-info">
        <button class="modify-data-btn" onclick="openModal()">View Profile</button>
    </section>

    <div class="modal" id="modifyDataModal">
        <div class="modal-content">
            <span class="modal-close">&times;</span>
            <form id="modifyDataForm" action="modify-job-seeker.php" method="POST">
				Email: <input type="email" id="mod-email" name="mod-email" class="short-input" value="<?php echo $email ?>" readonly>
                Phone: <input type="tel" id="mod-phone" name="mod-phone" class="short-input" placeholder="123-456-7890" value="<?php echo $user["PHONENUMBER"]?>" pattern="[0-9]{3}-[0-9]{3}-[0-9]{4}" required>
				First Name: <input type="text" id="mod-firstname" name="mod-firstname" class="short-input" value="<?php echo $jobseeker["FIRSTNAME"]?>" required>
				Last Name: <input type="text" id="mod-lastname" name="mod-lastname" class="short-input" value="<?php echo $jobseeker["LASTNAME"]?>" required>
				University: <input type="text" id="mod-university" name="mod-university" class="short-input" value="<?php echo $jobseeker["UNIVERSITY"]?>" required>
				Major: <input type="text" id="mod-major" name="mod-major" class="short-input" value="<?php echo $jobseeker["MAJOR"]?>" required>
                <?php 
                    $query_workexp = "SELECT WORKEXPERIENCE FROM JOBSEEKERWORKEXPERIENCE WHERE EMAIL = '$email'";
                    $result_workexp = mysqli_query($conn, $query_workexp) or die('Query failed: ' . mysqli_error($conn));
                    $workexp_arr = array();
                    while ($workexp = mysqli_fetch_assoc($result_workexp))
                    {
                        array_push($workexp_arr, $workexp['WORKEXPERIENCE']);
                    }
                ?>
                Work Experiences (delimit with ;): <input type="text" id="workexp" name="workexp" class="short-input" value="<?php echo implode(';', $workexp_arr)?>">
                <input type="submit">
                <button type="button" class="cancel" onclick="closeModal()">Cancel</button>
            </form>
        </div>
    </div>

    <section class="job-listings">
        <h2>Job Listings</h2>
        <?php
            $query_jobs = "SELECT * FROM JOB JOIN EMPLOYER";
            $result_jobs = mysqli_query($conn, $query_jobs) or die('Query failed: ' . mysqli_error($conn));
            while ($job = mysqli_fetch_assoc($result_workexp))
            {
                // echo "<div class='job-listing'>
                //     Job Title: ".$job['JOBTITLE']."<br>
                //     Company Name: ".$job['COMPANYNAME']."<br>
                //     Location: ".$job['LOCATION']."<br>
                //     Salary：$".$job['SALARY']."<br>
                //     Description: ".$job['DESCRIPTION']."<br>
                //     <button>Apply</button>
                //     </div>"
            }
        ?>
    </section>
    <script>
        function openModal() {
            document.getElementById("modifyDataModal").style.display = "block";
        }

        function closeModal() {
            document.getElementById("modifyDataModal").style.display = "none";
        }

        document.getElementsByClassName("modal-close")[0].addEventListener("click", function() {
            closeModal();
        });
    </script>
</body>
</html>
