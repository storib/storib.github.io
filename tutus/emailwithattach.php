<?php
	if(isset($_Post['submit'])) {
		$output = '<h1> Thanks for your file and message!</h1>';
		$flags = 'style="display:none;"';
		$to = 'info@tutusentourant.com';
		$subject = 'A new order came in!';

		$message = strip_tags($_POST['message']);
		$attachment = chunk_split(base64_encode(file_get_contents($_FILES['file']['tmp_name'])));
		$filename = $_FILES['file']['name'];

		$boundary =md5(date('r', time()));

		$headers = "From: webmaster@example.com\r\nReply-To: info@tutusentournant.com";
		$headers .= "\r\nMIME-Version: 1.0\r\nContent-Type: multipart/mixed; boundary=\"_1_$boundary\"";

		$message = "This is a multi-part message in MIME format.";

    	mail($to, $subject, $message, $headers);
    }