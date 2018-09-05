<?php include "ManagerViews\\db.php"; ?>
<?php include "ManagerViews\\Mfunctions.php"; ?>
<?php
if(isset($_POST['reassign_client'])){
    reassignClient();
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
                <h1 class = "text-center">Update Client</h1>
                <h5 class = "text-center">Note: To Enter multiple c_ids, Separate them using ','</h5>
                <form action="MreassignClient.php" method = "post">
                    <div class="form-group">
                        <label for="c_id">Client Ids</label>   
                        <textarea class="form-control" rows="4" value = "" name = "c_id"  id = "c_id"></textarea>
                    </div>
                    <div>
                        <label for="u_id">Reassign to Employee Id:</label> 
                        <br>
                        <select name="u_id" id="">
                            <?php
                            global $connection;
                            $query = "SELECT id FROM users WHERE is_active = '1'";
                            $result = mysqli_query($connection, $query);
                            while ($row = mysqli_fetch_assoc($result)){
                                echo "<option value='".$row['id']."'>".$row['id']."</option>";
                            }
                            ?>
                        </select>
                    </div><br>
                    <input type="submit" class="btn btn-success" name = "reassign_client" value = "Reassign Client">
                </form>
            </div>
        </div>


    </body>
</html>