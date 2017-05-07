<?php
session_start();
include('../mysqli_connect.php');
?>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="HandheldFriendly" content="True">
  <title>IT'S MY MONEY, AND I NEED IT NOW!</title>
  <link rel="stylesheet" type="text/css" media="screen" href="css/concise.min.css" />
  <link rel="stylesheet" type="text/css" media="screen" href="css/masthead.css" />
  <link rel="stylesheet" href="CSS/main.css" type="text/css">
 </head>
<body>

<header container class="siteHeader">
  <div row>
    <h1 column=4 class="logo"><a href="index.php">Josh Harm's Fan Club</a></h1>
    <nav column="8" class="nav">
      <ul>
          
          
        <li><a href="books.php">Books</a></li>
        
         <?php         
         
            
         
         if (isset($_SESSION['userName'] )== true){
             
//              $query = "SELECT * FROM `users` WHERE `username` LIKE '" . $_SESSION['userName'] ."'";
//              $result = mysqli_query($dbc, $query);
             
             $query = "SELECT * FROM `users` WHERE `username` LIKE '" . $_SESSION['userName'] ."'";
             $result = mysqli_query($dbc, $query);
             
           print '<li><a href="stories.php">Stories</a></li>'; 
           
           if($row = mysqli_fetch_array($result)){
               
               if($row['admin'] == 'Y'){
                  print '<li><a href = "admin.php"> Admin Panel </a>'; 
               }
               
           }
           
         }        
        ?>
        <li><a href="quotes.php">Quotes</a></li>
        <?php
        if(isset($_SESSION['userName']) == true){
            print '<li><a href = "logout.php">Logout</a><li>';
        }else {
           print '<li><a href="login.php">Login</a></li>'; 
           print '<li><a href="register.php">Register</a></li>';
        }
        ?>
        
        
        
        <?php
        
        if(isset($_SESSION['userName'])){
            
        $query = "SELECT * FROM `users` WHERE `username` LIKE '" . $_SESSION['userName'] ."'";
        $result = mysqli_query($dbc, $query);
        
        if($row = mysqli_fetch_array($result)){
            
            if($row['status'] === 'CLOSED'){
                print '<h2 style = "color:red"> User is locked out of email and upload </h2>';
            }else {
              if (isset($_SESSION['userName'])== true){
            print '<li><a href ="email.php">E-mail</a></li>';  
            print '<li><a href = "upload.php"> Upload</a></li>';
        }  
            }
            
        }
        }
        
        
        
        
        
        
        
        ?>             
     </ul>
    </nav>
  </div>
    
    <?php
    date_default_timezone_set('America/Chicago');
    ?>
</header>

  <main container class="siteContent">
  <!-- BEGIN CHANGEABLE CONTENT. -->
		