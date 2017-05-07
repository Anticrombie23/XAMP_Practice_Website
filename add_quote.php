

<?php

include('templates/header.php');
include('../mysqli_connect.php');

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */



?>

<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST'){
   
    
    $problem = false;    
        
    if (empty($_POST['author'])){
        $problem = true;
        print '<p style = "color:red"> Author field was left empty.  </p>';
        print ' <div style = "width: 25%; float:left">
    
    <h2> Add Quote </h2>
<form action = "add_quote.php" method = "post">
    <label>Author:  </label> <input type ="text" name = "author"> 
    <label> Quote Text: </label> <textarea name = "quotetext"> </textarea>
    <input type ="checkbox" id = "favorite" name ="favorite" value = "Yes"><label>Check to add as Favorite! </label>
    </br></br> <input type ="submit" value = "Submit">    

</form>
</div>

</br></br></br></br></br></br></br></br></br></br></br></br>
</hr>';
    }
    
    if (empty($_POST['quotetext'])){
        $problem = true;
        print '<p style = "color:red"> Quote Text was left empty </p>';
        print ' <div style = "width: 25%; float:left">
    
    <h2> Add Quote </h2>
<form action = "add_quote.php" method = "post">
    <label>Author:  </label> <input type ="text" name = "author"> 
    <label> Quote Text: </label> <textarea name = "quotetext"> </textarea>
    <input type ="checkbox" id = "favorite" name ="favorite" value = "Yes"><label>Check to add as Favorite! </label>
    </br></br> <input type ="submit" value = "Submit">    

</form>
</div>

</br></br></br></br></br></br></br></br></br></br></br></br>
</hr>';
    }
    

    
    if($problem == false){
        
        $text = trim(strip_tags($_POST['quotetext']));
        $author = trim(strip_tags($_POST['author']));
        
        $favoriteCheck;
        if(isset($_POST['favorite'])){
            $favoriteCheck = 'Y';
        }else {
            $favoriteCheck = 'N';
        }
        
        $query = "INSERT INTO `quotes` (`id`, `text`, `author`, `favorite`, `date_entered`) VALUES (NULL, '$text' , '$author' , '$favoriteCheck' , 'CURRENT_DATE)')";
        
        
        
        //success scenario
      //  $result = mysqli_query($dbc, $query);
        
        if (@mysqli_query($dbc, $query)){
            print '<p> The quote has been added!</br>';
            print '<a href = "quotes.php"> Return to Quotes </a>';
        }else {
            '<p style = "color:red"> Could not add entry to the database because: <br>' . mysqli_error($dbc) . '</p>';
               print '<p> ' . $query . '</p>';
            
        }
        
        print ' <div style = "width: 25%; float:left">
    
    <h2> Add Quote </h2>
<form action = "add_quote.php" method = "post">
    <label>Author:  </label> <input type ="text" name = "author"> 
    <label> Quote Text: </label> <textarea name = "quotetext"> </textarea>
    <input type ="checkbox" id = "favorite" name ="favorite" value = "Yes"><label>Check to add as Favorite! </label>
    </br></br> <input type ="submit" value = "Submit">    

</form>
</div>

</br></br></br></br></br></br></br></br></br></br></br></br>
</hr>';
        
        mysqli_close($dbc);
    }
    
    
}else {
    print ' <div style = "width: 25%; float:left">
    
    <h2> Add Quote </h2>
<form action = "add_quote.php" method = "post">
    <label>Author:  </label> <input type ="text" name = "author"> 
    <label> Quote Text: </label> <textarea name = "quotetext"> </textarea>
    <input type ="checkbox" id = "favorite" name ="favorite" value = "Yes"><label>Check to add as Favorite! </label>
    </br></br> <input type ="submit" value = "Submit">    

</form>
</div>

</br></br></br></br></br></br></br></br></br></br></br></br>
</hr>';
}


?>





<?php
include('templates/footer.php'); // Need the footer.
?>