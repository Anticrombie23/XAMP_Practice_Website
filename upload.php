<?php
include('templates/header.php');
//check if logged in already, if you are, redirect to login page?
if(isset($_SESSION['userName'])){
    
}else {
    header('Location: '.'login.php');
}

?>


<?php



print '<p> Upload a story file. Please note that your file extension must be pdf, doc, docx, or txt! </p>';

if ($_SERVER['REQUEST_METHOD'] == 'POST'){

    $currentUser = $_SESSION['userName']; 
    
    $fileName = $_FILES['the_file']['tmp_name'];    
    $secondPiece = $_FILES['the_file']['name'];
    $destination = "../users/" . $currentUser . "/";
    $fileNameFull = $destination . $secondPiece;
    $ext = pathinfo($fileNameFull, PATHINFO_EXTENSION);
    //these are the allowed file extensions
    $allowed = array('txt', 'pdf', 'doc', 'docx');

    
    //Check to see if the extension is allowed or not
    if(in_array($ext, $allowed)){
        
        if (move_uploaded_file($fileName,  $fileNameFull)){
        print "<p class = 'input--success'> File successfully uploaded! Please check your stories now </p>";
    }else {
        
        print '<p class = "input-error"> Your file couldnt be uploaded because: ';
        
        switch ($_FILES['the_file']['error']){
          case 1: 
              print 'The file exceeds the maximum upload size in the php.ini setting.';
              break;
          case 2:
              print 'the file exceeded the MAX_FILE_SIZE setting in the HTML form';
              break;
          
          case 3:
              print 'the file was partially uploaded';
              break;
          
          case 4: 
              print 'no file was uploaded!';
              break;
          
          case 5: 
              print 'The temp folder does not exist';
              break;
          
          default: 
              print 'Something unforeseen happened. ';
              break;
            
            
        }
        
        print '</p>';
     }
        
        
    }else{
    print '<p class = "input--error"> File of the .' .  $ext . ' format is not allowed!! '  . ' </p>';
    }
    
    
    
    
}

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

?>



<form action = "upload.php" enctype='multipart/form-data' method = "post"> 
        
        <p>Upload a file here:  </p>
        <input type = "hidden" name = "MAX_FILE_SIZE" value = "30000">
        <p> <input type = "file" name = "the_file" </p>
        <p> <input type = "submit" name = "submit" value = "Upload File">


</form>


<?php
include('templates/footer.php');

?>