<?php include "EmployeeViews\\db.php"; ?>
<?php include "EmployeeViews\\functions.php"; ?>
<?php 
    $_POST = array();
    removeSession();
    header("Location:http://localhost/simpleCrm/loginForm.php");
?>