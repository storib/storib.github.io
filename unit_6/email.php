<?php
require_once 'lib/swift_required.php';

try{//grab post data
$sender_name = filter_var($_POST["nameInput"], FILTER_SANITIZE_STRING); //capture sender name
$sender_email = filter_var($_POST["emailInput"], FILTER_SANITIZE_STRING); //capture sender email
$sender_interest = filter_var($_POST["interest"], FILTER_SANITIZE_STRING); //capture interest 
$sender_subjects = filter_var($_POST["subjects"], FILTER_SANITIZE_STRING); //capture message
$sender_location = filter_var($_POST["location"], FILTER_SANITIZE_STRING);
$sender_message = filter_var($_POST["s_message"], FILTER_SANITIZE_STRING);

//Create the SMTP configuration
$transport = Swift_SmtpTransport::newInstance("smtp.gmail.com", 465, "ssl")
	->setUsername("adrian@sagewanted.com")
	->setPassword("jack123987++");

//create mailer
$mailer = Swift_Mailer::newInstance($transport);

$message = Swift_Message::newInstance('New Sign Up!')
	->setFrom(array('noreply@sagewanted.com' => 'SageWanted'))
	->setTo(array('adrian@sagewanted.com' => 'Adrian Conley'))
	->setBody($sender_name ." " . "signed up on SageWanted.com. Their email address is" ." ". $sender_email ." ".
        "and wanted to ". $sender_interest ." with the subjects ". $sender_subjects . ". " 
        "They also would like to tell ". $sender_message . "they are located in" . " " . $sender_location);

//send message
$result = $mailer->send($message);
print_r($result);
} catch(Exception $e){
	echo $e->getMessage();
}

/*if ($result)
{
    header('location: thankyou.html');
}*/
?>

