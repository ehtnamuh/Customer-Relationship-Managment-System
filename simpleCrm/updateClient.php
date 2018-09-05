<?php include "EmployeeViews\\db.php"; ?>
<?php include "EmployeeViews\\functions.php"; ?>
<?php
if(isset($_POST['update_client'])){
    updateClient();
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
                <li><a href="http://localhost/simpleCrm/EmployeeViews/employeeView.php">Leads</a></li>    
                <li><a href="http://localhost/simpleCrm/EmployeeViews/employeeViewClients.php">Clients</a></li>    
                <li><a href="http://localhost/simpleCrm/EmployeeViews/employeeViewActions.php">Actions</a></li>    
                <li><a href="http://localhost/simpleCrm/EmployeeViews/employeeViewReports.php">Reports</a></li>    
            </ul>
        </nav>
        <div class="container">
            <div class="col-sm-6">
                <h1 class = "text-center">Update Client</h1>
                <h5 class = "text-center">Note: Leave any field you do not wish to update blank</h5>
                <form action="updateClient.php" method = "post">
                    <div>
                        <label for="c_id">Client Id</label> 
                        <br>
                        <select name="c_id" id="">
                            <?php
                            global $connection;
                            $query = "SELECT c_id FROM clients WHERE clients.u_id =".$_SESSION['id'];
                            $result = mysqli_query($connection, $query);
                            while ($row = mysqli_fetch_assoc($result)){
                                echo "<option value='".$row['c_id']."'>".$row['c_id']."</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="c_add">Company Address</label>   
                        <textarea class="form-control" rows="4" value = "" name = "c_add"  id = "c_add"></textarea>
                        <label for="contact">Contact Person</label>   
                        <input type="text" value = "" name = "contact" class = "form-control">
                        <label for="c_email">Email</label>   
                        <input type="text" value = "" name = "c_email" class = "form-control">
                        <label for="c_phone">Phone Number</label>   
                        <input type="text" value = "" name = "c_phone" class = "form-control">
                    </div>
                    <input type="submit" class="btn btn-success" name = "update_client" value = "Update Client">
                </form>
            </div>
        </div>


    </body>
</html>