<?php
/*
Name: 			Contact Form - Google Recaptcha v2
Written by: 	Okler Themes - (http://www.okler.net)
Theme Version:	8.3.0
*/

namespace PortoContactForm;

ini_set('allow_url_fopen', true);

session_cache_limiter('nocache');
header('Expires: ' . gmdate('r', 0));

header('Content-type: application/json');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'php-mailer/src/PHPMailer.php';
require 'php-mailer/src/SMTP.php';
require 'php-mailer/src/Exception.php';

if(isset($_POST['g-recaptcha-response']) && !empty($_POST['g-recaptcha-response'])) {

	// Your Google reCAPTCHA generated Secret Key here
	$secret = 'YOUR_RECAPTCHA_SECRET_KEY';
	
	if( ini_get('allow_url_fopen') ) {
		//reCAPTCHA - Using file_get_contents()
		$verifyResponse = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret='.$secret.'&response='.$_POST['g-recaptcha-response']);
		$responseData = json_decode($verifyResponse);
	} else if( function_exists('curl_version') ) {
		// reCAPTCHA - Using CURL
		$fields = array(
	        'secret'    =>  $secret,
	        'response'  =>  $_POST['g-recaptcha-response'],
	        'remoteip'  =>  $_SERVER['REMOTE_ADDR']
	    );

	    $verifyResponse = curl_init("https://www.google.com/recaptcha/api/siteverify");
	    curl_setopt($verifyResponse, CURLOPT_RETURNTRANSFER, true);
	    curl_setopt($verifyResponse, CURLOPT_TIMEOUT, 15);
	    curl_setopt($verifyResponse, CURLOPT_POSTFIELDS, http_build_query($fields));
	    $responseData = json_decode(curl_exec($verifyResponse));
	    curl_close($verifyResponse);
	} else {
		$arrResult = array ('response'=>'error','errorMessage'=>'You need CURL or file_get_contents() activated in your server. Please contact your host to activate.');
		echo json_encode($arrResult);
		die();
	}

	if($responseData->success) {

		// Step 1 - Enter your email address below.
		$email = 'you@domain.com';

		// If the e-mail is not working, change the debug option to 2 | $debug = 2;
		$debug = 0;

		// If contact form don't have the subject input, change the value of subject here
		$subject = ( isset($_POST['subject']) ) ? $_POST['subject'] : 'Define subject in php/contact-form-recaptcha.php line 62';

		$message = '';

		foreach($_POST as $label => $value) {
			if( $label != 'g-recaptcha-response' ) {
				$label = ucwords($label);

				// Use the commented code below to change label texts. On this example will change "Email" to "Email Address"

				// if( $label == 'Email' ) {               
				// 	$label = 'Email Address';              
				// }

				// Checkboxes
				if( is_array($value) ) {
					// Store new value
					$value = implode(', ', $value);
				}

				$message .= $label.": " . htmlspecialchars($value, ENT_QUOTES) . "<br>\n";
			}
		}

		$mail = new PHPMailer(true);

		try {

			$mail->SMTPDebug = $debug;                                 // Debug Mode

			// Step 2 (Optional) - If you don't receive the email, try to configure the parameters below:

			//$mail->IsSMTP();                                         // Set mailer to use SMTP
			//$mail->Host = 'mail.yourserver.com';				       // Specify main and backup server
			//$mail->SMTPAuth = true;                                  // Enable SMTP authentication
			//$mail->Username = 'user@example.com';                    // SMTP username
			//$mail->Password = 'secret';                              // SMTP password
			//$mail->SMTPSecure = 'tls';                               // Enable encryption, 'ssl' also accepted
			//$mail->Port = 587;   								       // TCP port to connect to

			$mail->AddAddress($email);	 						       // Add another recipient

			//$mail->AddAddress('person2@domain.com', 'Person 2');     // Add a secondary recipient
			//$mail->AddCC('person3@domain.com', 'Person 3');          // Add a "Cc" address. 
			//$mail->AddBCC('person4@domain.com', 'Person 4');         // Add a "Bcc" address. 

			// From - Name
			$fromName = ( isset($_POST['name']) ) ? $_POST['name'] : 'Website User';
			$mail->SetFrom($email, $fromName);

			// Repply To
			if( isset($_POST['email']) ) {
				$mail->AddReplyTo($_POST['email'], $fromName);
			}

			$mail->IsHTML(true);                                  // Set email format to HTML

			$mail->CharSet = 'UTF-8';

			$mail->Subject = $subject;
			$mail->Body    = $message;

			$mail->Send();
			$arrResult = array ('response'=>'success');

		} catch (Exception $e) {
			$arrResult = array ('response'=>'error','errorMessage'=>$e->errorMessage());
		} catch (\Exception $e) {
			$arrResult = array ('response'=>'error','errorMessage'=>$e->getMessage());
		}

		if ($debug == 0) {
			echo json_encode($arrResult);
		}

	} else {
		$arrResult = array ('response'=>'error','errorMessage'=>'Robot verification failed, please try again');
		echo json_encode($arrResult);
	}

} else { 
	$arrResult = array ('response'=>'error','errorMessage'=>'Please click on the reCAPTCHA box.');
	echo json_encode($arrResult);
}