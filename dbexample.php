<?php
    $conn = mysqli_connect('mysql.eecs.ku.edu', '***username here***', '***password here***')
                or die('Could not connect: ' . mysqli_error($conn));
    mysqli_select_db('***database name here***') or die('Could not select database');
?>