<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

include('templates/header.php');
include('../mysqli_connect.php');




if (isset($_GET['data'])){
    
    $getParam = $_GET['data'];
    $query =' SELECT * FROM `quotes` WHERE `id` = ' . $getParam .'';
    
    if ($r = mysqli_query($dbc, $query)){
        
        $row = mysqli_fetch_array($r);
    
    print '<h3>Are you sure you want to delete this quote?</h3></br>';
    
    print '<p style = "color:grey">' .  $row['text'] . '</p>';
    print '<p>' . $row['author'] . '</p></br></br>';
    
    print '<form action = "delete_quote.php" method = "post">';
    print "<input type = 'hidden' name = 'id' value = '. $getParam . '>";
    print '<input type = "submit" name = "submit" value = "Delete this Entry!"> </input>';
    print '</form>';
    
    
}else {
    print '<p> Couldnt retrieve the proper information from the GET </p>';
}
    
    
}else if (isset($_POST['id'])){
    
    $id = $_POST['id'];
    
    $query = "DELETE FROM `quotes` WHERE quotes.id = $id";
    $query = str_replace(".", "", $query);
    $query = str_replace("quotesid", "quotes.id", $query);
    
    $r = mysqli_query($dbc, $query);
    
    if (mysqli_affected_rows($dbc) ==1){
        print '<p> The quote has been successfully deleted.</p>';
        print '</br><a href = "quotes.php"> Return to Quotes </a>';
    }else {
        print '<p style = "color:red"> Could not delete entry due to  ' . mysqli_error($dbc). '</p>';
        print '<p> ' . $query . '</p>';
        
    }


}




include('templates/footer.php');

?>

