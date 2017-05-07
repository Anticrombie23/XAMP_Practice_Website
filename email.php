<?php 
require 'phpmailer/PHPMailerAutoload.php';
include '../config.php';
?>

<?php

include('templates/header.php');
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
//check if logged in already, if you are, redirect to login page?
if(isset($_SESSION['userName'])){
    
}else {
    header('Location: '.'login.php');
}



print '<h2>Email Form</h2><br>';
if ($_SERVER['REQUEST_METHOD'] == 'POST'){ 
    
    
    
    
    $mail = new PHPMailer;   
    $mail ->isSMTP();
    $mail ->SMTPDebug = 4;
    $mail -> Debugoutput = 'html';
    
    $mail-> Host = $host;
    $mail->Port = $port;
    $mail->SMTPSecure = $SMTPsecure;
    $mail->SMTPAuth = true;
    
    
    
    
    $mail->Username = $username;
    $mail->Password = $password;
    $email = $_POST['userName'];
    $mail->setFrom( $email, 'First Last');
    $toEmail = 'joshharm@yahoo.com';
    $mail->addAddress($toEmail, 'Josh Harm');
    $mail->Subject = $_POST['subject'];
    $mail->AltBody = $_POST['message'];
    $mail->msgHTML = $_POST['message'];
    $mail->Body = $_POST['message'];
    
    $mail->smtpConnect([
    'ssl' => [
        'verify_peer' => false,
        'verify_peer_name' => false,
        'allow_self_signed' => true
    ]
]);
    
    if (!$mail->send()) { 
     echo "Mailer Error: " . $mail->ErrorInfo; 
     echo 'subject: ' . $mail->Subject;
     echo ' body: ' . $mail->msgHTML;
     echo ' email: ' . $email;
 } else { 
     echo "Message sent!"; 
 } 



}else {
    print '<form action="email.php" method="post" class="form--inline">
	<p><label for="userName">My E-mail:</label><input type="userName" name="userName" size="20"></p>
	<p><label for="subject">Subject:</label><input type="input" name="subject" size="20"></p>
        <p><label for = "textarea"> Message: <textarea name="message" form="message" size = "100">Enter your e-mail here</textarea></p>
       <p><input type="submit" name="submit" value="E-Mail Me!" class="button--pill"></p>
	</form>';
    
}

include('templates/footer.php');
?>

