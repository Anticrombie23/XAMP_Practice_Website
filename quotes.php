<?php
include('templates/header.php');
include('../mysqli_connect.php');
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

print '<h2> Quotes</h2>';

$query = 'SELECT * FROM `quotes`';
$result = mysqli_query($dbc, $query);


if(isset($_SESSION['userName'])){
    print '<a href = "add_quote.php" style = "font-size: 22px; text-decoration:underline"> Add a New Quote Here! </a></br></br>';
    
    
}

while ($row = mysqli_fetch_array($result)){
    
    $favorite = $row['favorite'];
    $id = $row['id'];
    $toPrint;
    if ($favorite === 'Y'){
       $toPrint = "<span style = 'color:red'>Favorite! </span>" ;
    }else {
        $toPrint = "";
    }
    
    print '<p>-'. $row['text'] . ' '. $toPrint. '</p>';
    print '<p><i><b>' . $row['author'] . '</b></i> </p>';
    
    if(isset($_SESSION['userName'])){
    
    print '<a href = update_quote.php?data=' . $row['id'] . '"> Edit</a>'. ' | '. '<a href = "delete_quote.php?data=' . $row['id'] . '"> Delete </a>';
    
}
    
    
    print '<hr>';
    
    
    
}


include('templates/footer.php');

?>