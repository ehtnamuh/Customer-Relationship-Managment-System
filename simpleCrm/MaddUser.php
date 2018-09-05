<?php include "ManagerViews\\db.php"; ?>
<?php include "ManagerViews\\Mfunctions.php"; ?>
<?php
if(isset($_POST['add_user'])){
    insertUser();
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Simple CRM</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css" >
        <link rel="stylesheet" href="http://localhost/simpleCrm/style/navbar.css">
    </head>
    <body>
        <nav>
            <ul>
                <li><a href="http://localhost/simpleCrm/ManagerViews/ManagerViewUsers.php">Users</a></li> 
                <li><a href="http://localhost/simpleCrm/ManagerViews/ManagerView.php">Leads</a></li>    
                <li><a href="http://localhost/simpleCrm/ManagerViews/ManagerViewClients.php">Clients</a></li>    
                <li><a href="http://localhost/simpleCrm/ManagerViews/ManagerViewActions.php">Actions</a></li>    
                <li><a href="http://localhost/simpleCrm/ManagerViews/ManagerViewReports.php">Reports</a></li>    
            </ul>
        </nav>
        <div class="container">
            <div class="col-sm-6">
                <h1 class = "text-center">Add User</h1>
                <form action="MaddUser.php" method = "post">
                    <div class="form-group">
                        <label for="username">username</label>   
                        <input type="text" name = "username" class = "form-control">
                    </div>
                    <div class="form-group">
                        <label for="role">Role:</label> 
                        <br>
                        <select name="role" id="">
                            <?php
                            $roles = ["employee", "manager"];
                            foreach($roles as $role){
                                echo "<option value='".$role."'>".$role."</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>   
                        <input type="text" name = "password" class = "form-control"> 
                    </div>
                    <div class="form-group">
                        <?php
                        $now = time();
                        echo "<b>Join Date:</b><br>";
                        echo(date("Y-m-d",$now));
                        ?>
                    </div>
                    <input class = "btn btn-success" type="submit" name = "add_user" value = "Add User">
                </form>
            </div>
        </div>


    </body>
</html>