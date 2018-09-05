<?php include "db.php"; ?>
<?php include "functions.php"; ?>
<?php 
if (isset($_POST['search_clients'])){
    $attr = $_POST['attr'];
    $searchKey = $_POST['search'];
    $date_from = "";
    $date_to = "";
    if (isset($_POST['date_from'], $_POST['date_to'])){
        $date_from = $_POST['date_from'];
        $date_to = $_POST['date_to'];
    }   
    unset($_POST['attr'], $_POST['search'], $_POST['date_to'], $_POST['date_from'], $_POST['search_clients'] );
    $searchClause = " AND  $attr LIKE '%$searchKey%' ";
    if ($date_from != ""){
        $searchClause .= " AND date_added >= '$date_from' ";
        $searchClause .= " AND date_added <= '$date_to' ";
    }
    $_SESSION['client_search_clause'] = $searchClause;
} else if (isset($_POST['submitAdd'])){
    unset($_POST['submitAdd']);
    header("Location:http://localhost/simpleCrm/newClient.php");
} else if (isset($_POST['submitUpdate'])){
    unset($_POST['submitUpdate']);
    header("Location:http://localhost/simpleCrm/updateClient.php");
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
                <li><a href="http://localhost/simpleCrm/logout.php">Lougout</a></li>   
            </ul>
        </nav>
        <div class="container">
            <div class="col-sm-10">
                <h1 class = "text-center">Clients</h1>
                <form action="employeeViewClients.php" class="form-inline" method = "post">
                    <label for="sel1">Atrribute:</label>
                    <select class="form-control" name="attr">
                        <option value="c_id">Client Id</option>
                        <option value="c_name">Name</option>
                        <option value="c_add">Address</option>
                        <option value="contact">Contact</option>
                        <option value="c_email">Email</option>
                        <option value="c_phone">Phone</option>
                        <option value="t_value">Value</option>
                    </select>
                    <label for="search">Search:</label>   
                    <input type="text" name = "search" class = "form-control">
                    <input  type="submit" class="btn btn-success" name = "search_clients" value = "Search">
                    <label for="date_from">From:</label> 
                    <input type="date" id="date_from"
                           name="date_from" />
                    <label for="date_to">To:</label> 
                    <input type="date" id="date_to"
                           name="date_to" /> <br>
                </form>
                <div>
                    <?php
                    
                    if (isset($_SESSION['client_search_clause'])){
                        showClients($_SESSION['client_search_clause']);
                        unset($_SESSION['client_search_clause']);
                    } else {
                        showClients("");
                    }
                    ?>
                </div>
                <form action= "employeeViewClients.php" method = "post">
                    <input type="submit" class="btn btn-success" name = "submitAdd" value = "Add Client">
                    <input type="submit" class="btn btn-success" name = "submitUpdate" value = "Update Client">
                </form>
            </div>
        </div>

    </body>
</html>