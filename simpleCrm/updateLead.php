<?php include "EmployeeViews\\db.php"; ?>
<?php include "EmployeeViews\\functions.php"; ?>
<?php
if(isset($_POST['update_lead'])){
    updateLead();
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
                <h1 class = "text-center">Update Lead</h1>

                <form action="updateLead.php" method = "post">
                    <div class="form-group">
                        <?php echo "<b>Employee Id:    ".$_SESSION['id']."<b/>"; ?>  
                    </div>
                    <div class="form-group">
                        <label for="l_id">Lead Id</label>   
                        <input type="text" name = "l_id" class = "form-control">
                        <label for="t_value">Transaction Value( Enter 0 if no change )</label>   
                        <input type="text" name = "t_value" value = 0 class = "form-control">
                    </div>
                    <div class="form-group">
                        <label for="prospect">Prospect:(Note 100% will mean the transaction is complete)</label> 
                        <br>
                        <select name="prospect" id="">
                            <?php
                            $prospects = ["80%","60%","20%","100%"];
                            foreach($prospects as $prospect){
                                echo "<option value='".$prospect."'>".$prospect."</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <h6>Note: previous action will be set to completed</h6>
                    <h6>Note: The following fields will be ignored if prospect is 100%</h6>
                    <div>
                        <label for="a_desc">Action Description:</label>
                        <textarea class="form-control" rows="5" name = "a_desc" id="a_desc"></textarea>
                    </div> <br>
                    <div class="form-group">
                        <?php
                        $now = time();
                        echo "<b>Action Set Date:</b><br>";
                        echo(date("Y-m-d",$now));
                        ?>
                    </div>
                    <div class="form-group">
                        <label for="due_date">Action Due Date:</label> <br>
                        <input type="date" id="due_date"
                               name="due_date" />
                    </div> <br>
                    <input class = "btn btn-primary" type="submit" name = "update_lead" value = "Update"><br>
                </form>
            </div>
        </div>


    </body>
</html>