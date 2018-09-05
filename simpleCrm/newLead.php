<?php include "EmployeeViews\\db.php"; ?>
<?php include "EmployeeViews\\functions.php"; ?>
<?php
if(isset($_POST['add_lead'])){
    insertLead();
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
                <h1 class = "text-center">New Lead</h1>

                <form action="newLead.php" method = "post">
                    <div class="form-group">
                        <?php echo "<b>Employee Id:    ".$_SESSION['id']."<b/>"; ?>  
                    </div>
                    <div class="form-group">
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
                        <label for="t_value">Transaction Value</label>   
                        <input type="text" name = "t_value" class = "form-control">
                    </div>
                    <div class="form-group">
                        <label for="prospect">Prospect:</label> 
                        <br>
                        <select name="prospect" id="">
                            <?php
                            $prospects = ["20%","60%","80%"];
                            foreach($prospects as $prospect){
                                echo "<option value='".$prospect."'>".$prospect."</option>";
                            }
                            ?>
                        </select>
                    </div>
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
                    <input class = "btn btn-primary" type="submit" name = "add_lead" value = "Add Lead">
                </form>
            </div>
        </div>


    </body>
</html>