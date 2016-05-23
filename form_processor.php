<?php
/**
 * Created by PhpStorm.
 * User: coder
 * Date: 23.05.16
 * Time: 21:37
 */
function input_validator($data){
    return trim(stripslashes(htmlspecialchars($data)));
}

//data should be prevalidated on the fly

$name = input_validator($_POST["nameFF"]);
$email = input_validator($_POST["contactFF"]);
$tel = input_validator($_POST["telFF"]);
$message = input_validator($_POST["messageFF"]);

$to = "funny_foam@yahoo.com";
$headers = "From: admin@ketzer.pp.ua \r\n"
    . "Reply-To: " . $email . "\r\n"
    . "X-Mailer: PHP/" . phpversion();
$subject = "Order";
$message = wordwrap($message."\r\nTel.: ".$tel."\r\nE-mail: ".$email,70,"\r\n");

if(mail($to, $subject, $message, $headers)){
    echo "success";
}else{
    echo "fail";
}