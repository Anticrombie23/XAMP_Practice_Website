<?php // Script 8.5 - books.php
/* This page lists J.D. Salinger's bibliography. */
// Set the page title and include the header file:
define('TITLE', 'Books by J.D. Salinger');
include('templates/header.php');
// Leave the PHP section to display lots of HTML:

//need to get user name and input that into file path, then use that going forward!!




if ($_SERVER['REQUEST_METHOD'] == 'POST'){
    
    if (isset($_SESSION['userName'])){
    $userName = $_SESSION['userName'];
    $fileUserName = '../users/' . $userName . '/books.csv';

    $file = 'htdocs/users/books.csv';
 
    if(!empty($_POST['bookTitle']) && !empty($_POST['bookAuthor'])){
        
        if (is_writable($fileUserName)){
            
            //concantenate
            $filePut = $_POST['bookTitle'] . '|' . $_POST['bookAuthor'] . PHP_EOL;
            
            file_put_contents($fileUserName, $filePut, FILE_APPEND );
            print '<p> your book was stored successfully! </p>';
            
        }else {
            print '<p> your book was not stored due to system error</p>';
            
            if (file_exists($fileUserName)){
                print '<p> file exists!</p>';
            }else {
                print '<p> file doesnt exist </p>';
            }
          
        }   
        
        
    }
    
}
}



?>

<form action="books.php" method="post" class="form--inline">
    <p><label for="bookTitle">Book Title: </label><input type="bookTitle" name="bookTitle" size="20" required></p>
	<p><label for="bookAuthor">Book Author: </label><input type="bookAuthor" name="bookAuthor" size="20" required></p>
	<p><input type="submit" name="submit" value="Add Book" class="button--pill"></p>
</form>

<h2>My Books</h2>

<?php


if (isset($_SESSION['userName'])){
 $userName = $_SESSION['userName'];
 $fileUserName = '../users/' . $userName . '/books.csv';   
 $contents = file($fileUserName);


   foreach($contents as $lineItem){
       
    $removePipe = str_replace("|", " by ", $lineItem);   
       
    print '<ul>';
    print '<li>' . $removePipe .'</li>';
    print '</ul>';
}     
   
}else {
    print '<p> Youre not logged in! You have no books selected, yet!  Clicking the Add-Button will result in nothing displayed. </p>';
}








?>



<?php include('templates/footer.php'); ?>