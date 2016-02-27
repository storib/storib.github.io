<?php
require_once 'lib/swift_required.php';

//grab post data
$sender_name = filter_var($_POST["nameInput"], FILTER_SANITIZE_STRING); //capture sender name
$sender_email = filter_var($_POST["emailInput"], FILTER_SANITIZE_STRING); //capture sender email
$sender_sageRegistration = filter_var($_Post["sageRegistration"], FILTER_SANITIZE_STRING); //capture phone number
$sender_subjects = filter_var($_POST["subjects"], FILTER_SANITIZE_STRING); //capture message
$sender_message = filter_var($_POST["otherMessage"], FILTER_SANTITIZE_STRING);

//Create the SMTP configuration
$to = array('adrian.conley@gmail.com' => 'Adrian Conley'); //recepient
$from = array('noreply@sagewanted.com' => 'SageWanted'); //from email using site domain.
$subject = 'New Sign Up!'; //email subject line
$text = '$sender_name signed up on SageWanted.com. Their email address is $sender_email
        and wanted to register as $sender_sageRegistration with the subjects $sender_subjects. They also would like to tell 
        $sender_message';

$transport = Swift_SmtpTransport::newInstance("smtp.sagewanted.net");
$transport->setUsername("sagewantedcom");
$transport->setPassword("fakepassword");

//create mailer
$swift = Swift_Mailer::newInstance($transport);

$message = new Swift_Message($subject);
$message->setFrom($from);
$message->setBody($text);

    
//send message
$result = $mailer->send($message);

if ($result)
{
    header('location: thank-you.html');
}

?>

