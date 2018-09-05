<style>
    table {
        border-collapse: collapse;
    }
    table th {
        text-align: left;
        background-color: #3a6070;
        color: #FFF;
        padding: 4px 30px 4px 8px;
    }
    table td {
        border: 1px solid #e3e3e3;
        padding: 4px 8px;
    }  
    table tr:hover{
        background-color: green !important;
        color: white;
    }
    table tr:nth-child(odd){
        background-color: #e7edf0;
    }
</style>
<?php
include "db.php";
session_start();

function removeSession(){
    // remove all session variables
    session_unset(); 
    // destroy the session 
    session_destroy();
    echo "Session removed";
}
// Misguiding name , actually just populates an option list for login page
function showAllUsers(){
    global $connection;

    $query = "SELECT * FROM users";
    $result = mysqli_query($connection, $query);
    if (!$result){
        die('Query FAILED'. mysqli_error($connection));
    }
    while ($row = mysqli_fetch_assoc($result)){
        echo "<option value='".$row['role']."'>".$row['role']."</option>";
    }
}

// TABLE DISPLAY FUNCTs
function showUsers($searchClause){
    global $connection;
    $query = "SELECT * FROM users";
    $query .= $searchClause;
    $query .= " ORDER BY join_date DESC ";
    $result = mysqli_query($connection, $query);
    if (!$result){
        die('Query FAILED'. mysqli_error($connection));
    }
    echo '<div style="width:900px; height:400px; overflow:auto;">';
    echo "<table>
            <tr>
                <th>Empl. Id</th><th>Username</th>
                <th>Role</th><th>Join Date</th>
                <th>Active</th>
            </tr>";
    while($row = mysqli_fetch_assoc($result))
    { 
        echo "<tr>
            <td> ".$row['id']."</td><td>"
            .$row['username']."</td><td>"
            .$row['role']."</td><td>"
            .$row['join_date']."</td><td>"
            .$row['is_active']."</td>
                </tr>";
    }
    echo "</table>";
    echo '</div><br>';

}

function showClients($searchClause){
    global $connection;
    $query = "SELECT * FROM clients ";
    $query .= $searchClause;
    $query .= " ORDER BY date_added DESC";
    $result = mysqli_query($connection, $query);
    if (!$result){
        die('Query FAILED'. mysqli_error($connection));
    }
    echo '<div style="width:950px; height:400px; overflow:auto;">';
    echo "<table>
            <tr>
                <th>Client Id </th><th>Company Name</th>
                <th>Address</th><th>Contact</th>
                <th>Email</th><th>Phone</th>
                <th>Total Value(Tk)</th><th>Date Added</th>
                <th>Empl. Id</th>
            </tr>";
    while($row = mysqli_fetch_assoc($result))
    { 
        echo "<tr>
            <td> ".$row['c_id']."</td><td>"
            .$row['c_name']."</td><td>"
            .$row['c_add']."</td><td>"
            .$row['contact']."</td><td>"
            .$row['c_email']."</td><td>"
            .$row['c_phone']."</td><td>"
            .$row['t_value']."</td><td>"
            .$row['date_added']."</td><td>"
            .$row['u_id']."</td>
                </tr>";
    }
    echo "</table>";
    echo '</div><br>';
}

function showLeads($searchClause){
    global $connection;
    $query = "SELECT leads.l_id,leads.u_id, leads.value, leads.prospect, leads.a_id, clients.c_id, clients.c_name, actions.a_desc, actions.set_date"; 
    $query .= " FROM leads INNER JOIN clients ON leads.c_id = clients.c_id INNER JOIN actions ON leads.a_id = actions.a_id";
    $query .= $searchClause;
    $query .= " ORDER BY prospect ASC";

    $result = mysqli_query($connection, $query);
    if (!$result){
        die('Query FAILED'. mysqli_error($connection));
    }
    echo   '<div style="width:920px; height:400px; overflow:auto;">';
    echo "<table>
            <tr>
                <th>Lead Id</th><th>Empl. Id</th>
                <th>Client Id</th><th>Client Name</th>
                <th>Action Id</th><th>Action Desc.</th>
                <th>Value</th><th>Prospect</th>
                <th>Set Date</th>
            </tr>";
    while($row = mysqli_fetch_assoc($result))
    { 
        echo "<tr>
            <td> ".$row['l_id']."</td><td>"
            .$row['u_id']."</td><td>"
            .$row['c_id']."</td><td>"
            .$row['c_name']."</td><td>"
            .$row['a_id']."</td><td>"
            .$row['a_desc']."</td><td>"
            .$row['value']."</td><td>"
            .$row['prospect']."</td><td>"
            .$row['set_date']."</td>
                </tr>";
    }
    echo "</table>";
    echo "</div><br>";
}

function showActions($searchClause){
    global $connection;
    $query = "SELECT * FROM actions";
    $query .= $searchClause;
    $query .= " ORDER BY completed ASC, due_date ASC";
    $result = mysqli_query($connection, $query);
    if (!$result){
        die('Query FAILED'. mysqli_error($connection));
    }
    echo   '<div style="width:900px; height:400px; overflow:auto;">';
    echo "<table>
            <tr>
                <th>Action Id</th><th>Empl. Id</th><th>Client Id</th>
                <th>Description</th><th>Set Date</th>
                <th>Due Date</th><th>Completed</th>
            </tr>";
    while($row = mysqli_fetch_assoc($result))
    { 
        $output = "<tr>
            <td> ".$row['a_id']."</td><td>"
            .$row['u_id']."</td><td>"
            .$row['c_id']."</td><td>"
            .$row['a_desc']."</td><td>"
            .$row['set_date']."</td><td>"
            .$row['due_date']."</td><td>";
        if($row['completed'] > 0){
            $output .= "YES";
        } else if ($row['completed'] < 0){
            $output .= "EXPIRED";
        } else {
            $output .= "NO";
        }
        $output .= "</td></tr>";
        echo $output;
    }    
    echo "</table>";
    echo "</div><br>";
}

// INSERT FUNCTIONS
function insertLead(){
    global $connection;
    $u_id = $_POST['u_id'];
    $c_id = $_POST['c_id'];
    $t_value = $_POST['t_value'];
    $prospect = $_POST['prospect'];
    $a_desc = $_POST['a_desc'];
    $now = time();
    $set_date = date("Y-m-d",$now);
    $due_date = $_POST['due_date'];

    if($c_id && $t_value && $prospect && $a_desc && $set_date && $due_date && $u_id){
        $query = "INSERT INTO actions(c_id, u_id, a_desc, set_date, due_date, completed)";
        $query .= " VALUES('$c_id', '$u_id', '$a_desc', '$set_date', '$due_date', '0')";
        if($connection->query($query) == true){
            $last_id = $connection->insert_id;
            $query = "INSERT INTO leads(c_id, u_id, value, prospect, a_id)";
            $query .= " VALUES('$c_id', '$u_id', '$t_value', '$prospect', '$last_id')";
            $result = mysqli_query($connection, $query);
            if (!$result){
                die('Query FAILED'. mysqli_error($connection));
            }
        } else {
            echo "ERROR";
        }
    } else {
        echo "Cannot insert empty rows";
    }
    $_POST = array();
}

function insertClient(){
    global $connection;
    $c_name = $_POST['c_name'];
    $c_add = $_POST['c_add'];
    $contact = $_POST['contact'];
    $c_email = $_POST['c_email'];
    $c_phone = $_POST['c_phone'];
    $t_value = 0;
    $now = time();
    $date_added = date("Y-m-d",$now);
    $u_id = $_POST['u_id'];
    if($c_name && $c_add && $contact && $c_email && $c_phone && $u_id){
        $query = "INSERT INTO clients(c_name, c_add, contact, c_email, c_phone, date_added, t_value, u_id)";
        $query .= " VALUES('$c_name', '$c_add', '$contact', '$c_email', '$c_phone', '$date_added', '$t_value', '$u_id')";
        $result = mysqli_query($connection, $query);
        if (!$result){
            die('Query FAILED'. mysqli_error($connection));
        }
        $last_id = $connection->insert_id;
        echo "Client Added with ID: $last_id";
    } else {
        echo "FILL ALL THE ROWS YOU MUPPET";
    }
    $_POST = array();
}

function insertUser(){
    global $connection;
    $username = $_POST['username'];
    $role = $_POST['role'];
    $password = $_POST['password'];
    $now = time();
    $join_date = date("Y-m-d",$now);
    if ($username && $role && $password){
        $query = "INSERT INTO users(username, role, password, join_date, is_active) ";
        $query .= " VALUES('$username', '$role', '$password', '$join_date', '0')";
        $result = mysqli_query($connection, $query);
        if (!$result){
            die('Query FAILED'. mysqli_error($connection));
        }
    } else {
        echo "ERROR";
    }   
    echo "User Added with id = ".$connection->insert_id;
    $_POST = array();
}

// UPDATE FUCNTIONS
function updateLead(){
    global $connection;
    $l_id = $_POST['l_id'];
    $prospect = $_POST['prospect'];
    $t_value = $_POST['t_value'];
    $a_desc = $_POST['a_desc'];
    $now = time();
    $set_date = date("Y-m-d",$now);
    $due_date = $_POST['due_date'];
    $completed = 0;
    ///////////////////////////////////////////////////////////////////////////
    // Getting data from leads table and storing and adjust to variables as needed
    $query = "SELECT c_id, value, a_id, u_id FROM leads WHERE l_id = ".$l_id;
    $result = mysqli_query($connection, $query);
    if (!$result){
        die('Query FAILED'. mysqli_error($connection));
    }
    $row = mysqli_fetch_assoc($result);
    $c_id = $row['c_id'];
    $u_id = $row['u_id'];
    if ($t_value == 0){
        $t_value = $row['value'];
    }
    ///////////////////////////////////////////////////////////////////////////
    // Setting previos action to completed and checking if the lead was alredy complete
    $ta_id = $row['a_id'];
    $query = "SELECT completed, due_date FROM actions WHERE a_id = ".$ta_id;
    $result = mysqli_query($connection, $query);
    if (!$result){
        die('Query FAILED'. mysqli_error($connection));
    }
    $row = mysqli_fetch_assoc($result);
    $tcompleted = 1;
    // Checking of the action is already completed, Indicating a finished lead
    if($row['completed'] > 0){
        echo "Transaction Already Completed";
        return;
    }
    // Ohterwise set action to completed and add new action to lead
    if ($row['due_date'] < $set_date){
        $tcompleted = -1;
    }
    $query = "UPDATE actions SET ";
    $query .= " actions.completed ='$tcompleted' ";
    $query .= " WHERE actions.a_id = '$ta_id' ";
    $result = mysqli_query($connection, $query);
    if (!$result){
        die('Query FAILED'. mysqli_error($connection));
    }


    ///////////////////////////////////////////////////////////////////////////
    if($prospect >= 100){
        $a_desc = "Tranasction Completed for Client ID: $c_id, Value = $t_value ";
        $due_date = $set_date;
        $completed = 1;
        ///////////////////////////////////////////////////////////////////////////
        // Updating total value of customers
        $query = "UPDATE clients SET ";
        $query .= " clients.t_value = clients.t_value + '$t_value' ";
        $query .= " WHERE clients.c_id = '$c_id' ";
        $result = mysqli_query($connection, $query);
        if (!$result){
            die('Query FAILED'. mysqli_error($connection));
        }
    } 
    if ($l_id && $prospect && $set_date && $due_date){
    } else {
        echo "Not All fields set";
        return;
    }
    $query = "INSERT INTO actions(c_id, u_id, a_desc, set_date, due_date, completed)";
    $query .= " VALUES('$c_id', '$u_id', '$a_desc', '$set_date', '$due_date', '$completed')";
    ///////////////////////////////////////////////////////////////////////////
    if($connection->query($query) == true){
        $action_id = $connection->insert_id;
        $query = "UPDATE leads SET ";
        $query .= " leads.prospect ='$prospect', ";
        $query .= " leads.value = '$t_value', ";
        $query .= " leads.a_id = '$action_id' ";
        $query .= " WHERE leads.l_id = '$l_id' ";
        $result = mysqli_query($connection, $query);
        if (!$result){
            die('Query FAILED'. mysqli_error($connection));
        }
    } else {
        echo "ERROR";
    }
    $_POST = array();
    echo "Lead( l_id = $l_id ) updated!";
}

function updateAction(){
    global $connection;
    $a_id = $_POST['a_id'];
    $a_desc = $_POST['a_desc'];
    $due_date = $_POST['due_date'];
    if ($a_id && $due_date ){
        if (!$a_desc){
            $query = "UPDATE actions SET ";
            $query .= " actions.due_date ='$due_date' ";
            $query .= " WHERE actions.a_id = '$a_id' ";
        } else {
            $query = "UPDATE actions SET ";
            $query .= " actions.a_desc ='$a_desc', ";
            $query .= " actions.due_date ='$due_date' ";
            $query .= " WHERE actions.a_id = '$a_id' ";
        }
        $result = mysqli_query($connection, $query);
        if (!$result){
            die('Query FAILED'. mysqli_error($connection));
        }
    }else {
        echo "Not All Fields set";
    }
    $_POST = array();
}

function updateClient(){
    global $connection;
    $c_id = $_POST['c_id'];
    $c_add = $_POST['c_add'];
    $contact = $_POST['contact'];
    $c_email = $_POST['c_email'];
    $c_phone = $_POST['c_phone'];

    $query = "SELECT * FROM clients WHERE clients.c_id =".$c_id;
    $result = mysqli_query($connection, $query);
    $row = mysqli_fetch_assoc($result);
    if ($c_add == ""){
        $c_add = $row['c_add'];
    }
    if ($contact == ""){
        $contact = $row['contact'];
    }
    if ($c_email == ""){
        $c_email = $row['c_email'];
    }
    if ($c_phone == ""){
        $c_phone = $row['c_phone'];
    }
    if ($c_id){
        $query = "UPDATE clients SET ";
        $query .= " c_add ='$c_add', ";
        $query .= " contact ='$contact', ";
        $query .= " c_email ='$c_email', ";
        $query .= " c_phone ='$c_phone' ";
        $query .= " WHERE c_id = '$c_id' ";
        $result = mysqli_query($connection, $query);
        if (!$result){
            die('Query FAILED'. mysqli_error($connection));
        }
    }else {
        echo "Not All Fields set";
    }
    $_POST = array();
}

function updateUser(){
    global $connection;
    $id = $_POST['id'];
    $username = $_POST['username'];
    $is_active = $_POST['is_active'];

    $query = "SELECT username, is_active FROM users WHERE id =".$id;
    $result = mysqli_query($connection, $query);
    $row = mysqli_fetch_assoc($result);
    if ($username == ""){
        $username = $row['username'];
    }
    if ($is_active == -1 ){
        $is_active = $row['is_active'];
    }
    if ($id){
        $query = "UPDATE users SET ";
        $query .= " username ='$username', ";
        $query .= " is_active ='$is_active' ";
        $query .= " WHERE id = '$id' ";
        $result = mysqli_query($connection, $query);
        if (!$result){
            die('Query FAILED'. mysqli_error($connection));
        }
    }else {
        echo "Not All Fields set";
    }
    echo "Updated user id = ".$id;
    $_POST = array();
}

function reassignClient() {
    global $connection;
    $u_id = $_POST['u_id'];
    $temp = $_POST['c_id'];
    $c_ids = explode(',', $temp);

    if ($u_id && $c_ids){
        foreach($c_ids as $c_id){
            $query = "UPDATE clients SET ";
            $query .= " u_id ='$u_id' ";
            $query .= " WHERE c_id = '$c_id' ";
            $result = mysqli_query($connection, $query);
            if (!$result){
                die('Query FAILED'. mysqli_error($connection));
            }
            
            $query = "UPDATE leads SET ";
            $query .= " u_id ='$u_id' ";
            $query .= " WHERE c_id = '$c_id' ";
            $query .= " AND prospect < '100' ";
            $result = mysqli_query($connection, $query);
            if (!$result){
                die('Query FAILED'. mysqli_error($connection));
            }
            
            $query = "UPDATE actions SET ";
            $query .= " u_id ='$u_id' ";
            $query .= " WHERE c_id = '$c_id' ";
            $query .= " AND completed = '0' ";
            $result = mysqli_query($connection, $query);
            if (!$result){
                die('Query FAILED'. mysqli_error($connection));
            }
            
        }
    }else {
        echo "Not All Fields set";
    }
    echo " Reassigned Clients";
    $_POST = array();
}
?>