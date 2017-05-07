    <?php // Script 8.9 - register.php
/* This page lets people register for the site (in theory). */
// Set the page title and include the header file:
define('TITLE', 'Register');
include('templates/header.php');
include('../mysqli_connect.php');


if(isset($_SESSION['userName']) == false){
    
}else {
    header('Location: '.'welcome.php');
}

// Print some introductory text:
print '<h2>Registration Form</h2>
	<p>Register so that you can take advantage of certain features like this, that, and the other thing.</p>';
	
// Check if the form has been submitted:
if ($_SERVER['REQUEST_METHOD'] == 'POST') {    
    
    
	$problem = false; // No problems so far.
	
	// Check for each value...
	if (empty($_POST['userName'])) {
		$problem = true;
		print '<p class="text--error">Please enter a user name!</p>';
        }
        
	if (empty($_POST['password1'])) {
		$problem = true;
		print '<p class="text--error">Please enter a password!</p>';
	}
	if ($_POST['password1'] != $_POST['password2']) {
		$problem = true;
		print '<p class="text--error">Your password did not match your confirmed password!</p>';
	} 
        //Get user name pushed as well as create query with
        $currentUserName = $_POST['userName'];
        $query = "SELECT * FROM `users` WHERE `username` = '$currentUserName'";
        
        //attempt the query and get the number of results
        $result = mysqli_query($dbc, $query);
        $num_rows = mysqli_num_rows($result);
        
        
        //if results is greater than 0, we know an entry exists. Username is already taken!
        if ($num_rows > 0){
          $problem = true;
           print '<br>' . '<p class = "input--error">Username already taken</p>';
        }else {
            //success scenario! continue
        }
       
        
        //Use error message if input--success, input--error is the CSS class for this
        
	
	if (!$problem) { // If there weren't any problems...
		           
                //get new directorial file location
                $fileLocation = "../users/";                
                $fileAbsolute = $fileLocation . $_POST['userName'];
                
                //make book directory for everyone
                mkdir( $fileAbsolute, true );
                
                //create book file for location
                $fileCSV = $fileAbsolute . '/books.csv';
                
                //create csv file for books!!
                $handle = fopen($fileCSV, 'w') or die('Cannot open file:  '.$fileCSV); //implicitly creates file
                
                
                //Get the user name and create a session with it. 
                $_SESSION['userName'] = $_POST['userName'];
                $userName = $_POST['userName'];
                $userName = trim(strip_tags($userName));
                $passwordTrim = trim(strip_tags($_POST['password1']));
                $encryptedPassword = password_hash(($passwordTrim), PASSWORD_DEFAULT);
                              
                
                //Query for inserting into users
                $query = "INSERT INTO `users` (`username`, `password`, `user_dir`, `status`, `admin`) VALUES ('$userName', '$encryptedPassword', '$userName', 'OPEN', 'N');";
                  
                if (mysqli_query($dbc, $query)){
                  // Print a message:
		print '<p class="text--success">You are now registered!';   
                } else{
                    '<p class = "text--failure> Update was not successful in DB. Closing </p>';
                }
                  
                  
                  
                
              
	
	} else { // Forgot a field.
            $_SESSION = [];
		print '<p class="text--error">Please try again!</p>';
		
	}
} // End of handle form IF.
// Create the form:
?>
<form action="register.php" method="post" class="form--inline">

	<p><label for="username">User Name:</label><input type="text" name="userName" size="20" value="<?php if (isset($_POST['userName'])) { print htmlspecialchars($_POST['userName']); } ?>"></p>
	<p><label for="password1">Password:</label><input type="password" name="password1" size="20" value="<?php if (isset($_POST['password1'])) { print htmlspecialchars($_POST['password1']); } ?>"></p>
	<p><label for="password2">Confirm Password:</label><input type="password" name="password2" size="20" value="<?php if (isset($_POST['password2'])) { print htmlspecialchars($_POST['password2']); } ?>"></p>
	<p><input type="submit" name="submit" value="Register!" class="button--pill"></p>

</form>

<?php include('templates/footer.php'); // Need the footer. ?>