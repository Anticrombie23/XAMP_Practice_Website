<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

include('templates/header.php');
include('../mysqli_connect.php');

$query;
if(isset($_GET['data'])){
   $getParam = $_GET['data']; 
   $query =' SELECT * FROM `quotes` WHERE `id` = ' . $getParam .'';
   $result = mysqli_query($dbc, $query);
}



if (isset($_POST['id'])){
    
    if(isset($_POST['favorite'])){
      $checked = $_POST['favorite'];  
    }
    
    $checkSet;
    
    if (isset($checked) && $checked = "Y"){        
        $checkSet = "Y";        
    }else {
        $checkSet = "N";
    }
    $id = $_POST['id'];    
    $query = "UPDATE `quotes` SET `text` = '" . $_POST['quotetext'] . "', `author` = '" . $_POST['author'] . "' , `favorite` = '". $checkSet . "' WHERE `id` = " .$id ;
    $query = str_replace('"', "" , $query); 
    $query = str_replace('.', "" , $query); 
 //   print $query;
    
    
    if (@mysqli_query($dbc, $query)){
            print '<p> The quote has been updated!</br></br>';            
            print '<a href = "quotes.php">Return to Quotes </a>';
        }else {
            '<p style = "color:red"> Could not update entry to the database because: <br>' . mysqli_error($dbc) . '</p>';
            //   print '<p> ' . $query . '</p>';
            
        }
        
        
    
    
    
    
}else {
    
    
    if (isset($_GET['data'])){
    
    $getParam = $_GET['data'];
    $query =" SELECT * FROM `quotes` WHERE `id` = $getParam ";
    $query = str_replace(".", "", $query);
    $query = str_replace('"', "", $query);
    
    
    $theResult =  mysqli_query($dbc, $query);
   
   if (!$theResult) {
    printf("Error: %s\n", mysqli_error($dbc));
    print $query;
    exit();
}
    
    if($row = mysqli_fetch_array($theResult)){
        
        $text = $row['text'];
    $author = $row['author'];
    $checkBox = $row['favorite'];
    
    $checkSwitch;
    $checkBox;
    
    if ($checkBox == "Y"){
        $checkSwitch = "Yes";
        $checkBox = 'Checked';
    }else {
        $checkSwitch = "No";
        $checkBox = 'notchecked';
    }
    
    print ' <div style = "width: 25%; float:left">';
    print '<form action = "update_quote.php" method = "post">';
    print '<h2> Would you like to update this entry? </h2>';
    print "<input type = 'hidden' name = 'id' value = '. $getParam . '>";
    print ' <label>Author:  </label> <input type ="text" name = "author" value ='. $author  . ' >';
    print ' <label> Quote Text: </label> <textarea name = "quotetext">' . $text .  ' </textarea>';
    print '<input type ="checkbox" id = "favorite" name ="favorite" value = ' . $checkSwitch. ' checked =" '. $checkBox.'" ><label>Check to add as Favorite! </label>';
    print '</br></br>';
    print '<input type = "submit" name = "submit" value = "Update Entry!"> </input>';
    print '</form>';
    print '</div>';
    print '</br></br></br></br></br></br></br></br></br></br></br></br></br></br></br></br></br></br>';
        
    }
    
    
    
}
    
}




include('templates/footer.php');


?>

