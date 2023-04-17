<?php
    $conn = mysql_connect('mysql.eecs.ku.edu', '***username here***', '***password here***')
                or die('Could not connect: ' . mysql_error());
    mysql_select_db('***database name here***') or die('Could not select database');
?>