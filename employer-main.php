<?php
    session_start();
?>
<!DOCTYPE html>
<head>
    <title>Employer Main Page</title>
    <link rel="stylesheet" href="styles.css"/>
</head>
<body class='main-body'>
    <h1>Welcome, <?php echo $_SESSION['email']; ?> </h1>
    <h2>Post a Job</h2>
    <form action="server-side-code" method="POST">
        <label for="job_title">Job Title:</label>
        <input type="text" id="job_title" name="job_title" required>
        <br>
        <label for="location">Location:</label>
        <input type="text" id="location" name="location" required>
        <br>
        <label for="job_description">Job Description:</label>
        <textarea id="job_description" name="job_description" required></textarea>
        <br>
        <label for="salary">Salary:</label>
        <input type="number" id="salary" name="salary" step="0.01" required>
        <br>
        <input type="submit" value="Post Job">
    </form>
    <?php
        require_once('db.php');
        // $query_postings = "SELECT * ";
    ?>
    <h2>Current Job Postings</h2>
    <h3>[Job Title]</h3>
    <p>[Job Description]</p>
    <p>Location: [Location] | Salary: [Salary]</p>
    <button>View </button>

    <h3>[Job Seeker Name] applied for [Job Title]</h3>
    <p>Application Date: [Application Date] | Application Status: [Application Status]</p>
    <button>View Profile</button>
    <!-- <h2>Job Applications</h2>
    <h3>[Job Seeker Name] applied for [Job Title]</h3>
    <p>Application Date: [Application Date] | Application Status: [Application Status]</p>
    <button>View Profile</button> -->
    <?php
        mysqli_close($conn);
    ?>
</body>
</html>
