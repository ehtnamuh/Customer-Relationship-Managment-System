<?php include "ManagerViews\\db.php"; ?>
<?php include "ManagerViews\\Mfunctions.php"; ?>
<?php
if(isset($_POST['update_user'])){
    updateUser();
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
                <h1 class = "text-center">Update User</h1>
                <form action="MupdateUser.php" method = "post">
                    <div class="form-group">
                        <label for="id">Employee Id</label>   
                        <input type="text" name = "id" class = "form-control">
                    </div>
                    <h5>Note: Leave next rows empty if there is no change</h5>
                    <div class="form-group">
                        <label for="username">Username</label>   
                        <input type="text" value="" name = "username" class = "form-control">
                    </div>
                    <div class="form-group">
                        <label for="is_active">Is Active:</label> 
                        <br>
                        <select name="is_active" id="">
                            <?php
                            $states = [-1, 0, 1];
                            foreach($states as $state){
                                echo "<option value='".$state."'>".$state."</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <input class = "btn btn-success" type="submit" name = "update_user" value = "Update User">
                </form>
            </div>
        </div>


    </body>
</html>