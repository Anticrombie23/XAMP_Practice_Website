<?php // Script 8.14 - welcome.php
/* This is the welcome page. The user is redirected here
after they successfully log in. */
// Set the page title and include the header file:
define('TITLE', 'Welcome to the J.D. Salinger Fan Club!');
include('templates/header.php'); 
// Leave the PHP section to display lots of HTML:
?>

<h2>Welcome to the JOSH HARM fan club!</h2>
<?php

if (isset($_SESSION['userName'])){
    print '<p>Youve successfully logged in, '. $_SESSION['userName'] .  ' and can now take advantage of everything the site has to offer.</p>';
}


print '<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>';
?>


<?php include('templates/footer.php'); // Need the footer. ?>