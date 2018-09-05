<?php include "EmployeeViews\\db.php"; ?>
<?php include "EmployeeViews\\functions.php"; ?>
<?php
if(isset($_POST['update_action'])){
    updateAction();
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
                <h1 class = "text-center">Update Action</h1>

                <form action="updateAction.php" method = "post">
                    <div class="form-group">
                        <label for="a_id">Action Id</label>   
                        <input type="text" name = "a_id" class = "form-control">
                    </div>
                    <div>
                        <label for="a_desc">Action Description:</label>
                        <textarea class="form-control" rows="5" name = "a_desc" id="a_desc"></textarea>
                    </div> <br>
                    <div class="form-group">
                        <label for="due_date">Action Due Date:</label> <br>
                        <input type="date" id="due_date"
                               name="due_date" />
                    </div> <br>
                    <input class = "btn btn-primary" type="submit" name = "update_action" value = "Update"><br>
                    <h6>Note: Action can only be set to completed from UPDATE LEAD</h6>
                </form>
            </div>
        </div>


    </body>
</html>