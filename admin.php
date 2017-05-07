<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

//check if logged in already, if you are, redirect to login page?
include('templates/header.php');
include('../mysqli_connect.php');



$query = 'SELECT * FROM users';
$result = mysqli_query($dbc, $query);
print "<h2> Select User</h2>";

print '<form action = "admin_2.php" method = "post">';
print "<select name = 'theuser'>"; 
while($row = mysqli_fetch_array($result)){
    $usernameresult = $row['username'];    
    print "<option value='$usernameresult'> $usernameresult </option>";    
}

print"</select>";
print '<input type = "submit" name = "submit" value = "Edit User" >';
print '</form>';

include('templates/footer.php');


?>
