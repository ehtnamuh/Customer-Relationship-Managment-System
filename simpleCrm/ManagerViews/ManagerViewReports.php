<?php include "db.php"; ?>
<?php include "Mfunctions.php"; ?>

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
                <li><a href="http://localhost/simpleCrm/logout.php">Lougout</a></li>    
            </ul>
        </nav>
        <div class="container">
            <div class="col-sm-6">
                <h1 class = "text-center">Report for</h1>
                <?php 
                global $connection;
                $now = time();
                $date = date("Y-F",$now);
                echo "<h3 class = 'text-center'>".$date."</h3>";
                ////////////////////////////////////////////////////////////////////////////////////////////
                $query = "SELECT leads.prospect, COUNT(leads.c_id) AS num_leads, SUM(leads.value) AS value "; 
                $query .= " FROM leads INNER JOIN actions ON leads.a_id = actions.a_id ";
                $query .= " WHERE year(actions.set_date) = year(curdate())";
                $query .= " AND MONTH(actions.set_date) = month(curdate())";
                $query .= " GROUP BY leads.prospect";
                echo "<h3>Prospect Table<h3>";
                $result = mysqli_query($connection, $query);
                if (!$result){
                    die('Query FAILED'. mysqli_error($connection));
                }
                echo   '<div style="width:400px; height:175px; overflow:auto;">';
                echo "<table width = 100%>
                <tr>
                    <th>Prospect</th><th>Number Of Leads</th>
                    <th>Value (Tk.)</th>
                </tr>";
                while($row = mysqli_fetch_assoc($result))
                { 
                    echo "<tr>
                        <td> ".$row['prospect']."</td><td>"
                        .$row['num_leads']."</td><td>"
                        .$row['value']."</td>
                        </tr>";
                }
                echo "</table>";
                echo "</div><br>";
                //////////////////////////////////////////////////////////////////////////////////////////
                $query = "SELECT SUM(leads.value) AS potential_income,";
                $query .= " SUM(CASE WHEN leads.prospect = 100 THEN leads.value ELSE 0 END)";
                $query .= " AS actual_income"; 
                $query .= " FROM leads INNER JOIN actions ON leads.a_id = actions.a_id ";
                $query .= " WHERE year(actions.set_date) = year(curdate())";
                $query .= " AND MONTH(actions.set_date) = month(curdate())";

                $result = mysqli_query($connection, $query);

                if (!$result){
                    die('Query FAILED'. mysqli_error($connection));
                }
                echo "<h3>Prospect To Value<h3>";
                echo  '<div style="width:400px; height:100px; overflow:auto;">';
                echo "<table width = 100%>
                <tr>
                    <th>Potential Income</th><th>Actual Income</th>
                </tr>";
                $percentage_converted = -1;
                while($row = mysqli_fetch_assoc($result))
                { 
                    echo "<tr>
                        <td> ".$row['potential_income']."</td><td>"
                        .$row['actual_income']."</td>
                        </tr>";
                    $percentage_converted = round( ($row['actual_income']/$row['potential_income'])*100 );
                }
                echo "</table>";
                echo "</div><br>";

                echo "<h4>Leads Converted to Value:   ".$percentage_converted."%<h4>";

                //////////////////////////////////////////////////////////////////////////////////////////
                $query = "SELECT leads.l_id, clients.c_name, clients.contact , leads.value, actions.set_date"; $query .= " FROM leads INNER JOIN clients ON leads.c_id = clients.c_id"; 
                $query .= " INNER JOIN actions ON leads.a_id = actions.a_id"; 
                $query .= " WHERE leads.prospect = 100";
                $query .= " AND year(actions.set_date) = year(curdate())";
                $query .= " AND MONTH(actions.set_date) = month(curdate())";

                $result = mysqli_query($connection, $query);

                if (!$result){
                    die('Query FAILED'. mysqli_error($connection));
                }
                echo "<h3>Sales Details<h3>";
                echo '<div style="width:620px; height:200px; overflow:auto;">';
                echo "<table width = 100%>
                <tr>
                    <th>Lead Id</th><th>Company Name</th>
                    <th>Contact Person</th><th>Value (Tk.)</th>
                    <th>Sale Date</th>
                </tr>";
                while($row = mysqli_fetch_assoc($result))
                { 
                    echo "<tr>
                        <td> ".$row['l_id']."</td><td>"
                        .$row['c_name']."</td><td>"
                        .$row['contact']."</td><td>"
                        .$row['value']."</td><td>"
                        .$row['set_date']."</td>
                        </tr>";
                }
                echo "</table>";
                echo "</div><br>";

                $query = "SELECT COUNT(actions.a_id) AS a_all,";
                $query .= " SUM(CASE WHEN actions.completed = 1 THEN 1 ELSE 0 END) AS a_comp";
                $query .= " FROM actions ";
                $query .= " WHERE year(actions.due_date) = year(curdate())";
                $query .= " AND MONTH(actions.due_date) = month(curdate())";

                $result = mysqli_query($connection, $query);

                if (!$result){
                    die('Query FAILED'. mysqli_error($connection));
                }
                $row = mysqli_fetch_assoc($result);
                echo "<h3>Number of actions set : ".$row['a_all']."<h3>";
                echo "<h3>Number of actions completed: ".$row['a_comp']."<h3>";
                echo "<h3>Action Completion Rate: ".round(($row['a_comp']/$row['a_all'])*100)."%<h3>";


                ?>
                <h3>Top 5 Clients</h3>
            </div>
        </div>

    </body>
</html>