<?php
require_once 'lib/swift_required.php';

//grab post data
$sender_name = filter_var($_POST["s_name"], FILTER_SANITIZE_STRING); //capture sender name
$sender_email = filter_var($_POST["s_email"], FILTER_SANITIZE_STRING); //capture sender email
$sender_phone = filter_var($_Post["phonenumber"], FILTER_SANITIZE_STRING); //capture phone number
$sender_message = filter_var($_POST["s_message"], FILTER_SANITIZE_STRING); //capture message
$fromAttachment = $_POST['fieldAttachment'];

//Create the SMTP configuration
$transport = Swift_SmtpTransport::newInstance("smtpout.secureserver.net", 80);
$transport->setUsername("info@tutusentournant.com");
$transport->setPassword("Zooey03");

$from_email         = "info@tutusentournant.com"; //from email using site domain.
$subject            = "New customer order!"; //email subject line

//create mailer
$mailer = Swift_Mailer::newInstance($transport);
    if(is_uploaded_file($_FILES['fieldAttachment']['tmp_name'])){
    $message = Swift_Message::newInstance('Web Lead')
    ->setTo(array(
    "info@tutusentournant.com" => "Brenda Smith"))
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
    "adrian.conley@gmail.com" => "Adrian Conley"))
    ->setFrom("info@tutusentournant.com", "info")
    ->setSubject("You have a new customer order!")
    ->setBody("$sender_name has requested a new order. Their email address is $sender_email 
    and you can reach them at $sender_phone. Here's what they've said: $sender_message");
    }
    
//send message
$result = $mailer->send($message);

?>