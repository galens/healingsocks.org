<?php
// Check for empty fields
if(empty($_POST['name'])  		||
   empty($_POST['email']) 		||
   empty($_POST['phone']) 		||
   empty($_POST['captcha'])	||
   empty($_POST['message'])     ||
   !filter_var($_POST['email'],FILTER_VALIDATE_EMAIL)) {
	   echo json_encode(array(
           'status' => 'error',
           'message' => 'No arguments Provided'
       ));
       return false;
   }
	
$name = $_POST['name'];
$email_address = $_POST['email'];
$phone = $_POST['phone'];
$message = $_POST['message'];
$captcha = $_POST['captcha'];

// only makes it here if there are no errors
require_once '../libs/securimage/securimage.php';
// Passing array of options to the constructor
$options = array('captcha_type' => Securimage::SI_CAPTCHA_MATHEMATIC); /* use math captcha */
$securimage = new Securimage($options);

if ($securimage->check($captcha) == false) {
    echo json_encode(array(
           'status' => 'error',
           'message' => 'Captcha failure'
       ));
    return false;
}
	
// Create the email and send the message
$to = 'gmoreasjr@gmail.com';
$email_subject = "Healing Socks Contact Form:  $name";
$email_body = "New message from Healing Socks contact form.\n\n"."Here are the details:\n\nName: $name\n\nEmail: $email_address\n\nPhone: $phone\n\nMessage:\n$message";
$headers = "From: noreply@healingsocks.org\n"; // This is the email address the generated message will be from. We recommend using something like noreply@yourdomain.com.
$headers .= "Reply-To: $email_address";	
if(mail($to,$email_subject,$email_body,$headers)) {
    echo json_encode(array(
            'status' => 'success',
            'message' => 'Message sent'
        ));
    return true;
} else {
    echo json_encode(array(
            'status' => 'error',
            'message' => 'Message failure'
        ));
    return false;
}
?>