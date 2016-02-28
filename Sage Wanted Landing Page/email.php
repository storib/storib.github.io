<?php
require_once 'lib/swift_required.php';

//grab post data
$sender_name = filter_var($_POST["nameInput"], FILTER_SANITIZE_STRING); //capture sender name
$sender_email = filter_var($_POST["emailInput"], FILTER_SANITIZE_STRING); //capture sender email
$sender_sageRegistration = filter_var($_Post["sageRegistration"], FILTER_SANITIZE_STRING); //capture phone number
$sender_subjects = filter_var($_POST["subjects"], FILTER_SANITIZE_STRING); //capture message
$sender_message = filter_var($_POST["otherMessage"], FILTER_SANTITIZE_STRING);

//Create the SMTP configuration
$transport = Swift_SmtpTransport::newInstance("smtp.gmail.net", 465, "ssl")
	->setUsername("adrian@sagewanted.com")
	->setPassword("xxx");

//create mailer
$mailer = Swift_Mailer::newInstance($transport);

$message = Swift_Message::newInstance('New Sign Up!')
	->setFrom(array('noreply@sagewanted.com' => 'SageWanted'))
	->setTo(array('adrian@sagewanted.com' => 'Adrian Conley'))
	->setBody('$sender_name signed up on SageWanted.com. Their email address is $sender_email
        and wanted to register as $sender_sageRegistration with the subjects $sender_subjects. They also would like to tell 
        $sender_message');

//send message
$result = $mailer->send($message);

echo($result);
/*if($recipients = $mailer->send($message, $failures))
{
	echo 'Message successfully sent!';
} else {
	echo "There was an error sending your message:\n";
	print_r($failures);
}*/
?>

