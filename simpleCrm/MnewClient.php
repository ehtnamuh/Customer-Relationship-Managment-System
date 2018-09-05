<?php include "ManagerViews\\db.php"; ?>
<?php include "ManagerViews\\Mfunctions.php"; ?>
<?php
if(isset($_POST['add_client'])){
    insertClient();
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
                <h1 class = "text-center">New Client</h1>
                <form action="MnewClient.php" method = "post">
                    <div class="form-group">
                        <label for="u_id">Employee Id</label>   
                        <input type="text" name = "u_id" class = "form-control">
                        <label for="c_name">Company Name</label>   
                        <input type="text" name = "c_name" class = "form-control">
                        <label for="c_add">Company Address</label>   
                        <textarea class="form-control" rows="4" name = "c_add"  id = "c_add"></textarea>
                        <label for="contact">Contact Person</label>   
                        <input type="text" name = "contact" class = "form-control">
                        <label for="c_email">Email</label>   
                        <input type="text" name = "c_email" class = "form-control">
                        <label for="c_phone">Phone Number</label>   
                        <input type="text" name = "c_phone" class = "form-control">
                    </div>
                    <input type="submit" name = "add_client" value = "Add Client">
                </form>
            </div>
        </div>


    </body>
</html>