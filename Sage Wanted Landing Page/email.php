<?php
require_once 'lib/swift_required.php';

//grab post data
$sender_name = filter_var($_POST["nameInput"], FILTER_SANITIZE_STRING); //capture sender name
$sender_email = filter_var($_POST["emailInput"], FILTER_SANITIZE_STRING); //capture sender email
$sender_phone = filter_var($_Post["phonenumber"], FILTER_SANITIZE_STRING); //capture phone number
$sender_message = filter_var($_POST["otherMessage"], FILTER_SANITIZE_STRING); //capture message

//Create the SMTP configuration
$transport = Swift_SmtpTransport::newInstance("smtp.sagewanted.net");
$transport->setUsername("sagewantecom");
$transport->setPassword("Jack123++");

$recepient_email    = "info@sagewanted.com"; //recepient
$from_email         = "noreply@sagewanted.com"; //from email using site domain.
$subject            = "New Sign Up!"; //email subject line

//create mailer
$mailer = Swift_Mailer::newInstance($transport);
    if(is_uploaded_file($_FILES['fieldAttachment']['tmp_name'])){
    $message = Swift_Message::newInstance('Web Lead')
    ->setTo(array(
    "info@sagewanted.com" => "Adrian Conley"))
    ->setFrom("info@tutusentournant.com", "info")
    ->setSubject("You have a new customer order!")
    ->setBody("$sender_name has requested a new order. Their email address is $sender_email 
    and you can reach them at $sender_phone. Here's what they've said: $sender_message")
    ->attach(
        Swift_Attachment::fromPath($_FILES['fieldAttachment']
        ['tmp_name'])->setFilename($_FILES['fieldAttachment']['name']));
    } else {
        $message = Swift_Message::newInstance('Web Lead')
    ->setTo(array(
    "info@tutusentournant.com" => "Brenda Smith"))
    ->setFrom("info@tutusentournant.com", "info")
    ->setSubject("You have a new customer order!")
    ->setBody("$sender_name has requested a new order. Their email address is $sender_email 
    and you can reach them at $sender_phone. Here's what they've said: $sender_message");
    }
    
//send message
$result = $mailer->send($message);

if ($result)
{
    header('location: thank-you.html');
}

?>