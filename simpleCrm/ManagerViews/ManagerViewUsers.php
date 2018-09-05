<?php include "db.php"; ?>
<?php include "Mfunctions.php"; ?>
<?php 
if (isset($_POST['submitAdd'])){
    unset($_POST['submitAdd']);
    header("Location:http://localhost/simpleCrm/MaddUser.php");
} else if (isset($_POST['submitUpdate'])){
    unset($_POST['submitUpdate']);
    header("Location:http://localhost/simpleCrm/MupdateUser.php");
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
        $searchClause .= " AND join_date >= '$date_from' ";
        $searchClause .= " AND join_date <= '$date_to' ";
    }
    $_SESSION['users_search_clause'] = $searchClause;
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
                <h1 class = "text-center">Employees</h1>
                <form action="ManagerViewUsers.php" class="form-inline" method = "post">
                    <label for="attr">Atrribute:</label>
                    <select class="form-control" name="attr">
                        <option value="id">Empl. Id</option>
                        <option value="username">Username</option>
                        <option value="role">Role</option>
                        <option value="is_active">Active</option>
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
                    if (isset($_SESSION['users_search_clause'])){
                        showUsers($_SESSION['users_search_clause']);
                        unset($_SESSION['users_search_clause']);
                    } else {
                        showUsers("");
                    }

                    ?>
                </div>
                <div>
                    <form action="ManagerViewUsers.php" method = "post">
                        <input  type="submit" class="btn btn-success" name = "submitAdd" value = "Add User">
                        <input type="submit" class="btn btn-success" name = "submitUpdate" value = "Update User">
                    </form>
                </div>
            </div>
        </div>
    </body>
</html>
