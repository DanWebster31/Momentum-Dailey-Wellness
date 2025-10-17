<?php

require 'sendgrid/sendgrid-php.php';

define('SITE_BASE', dirname(__FILE__));
date_default_timezone_set('America/Los_Angeles');

$recaptchaSecret = '6LefZOMrAAAAAED8Uf-2MvzPxNf5L7Mbgpwdn1RZ';

// Get the token from the POST data
$recaptchaResponse = $_POST['g-recaptcha-response'] ?? '';

// 1. Check if the token is present
if (empty($recaptchaResponse)) {
    http_response_code(400);
    echo json_encode(['error' => 'reCAPTCHA token missing.']);
    exit;
}

// 2. Verify the token with Google
$verifyUrl = 'https://www.google.com/recaptcha/api/siteverify';
$data = [
    'secret' => $recaptchaSecret,
    'response' => $recaptchaResponse,
    'remoteip' => $_SERVER['REMOTE_ADDR']
];

$options = [
    'http' => [
      'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
      'method'  => 'POST',
      'content' => http_build_query($data) 
    ]
];
$context  = stream_context_create($options);
$result = file_get_contents($verifyUrl, false, $context);

if ($result === false) {
    $response = array('success' => false, 'hostname' => '');
} else {
    $response = json_decode($result, true);
}

$domain = 'momentumdailey.com';

$responseCheck = $response['success'];
$responseDomain = $response['hostname'] ?? '';
$responseDomainCheck = strpos($responseDomain, $domain);

/* general pages */
$p11base = 'https://'.$domain.'/i/';
$p11pagename = 'Momentum Dailey Wellness'; /* sprinkled around admin & processing */
$p11copyrightname = 'Momentum Dailey Wellness'; 
$p11contact = 'noreply@'.$domain; /* noreply or custom email */
$p11contactname = $p11pagename; /* from name, defaults to pagename */
$p11domaincheck = $domain;

$mail = array();
$mail['sender'] = $p11contact;
$mail['senderName'] = $p11contactname;
//drj@drjeremydailey.com
$mail['recipient'] = 'drj@drjeremydailey.com,drj@momentumdailey.com';
$mail['subject']   = $p11contactname.' Contact Us Form Submission';
$mail['header']    = sprintf("From: %s\n", $mail['sender']);
$mail['header']   .= sprintf("Reply-To: %s",$mail['sender']);

$source = isset($_POST['source']) ? addslashes($_POST['source']) : '';
$firstName = isset($_POST['first_name']) ? addslashes($_POST['first_name']) : '';
$lastName = isset($_POST['last_name']) ? addslashes($_POST['last_name']) : '';
$fullName = $firstName." ".$lastName;
$email = isset($_POST['email']) ? addslashes($_POST['email']) : '';
$phone = isset($_POST['phone']) ? addslashes($_POST['phone']) : '';
// $address = isset($_POST['address']) ? addslashes($_POST['address']) : '';
// $city = isset($_POST['city']) ? addslashes($_POST['city']) : '';
// $state = isset($_POST['state']) ? addslashes($_POST['state']) : '';
// $zip = isset($_POST['zip']) ? addslashes($_POST['zip']) : '';
// $howHear = isset($_POST['how_hear']) ? addslashes($_POST['how_hear']) : '';
$comments = isset($_POST['comments']) ? addslashes($_POST['comments']) : '';

// $company = isset($_POST['company']) ? addslashes($_POST['company']) : '';
// $title = isset($_POST['title']) ? addslashes($_POST['title']) : '';

// Custom Fields added to comments
// $commentsWithDetails = '';
// $commentsWithDetails .= $comments;
// if (!empty($industry)) {
//     $commentsWithDetails .= "<br>Industry: " . $industry;
// }
// if (!empty($range)) {
//     $commentsWithDetails .= "<br>Range of Investment: " . $range;
// }
// $comments = trim($commentsWithDetails);
// End Custom Fields added to comments

$notification = isset($_POST['notification']) ? $_POST['notification'] : '';
$notification = explode(",", $notification ?: '');

if($notification[0] == ""){
	//drj@drjeremydailey.com
    $notification[0] = "drj@drjeremydailey.com";
} else {
    array_push($notification,"drj@drjeremydailey.com");
	 array_push($notification, "drj@momentumdailey.com");
	 //array_push($notification, "webantics@gmail.com");
}

$mail['fields'][]  = array('label' => 'Source', 'variable' => $source);
$mail['fields'][]  = array('label' => 'First Name', 'variable' => $firstName);
$mail['fields'][]  = array('label' => 'Last Name', 'variable' => $lastName);
// $mail['fields'][]  = array('label' => 'Company', 'variable' => $company);
// $mail['fields'][]  = array('label' => 'Title', 'variable' => $title);
$mail['fields'][]  = array('label' => 'Email', 'variable' => $email);
$mail['fields'][]  = array('label' => 'Phone', 'variable' => $phone);
// $mail['fields'][]  = array('label' => 'Address', 'variable' => $address);
// $mail['fields'][]  = array('label' => 'City', 'variable' => $city);
// $mail['fields'][]  = array('label' => 'State', 'variable' => $state);
// $mail['fields'][]  = array('label' => 'Zip', 'variable' => $zip);
// $mail['fields'][]  = array('label' => 'How Hear', 'variable' => $howHear);
$mail['fields'][]  = array('label' => 'Comments', 'variable' => $comments);

$mail['fields'][]  = array('label' => 'Recaptcha Response', 'variable' => json_encode($response));
$mail['fields'][]  = array('label' => 'responseCheck', 'variable' => $responseCheck);
$phone = preg_replace('/\D+/', '', $phone);

$mail['message'] = '<html>
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width" initial-scale="1">
<meta name="x-apple-disable-message-reformatting">
<title></title>
	<style type="text/css">.ExternalClass *{line-height:100%}td{-webkit-text-size-adjust:none}</style>
</head>
<body style="margin: 0; padding: 0;" marginheight="0" marginwidth="0" topmargin="0" bgcolor="#ffffff">
<table border="0" cellpadding="0" cellspacing="0" width="100%" bgcolor="#ffffff">
<tr>
<td height="20" style="font-size:20px; line-height:20px;">&nbsp;
</td>
</tr>
<tr>
<td align="center">
<table border="0" cellpadding="0" cellspacing="0">
<tr>
<td align="center" width="600">
<table border="0" cellspacing="0" cellpadding="0" align="center" style="border: solid 1px #e9e9e9;">
<tr>
<td width="600" align="center" bgcolor="#f2f2f2">
<table border="0" cellpadding="0" cellspacing="0">
<tr>
<td colspan="3" height="20" style="font-size:20px; line-height:20px;">&nbsp;
</td>
</tr>
<tr>
<td align="center" style="font-family: Arial, Helvetica, sans-serif; color:#242424; font-size:21px; line-height:25px;">
'.$p11pagename.' Interest List Submission
</td>
</tr>
<tr>
<td colspan="3" height="20" style="font-size:20px; line-height:20px;">&nbsp;
</td>
</tr>
</table>
</td>
</tr>
<tr>
<td width="600" bgcolor="#fafafa">
<table border="0" cellpadding="0" cellspacing="0">
<tr>
<td colspan="3" height="1" width="600" style="font-size:1px; line-height:1px;" bgcolor="#e9e9e9">&nbsp;
</td>
</tr>
<tr>
<td colspan="3" height="20" style="font-size:20px; line-height:20px;">&nbsp;
</td>
</tr>
<tr>
<td width="50">
</td>
<td width="500" style="font-family: Arial, Helvetica, sans-serif; color:#242424; font-size:15px; line-height:25px;" align="left">';
foreach($mail['fields'] as $field) {
    if ($field['label'] === 'Recaptcha Response' || $field['label'] === 'responseCheck') {
        $debugFields[] = sprintf("%s: %s", $field['label'], stripslashes($field['variable']));
    } else {
        $mail['message']  .= sprintf("%s: %s<br />",$field['label'], stripslashes($field['variable']));
    }
}
if (!empty($debugFields)) {
    $mail['message'] .= '<div style="color:#888;font-size:12px;margin-top:30px;">'.implode('<br>', $debugFields).'</div>';
}
$mail['message']  .= '</td>
<td width="50">
</td>
</tr>
<tr>
<td colspan="3" height="20" style="font-size:20px; line-height:20px;">&nbsp;
</td>
</tr>
</table>
</td>
</tr>
</table>
</td>
</tr>
</table>
</td>
</tr>
<tr>
<td height="20" style="font-size:20px; line-height:20px;">&nbsp;
</td>
</tr>
<tr>
<td width="500" style="font-family: Arial, Helvetica, sans-serif; color:#242424; font-size:11px; line-height:25px;text-align:center; font-style: italic;" align="center">
Alert for '.$p11pagename.' sent via P11 list manager
</td>
</tr>
<tr>
<td height="20" style="font-size:20px; line-height:20px;">&nbsp;
</td>
</tr>
</table>
</body>
</html>';

/* spam stuff */
$encryptedLoadedFormTime = $_POST['apptJWpGaA6Bna74KNg'];
$formFilledInSeconds = time() - $encryptedLoadedFormTime;
$locDomain = $_SERVER['HTTP_REFERER'];
$posDomain = strpos($locDomain, $p11domaincheck);
if ($posDomain !== false) {
    $domainTest = 'pass';
} else {
    //$domainTest = 'fail';
    $domainTest = 'pass';
}

$httpCheck = array();
function checkURL($urlToCheck) {
    global $httpCheck;
    if (!is_string($urlToCheck)) {
        return;
    }
    $urlCheck = strpos($urlToCheck,'http');
    if ($urlCheck !== false) {
        array_push($httpCheck, $urlCheck);
    }
}

checkURL($firstName);
checkURL($lastName);
checkURL($email);
checkURL($phone);	
// checkURL($company);	
// checkURL($title);	

if(count($httpCheck) == 0) {
    $fieldCheck = 'pass';
} else {
    $fieldCheck = 'fail';
}

/* Spam Check */
if ($formFilledInSeconds > 5 && $domainTest != 'fail' && $fieldCheck != 'fail' && $email != "" && $responseCheck === true && $responseDomainCheck !== false) {

	$sendgrid = new SendGrid('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');

	foreach($notification as $notificationemail) {
			$clientalert = new \SendGrid\Mail\Mail();
			$clientalert->setFrom($p11contact, $fullName);
			$clientalert->setSubject($mail['subject']);
			$clientalert->addTo($notificationemail);
			$clientalert->addContent("text/html", $mail['message']);
	
			try {;;
							$response = $sendgrid->send($clientalert);
							//print $response->statusCode() . "\n";
							//print_r($response->headers());
							//print $response->body() . "\n";
			} catch (Exception $e) {
							echo 'Caught exception: '. $e->getMessage() ."\n";
			}
	}

	// Database Insert/Auto Response
	// $con = mysqli_connect($dbhost,$dbuser,$dbpass,$dbname);
	// $result = mysqli_query($con,"SELECT * FROM contacts WHERE email = '$email'");
	// $rows = mysqli_num_rows($result);
	
	// if ($rows == 0) {

	// 	// Insert into DB
	// 	$currentDate = date("Y-m-d");
	// 	$sql="INSERT INTO contacts (submitDate,source,firstName,lastName,email,phone,address,city,state,zip,howHear,comments) VALUES ('$currentDate','$source','$firstName','$lastName','$email','$phone','$address','$city','$state','$zip','$howHear','$comments')";
	// 	mysqli_query($con,$sql);

	// // Auto Response
	// $sql = "SELECT * FROM auto_response Where idNum = $autonumber";

	// $result2 = mysqli_fetch_assoc(mysqli_query($con, $sql));

	// $idNumTwo = $result2["idNum"];
	// $copyBlockTwo = $result2["content"];
	// $copyTitle = $result2["title"];

	// $sendername = "$p11contactname";
	// $senderemail = "$p11contact";
	// $sender    = "$sendername <$senderemail>";

	// $headers   = "From: $sender\r\n";
	// $headers  .= "Content-Type: text/html; charset=iso-8859-1";

	// $subject   = "$copyTitle";
	// $year = date("Y");

	// $message = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
	// <html xmlns="http://www.w3.org/1999/xhtml">
	// <head>
	// <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	// <title>'.$p11pagename.'</title>
	// </head>
	// <body style="margin: 0; padding: 0;" marginheight="0" marginwidth="0" topmargin="0" bgcolor="#f8f8f7">

	// <table width="100%" border="0" cellspacing="0" cellpadding="0" style="border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;" align="center" bgcolor="#f8f8f7">
	//   <tr>
	//     <td><table width="650" border="0" align="center" cellpadding="0" cellspacing="0" style="border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;">
	//       <tr>
	//         <td style="font-size:20px; line-height:20px;">&nbsp;</td>
	//       </tr>
	//       <tr>
	//         <td bgcolor="#FFFFFF"><img src="'.$p11base.'images/email-graphic.jpg" alt="'.$p11pagename.'" width="650" height="385" border="0" style="max-width:650px; display: block;" /></td>
	//       </tr>
	//       <tr>
	//         <td bgcolor="#FFFFFF"><table width="650" border="0" align="center" cellpadding="0" cellspacing="0" style="border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;">
	//           <tr>
	//             <td bgcolor="#FFFFFF"><table width="500" cellspacing="0" cellpadding="0" style="border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;" align="center">
	//               <tr>
	//                 <td style="font-size:40px; line-height:40px;">&nbsp;</td>
	//               </tr>
	//               <tr>
	//                 <td style="font-family: Arial, Helvetica, sans-serif; color:#243740; font-size:23px; line-height:33px; text-align: left;" align="center">'.$copyTitle.'</td>
	//               </tr>
	//               <tr>
	//                 <td style="font-size:30px; line-height:30px;">&nbsp;</td>
	//               </tr>
	//               <tr>
	//               <td><table width="500" border="0" align="center" cellpadding="0" cellspacing="0"><tr><td style="font-family: Arial, Helvetica, sans-serif; color:#333; font-size:15px; line-height:25px; text-align: left;" align="center">'.stripslashes(nl2br($copyBlockTwo)).'</td></tr></table></td>
	//                 </tr>
	//               <tr>
	//                 <td style="font-size:50px; line-height:50px;">&nbsp;</td>
	//                 </tr>
	//               </table></td>
	//           </tr>
	//           </table>
	//           </td>
	//       </tr>
	//       <tr>
	//         <td style="font-size:10px; line-height:10px;">&nbsp;</td>
	//       </tr>
	//       <tr>
	//         <td><table width="650" border="0" align="center" cellpadding="0" cellspacing="0">
	//           <tr>
	//             <td width="530"><table border="0" cellspacing="0" cellpadding="0">
	//               <tr>
	//                 <td width="5">&nbsp;</td>
	//                 <td width="37"><img src="'.$p11base.'images/email-eh.gif" alt="Equal Housing" width="26" height="26" border="0" /></td>
	//                 <td style="font-family: Arial, Helvetica, sans-serif; color:#808080; font-size:11px; line-height:26px; text-align: left;" align="left">© '.$year.' '.$p11copyrightname.'. All Rights Reserved.</td>
	//               </tr>
	//             </table></td>
	//             <td width="90" align="right">&nbsp;</td>
	// 					</tr>
	//         </table></td>
	//       </tr>
	//     </table>
	//     </td>
	//   </tr>
	//   <tr>
	//         <td style="font-size:20px; line-height:20px;">&nbsp;</td>
	//       </tr>
	// </table>

	// </body>
	// </html>';

	// $autoalert = new \SendGrid\Mail\Mail();
	// $autoalert->setFrom($p11contact);
	// $autoalert->setSubject($subject);
	// $autoalert->addTo($email);
	// $autoalert->addContent("text/html", $message);
 
	// try {
	// 				$response = $sendgrid->send($autoalert);
	// 				//print $response->statusCode() . "\n";
	// 				//print_r($response->headers());
	// 				//print $response->body() . "\n";
	// } catch (Exception $e) {
	// 				echo 'Caught exception: '. $e->getMessage() ."\n";
	// }

	// mysqli_close($con);

	// } // End Database Insert/Auto Response

} // End Spam Check

?>
