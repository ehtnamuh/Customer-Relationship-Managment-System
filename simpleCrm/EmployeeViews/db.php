<?php
$connection = mysqli_connect('localhost', 'root', '') 
    or die ("Database connection failed");
$db = mysqli_select_db($connection, 'simplecrm') or 
    die ("Database selection failed");
?>