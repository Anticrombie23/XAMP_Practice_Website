<?php
session_start();
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
define('TITLE', 'Login');
$_SESSION = [];
session_destroy();
//must kill/null array before header!!!!!
include('templates/header.php');


print '<h2>You have been successfully logged out.</h2>';

include('templates/footer.php');


?>
