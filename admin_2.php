<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

include('templates/header.php');
include('../mysqli_connect.php');



if (isset($_POST['userCheck'])){
   
    print '<h2>Administrator Functions </h2>';
    
    
    
    $userFromDB = $_POST['test'];
        
    
    
    if ($_POST['userCheck'] === 'open' ){
        
        $query = "UPDATE `users` SET `status` = 'OPEN' WHERE `username` = '" . $userFromDB ."' ";
        
        if (@mysqli_query($dbc, $query)){
            print '<p>User account set to Open! <br> </p>';           
            print '<a href = "admin.php">Return to Admin Panel </a>';
        }else {
            '<p style = "color:red"> Could not update entry to the database because: <br>' . mysqli_error($dbc) . '</p>';
            //   print '<p> ' . $query . '</p>';
            
        }
        
        
      //  print $query;
        
    }else if ($_POST['userCheck'] === 'closed' ){
        
        $query = "UPDATE `users` SET `status` = 'CLOSED' WHERE `username` = '" . $userFromDB ."' ";
        
                
         if (@mysqli_query($dbc, $query)){
            print '<p>User account set to Closed! <br> </p>';           
            print '<a href = "admin.php">Return to Admin Panel </a>';
        }else {
            '<p style = "color:red"> Could not update entry to the database because: <br>' . mysqli_error($dbc) . '</p>';
            //   print '<p> ' . $query . '</p>';
            
        }
        
      //  print $query;
    }else if ($_POST['userCheck'] === 'grant' ){
        
         $query = "UPDATE `users` SET `admin` = 'Y' WHERE `username` = '" . $userFromDB ."' ";
        
                
         if (@mysqli_query($dbc, $query)){
            print '<p>User has been granted admin access. <br> </p>';           
            print '<a href = "admin.php">Return to Admin Panel </a>';
        }else {
            '<p style = "color:red"> Could not update entry to the database because: <br>' . mysqli_error($dbc) . '</p>';
            //   print '<p> ' . $query . '</p>';
            
        }
        
        
    }else if($_POST['userCheck'] === 'delete' ){
        
         $query = "DELETE FROM `users` WHERE `username` = '" . $userFromDB ."' ";
        
                
         if (@mysqli_query($dbc, $query)){
            print '<p>User has been deleted successfully. <br> </p>';           
            print '<a href = "admin.php">Return to Admin Panel </a>';
        }else {
            '<p style = "color:red"> Could not update entry to the database because: <br>' . mysqli_error($dbc) . '</p>';
            //   print '<p> ' . $query . '</p>';
            
        }
        
        
        print '<p> User Account has been deleted successfully';
    }
 //   print $_POST['userCheck'];
    
}else {
    
    print '<h2>Administrator Functions </h2>';

$userSelected = $_POST['theuser'];

print '<p><b>Username: ' . $userSelected . '</b></p>';


print '<div style = "border: solid 1px grey">';
print '<h3>Account Options:  </h3>';
print '<form method = "post"> ';

print '<input type="radio" name="userCheck" value="open"> Open<br>
    <input type = "hidden" name ="test" value = ' .$_POST['theuser'] .' >
  <input type="radio" name="userCheck" value="closed"> Closed<br>
  <input type="radio" name="userCheck" value="grant"> Grant Admin Role <br>' .
  '<input type="radio" name="userCheck" value="delete"> Delete This Account';
print '<br><br><br><input type = "submit" value = "submit">';
print '</form>';
print '</div>';
    
}









include('templates/footer.php');


?>