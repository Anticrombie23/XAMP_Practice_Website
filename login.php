<?php // Script 8.8 - login.php

/* This page lets people log into the site (in theory). */
// Set the page title and include the header file:
define('TITLE', 'Login');
include('templates/header.php');
include('../mysqli_connect.php');

//check if logged in already, if you are, redirect to welcome page?
if(isset($_SESSION['userName'])){
    header('Location: '.'welcome.php');
}


// Print some introductory text:
print '<h2>Login Form</h2>
	<p>Users who are logged in can take advantage of certain features like this, that, and the other thing.</p>';
// Check if the form has been submitted:
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	// Handle the form:
	if ( (!empty($_POST['userName'])) && (!empty($_POST['password'])) ) {
                $userNameLogin = $_POST['userName'];
                $passwordLogin = $_POST['password'];
                
                //begin database queries!
                $query = "SELECT `username` FROM `users` WHERE `username` = '$userNameLogin';";
                //attempt the query and get the number of results
                $result = mysqli_query($dbc, $query);
                
                $tester = mysqli_fetch_object($result);
                
                if ($tester !== null){
                     $userNameQueryResult = $tester->username;
                }            
                            
                
                $queryPW = "SELECT `password` FROM `users` WHERE `username` = '$userNameLogin';";
                $resultPW = mysqli_query($dbc, $queryPW);                
                $test2 = mysqli_fetch_object($resultPW);
                
                if ($test2 !== null){
                  $passwordQueryResult = $test2->password;
                  $passHash = password_verify($passwordQueryResult, PASSWORD_DEFAULT);
                  
                   if ($userNameQueryResult == null){
                    print '<p> username doesnt exist in our database. </p>';
                }else {
                    //success path, username found, now check matching PW's
                    
                    
                    if (password_verify($passwordLogin, $passwordQueryResult)){
                        print '<p> passwords match!!! ahhhhh!!!</p>';
                        $_SESSION['userName'] = $_POST['userName'];                
                        header('Location: '.'welcome.php');
                    }else {
                        print '<p class="text--error">The submitted user name and password do not match those on file!<br>Go back and try again.</p>';
                        print '<p> password: ' . $passwordLogin . " and " . $passwordQueryResult. ' didnt match</p>';
                    }                 
                    
                }
                  
                }   
               
               
                
                
//		if ( (strtolower($_POST['userName']) == 'me@example.com') && ($_POST['password'] == 'testpass') ) { // Correct!
//		$_SESSION['userName'] = $_POST['userName'];
//                
//                header('Location: '.'welcome.php');
//                    
//                  //  print '<p class="text--success">You are logged in, ' . $_SESSION['userName'] . '!<br>Now you can blah, blah, blah...</p>';
//		} else { // Incorrect!
//			print '<p class="text--error">The submitted user name and password do not match those on file!<br>Go back and try again.</p>';
//		}
	} else { // Forgot a field.
		print '<p class="text--error">Please make sure you enter both a user name address and a password!<br>Go back and try again.</p>';
	}
} 




?>

<form action="login.php" method="post" class="form--inline">
	<p><label for="userName">User Name:</label><input type="userName" name="userName" size="20"></p>
	<p><label for="password">Password:</label><input type="password" name="password" size="20"></p>
	<p><input type="submit" name="submit" value="Log In!" class="button--pill"></p>
	</form>


<?php
include('templates/footer.php'); // Need the footer.
?>