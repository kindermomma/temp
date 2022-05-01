<?php


use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

// Load Composer's autoloader
require_once './PHPMailer.php';
require_once './SMTP.php';
require_once './Exception.php';

// Instantiation and passing `true` enables exceptions
$mail = new PHPMailer(true);

if (!isset($_POST['name']) || empty($_POST['name'])) {
    echo json_encode(array(
        'success' => false,
        'msg' => 'Please provide your name.'
    ));
    exit;
}

if (!isset($_POST['email']) || empty($_POST['email'])) {
    echo json_encode(array(
        'success' => false,
        'msg' => 'Please provide your email.'
    ));
    exit;
}

if (!isset($_POST['message']) || empty($_POST['message'])) {
    echo json_encode(array(
        'success' => false,
        'msg' => 'Please leave your message.'
    ));
    exit;
}

$name = $_POST['name'];
$email = $_POST['email'];
$message = $_POST['message'];
$from = 'ThatKinderMama@gmail.com';
$to = 'ThatKinderMama@gmail.com';
$subject = "ThatKinderMama Website Contact Form";
$msg= "<b>You have received a new message from $name<$email>:</b><br/><br/>$message";

if(mail($to,$subject,$msg, array(
    'From' => $from,
    'Reply-To' => $email,
    'Content-type' => 'text/html; charset=iso-8859-1'
))){
    echo json_encode(array(
        'success' => 1,
        'msg' => 'Message has been sent'
    ));
}else{
    echo json_encode(array(
        'success' => 0,
        'msg' => "Message could not be sent. Mailer Error: {$mail->ErrorInfo}"
    ));
}
exit;


