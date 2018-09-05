<?php include "EmployeeViews\\db.php"; ?>
<?php include "EmployeeViews\\functions.php"; ?>
<?php
if (isset($_POST['submit'])){
    authenticateUser();
}
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Login</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css" >
    </head>
    <body>
        <div class="container">

            <div class="col-sm-6">
                <h1 class = "text-center">Login to Simple CRM</h1>
                <form action="loginForm.php" method = "post">
                    <div class="form-group">
                        <label for="id">ID</label>   
                        <input type="text" name = "id" class = "form-control">
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>   
                        <input type="password" name = "password" class = "form-control">
                    </div>
                    <div class="form-group">
                        <select name="role" id="">
                            <?php
                            $roles = ["manager","employee"];
                            foreach($roles as $role){
                                echo "<option value='".$role."'>".$role."</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <input class = "btn btn-primary" type="submit" name = "submit" value = "LOGIN">
                </form>
            </div>
        </div>


    </body>
</html>