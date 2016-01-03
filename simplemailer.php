<?php
require_once 'lib/swift_required.php';

//Create the SMTP configuration
$transport = Swift_SmtpTransport::newInstance("smtpout.secureserver.net", 80);
$transport->setUsername("info@tutusentournant.com");
$transport->setPassword("Zooey03");

//Create the message
$message = Swift_Message::newInstance();
$message->setTo(array(
	"adrian.conley@gmail.com" => "Adrian Conley"
));
$message->setSubject("You have a new customer order!");
$message->setBody("You're our best client ever.");
$message->setFrom("info@tutusentournant.com", "info");

//Send email
$mailer = Swift_Mailer::newInstance($transport);
$mailer->send($message);
?>
------------------------------
<?php
require_once 'lib/swift_required.php';
if($_POST['send'] && isset($_FILES['file'])) {
	//Create the SMTP configuration
	$transport = Swift_SmtpTransport::newInstance("smtpout.secureserver.net", 80);
	$transport->setUsername("info@tutusentournant.com");
	$transport->setPassword("Zooey03");

    $recepient_email    = "adrian.conley@gmail.com"; //recepient
    $from_email         = "info@tutusentournant.com"; //from email using site domain.
    $subject            = "New customer order!"; //email subject line
    
    $sender_name = filter_var($_POST["s_name"], FILTER_SANITIZE_STRING); //capture sender name
    $sender_email = filter_var($_POST["s_email"], FILTER_SANITIZE_STRING); //capture sender email
    $sender_phone = filter_var($_Post["phonenumber"], FILTER_SANITIZE_STRING); //capture phone number
    $sender_message = filter_var($_POST["s_message"], FILTER_SANITIZE_STRING); //capture message
    $attachments = $_FILES['file'];
    
    //php validation
    if(strlen($sender_name)<4){
        exit('Name is too short or empty');
    }
    if (!filter_var($sender_email, FILTER_VALIDATE_EMAIL)) {
        exit('Invalid email');
    }
    if(strlen($sender_message)<4){
        exit('Too short message! Please enter something');
    }
	$message->setSubject("You have a new customer order!");
    $message->setBody("$sender_name has requested a new order. Their email address is $sender_email 
    	and you can reach them at $sender_phone. Here's what they've said: $sender_message");
    $message->setFrom("info@tutusentournant.com", "info");

    $mailer = Swift_Mailer::newInstance($transport);
	$mailer->send($message);
}
?>