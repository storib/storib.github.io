<?php
	if (isset($_POST['send'])) {
		$to = 'adrian.conley@gmail.com';
		$subject = 'New Customer Order';
		$message = 'Name: ' . $_POST['name'] . "\r\n\r\n";
		$message .= 'Email: ' . $_POST['email'] . "\r\n\r\n";
		$message .= 'Customer message: ' . $_POST['userInput'];
		$message .= 'Phone number: ' . $_POST['phoneNumber'];
		$headers = "From: info@tutusentournant.com\r\n";
		$headers .= 'Content-Type: text/plain; charset=utf-8';
		//attachment
		$attachment = chunk_split(base64_encode(file_get_contents($_FILES['uploaded_file']['tmp_name'])));
    	$filename = $_FILES['uploaded_file']['name'];

    	$boundary =md5(date('r', time())); 
		//
		$email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
		if ($email) {
			$headers .= "\r\nReply-To: $email";
		}

		$success = mail($to, $subject, $message, $headers);
	}
?>

<?php if (isset($success) && $success) { ?>
<html>
<link rel="stylesheet" type="text/css" href="css/style.css">
<title>Tutus en Tournant - Hand crafted Classical Tutus and More!</title>
<header>
  <nav class="fixed-nav-bar">
    <ul> <a href="/">Our Work</a></ul>
    <ul> <a href="order.html">Order</a></ul>
    <ul> <a href="about.html">About</a></ul>
  </nav>
</header>
<body>
	<h1>Thank You</h1>
	<p>Your message has been sent.</p>
</body>
  <footer>
    &copy;2015 Tutus en Tournant
  </footer>
</html>
<?php } else { ?>
<html>
<link rel="stylesheet" type="text/css" href="css/style.css">
<title>Tutus en Tournant - Hand crafted Classical Tutus and More!</title>
<header>
  <nav class="fixed-nav-bar">
    <ul> <a href="/">Our Work</a></ul>
    <ul> <a href="order.html">Order</a></ul>
    <ul> <a href="about.html">About</a></ul>
  </nav>
</header>
<body>
	<h1>Ooops!</h1>
	<p>Your message failed to send.</p>
</body>
  <footer>
    &copy;2015 Tutus en Tournant
  </footer>
</html>
<?php } ?>
