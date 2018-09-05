<?php include "db.php"; ?>
<?php include "Mfunctions.php"; ?>
<?php 
if (isset($_POST['submitAdd'])){
    unset($_POST['submitAdd']);
    header("Location:http://localhost/simpleCrm/MnewLead.php");
} else if (isset($_POST['submitUpdate'])){
    unset($_POST['submitUpdate']);
    header("Location:http://localhost/simpleCrm/MupdateLead.php");
} else if (isset($_POST['search_lead'])){
    $attr = $_POST['attr'];
    $searchKey = $_POST['search'];
    $date_from = "";
    $date_to = "";
    if (isset($_POST['date_from'], $_POST['date_to'])){
        $date_from = $_POST['date_from'];
        $date_to = $_POST['date_to'];
    }   
    unset($_POST['attr'], $_POST['search'], $_POST['date_to'], $_POST['date_from'] );
    $searchClause = " WHERE  $attr LIKE '%$searchKey%' ";
    if ($date_from != ""){
        $searchClause .= " AND set_date >= '$date_from' ";
        $searchClause .= " AND set_date <= '$date_to' ";
    }
    $_SESSION['lead_search_clause'] = $searchClause;
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
                <li><a href="http://localhost/simpleCrm/logout.php">Lougout</a></li>

            </ul>
        </nav>
        <div class="container">
            <div class="col-lg-10">
                <h1 class = "text-center">Leads</h1>
                <form action="ManagerView.php" class="form-inline" method = "post">
                    <label for="attr">Atrribute:</label>
                    <select class="form-control" name="attr">
                        <option value="l_id">lead id</option>
                        <option value="leads.u_id">empl. id</option>
                        <option value="clients.c_id">client id</option>
                        <option value="a_id">action id</option>
                        <option value="c_name">client name</option>
                        <option value="value">value</option>
                        <option value="prospect">prospect</option>
                    </select>
                    <label for="search">Search:</label>   
                    <input type="text" name = "search" class = "form-control">
                    <input  type="submit" class="btn btn-success" name = "search_lead" value = "Search">
                    <label for="date_from">From:</label> 
                    <input type="date" id="date_from"
                           name="date_from" />
                    <label for="date_to">To:</label> 
                    <input type="date" id="date_to"
                           name="date_to" /> <br>
                </form>
                <div>
                    <?php
                    if (isset($_SESSION['lead_search_clause'])){
                        showLeads($_SESSION['lead_search_clause']);
                        unset($_SESSION['lead_search_clause']);
                    } else {
                        showLeads("");
                    }

                    ?>
                </div>
                <div>
                    <form action="ManagerView.php" method = "post">
                        <input  type="submit" class="btn btn-success" name = "submitAdd" value = "Add Lead">
                        <input type="submit" class="btn btn-success" name = "submitUpdate" value = "Update Lead">
                    </form>
                </div>
            </div>
        </div>
    </body>
</html>
