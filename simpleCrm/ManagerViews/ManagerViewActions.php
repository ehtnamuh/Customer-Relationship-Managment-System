<?php include "db.php"; ?>
<?php include "Mfunctions.php"; ?>
<?php
if (isset($_POST['search_action'])){
    $attr = $_POST['attr'];
    $searchKey = $_POST['search'];
    $date_from = "";
    $date_to = "";
    if (isset($_POST['date_from'], $_POST['date_to'])){
        $date_from = $_POST['date_from'];
        $date_to = $_POST['date_to'];
    }  
    $searchClause = "";
    if($attr == "completed"){
        $tempsearchKey = strtolower($searchKey);
        $posY = strpos($tempsearchKey, 'y');
        $posN = strpos($tempsearchKey, 'n');
        $posE = strpos($tempsearchKey, 'e');
        if ($posY === 0){
            $searchKey = 1;
        } else if ($posN === 0) {
            $searchKey = 0;
        } else if ($posE === 0) {
            $searchKey = -1;
        } else {
            $searchKey = -100; 
        }
        $searchClause = " WHERE  $attr = '$searchKey' ";
    } else {
        $searchClause = " WHERE  $attr LIKE '%$searchKey%' ";
    }
    unset($_POST['attr'], $_POST['search'], $_POST['date_to'], $_POST['date_from'], $_POST['search_action'] );

    if ($date_from != ""){
        $searchClause .= " AND due_date >= '$date_from' ";
        $searchClause .= " AND due_date <= '$date_to' ";
    }
    $_SESSION['action_search_clause'] = $searchClause;
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
            <div class="col-sm-10">
                <h1 class = "text-center">Actions</h1>
                <form action="ManagerViewActions.php" class="form-inline" method = "post">
                    <label for="attr">Atrribute:</label>
                    <select class="form-control" name="attr">
                        <option value="a_id">Action Id</option>
                        <option value="c_id">Client Id</option>
                        <option value="u_id">Empl. Id</option>
                        <option value="a_desc">Description</option>
                        <option value="completed">Completed</option>
                    </select>
                    <label for="search">Search:</label>   
                    <input type="text" name = "search" class = "form-control">
                    <input  type="submit" class="btn btn-success" name = "search_action" value = "Search">
                    <label for="date_from">From:</label> 
                    <input type="date" id="date_from"
                           name="date_from" />
                    <label for="date_to">To:</label> 
                    <input type="date" id="date_to"
                           name="date_to" /> <br>
                </form>
                <div>
                    <?php
                    if (isset($_SESSION['action_search_clause'])){
                        showActions($_SESSION['action_search_clause']);
                        unset($_SESSION['action_search_clause']);
                    } else {
                        showActions("");
                    }
                    ?>
                </div>
                <form action="http://localhost/simpleCrm/MupdateAction.php" method = "post">
                    <input type="submit" class="btn btn-success" name = "submit" value = "Udate Action">
                </form>
            </div>
        </div>

    </body>
</html>