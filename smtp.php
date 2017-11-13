<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>PHPMailer - SMTP test</title>
</head>
<body>
<?php
$email = $_REQUEST['email'];
$message = $_REQUEST['message'];
require_once 'PHPMailerAutoload.php';

$results_messages = array();

$mail = new PHPMailer(true);
$mail->CharSet = 'utf-8';

class phpmailerAppException extends phpmailerException {}

try {
$to = 'contactus@example.com';
if(!PHPMailer::validateAddress($to)) {
  throw new phpmailerAppException("Email address " . $to . " is invalid -- aborting!");
}
$mail->isSMTP();
$mail->SMTPDebug  = 0;
$mail->Host       = "localhost";
$mail->Port       = "465";
$mail->SMTPSecure = "ssl";
$mail->SMTPAuth   = true;
$mail->Username   = "contactus@example.com";
$mail->Password   = "password";
$mail->From       = $email;
$mail->Subject  = "Test(PHPMailer test using SMTP)";
$mail->body = $message;
$mail->WordWrap = 80;
$mail->msgHTML($body, dirname(__FILE__), true); //Create message bodies and embed images
$mail->addAttachment('images/phpmailer_mini.png','phpmailer_mini.png');  // optional name
$mail->addAttachment('images/phpmailer.png', 'phpmailer.png');  // optional name

try {
  $mail->send();
  $results_messages[] = "Message has been sent using SMTP";
}
catch (phpmailerException $e) {
  throw new phpmailerAppException('Unable to send to: ' . $to. ': '.$e->getMessage());
}
}
catch (phpmailerAppException $e) {
  $results_messages[] = $e->errorMessage();
}

if (count($results_messages) > 0) {
  echo "<h2>Run results</h2>\
";
  echo "<ul>\
";
foreach ($results_messages as $result) {
  echo "<li>$result</li>\
";
}
echo "</ul>\
";
}
?>
</body>
</html>


