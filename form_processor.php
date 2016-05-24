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

//hard to fix locale
setlocale(LC_ALL, 'en_US');
date_default_timezone_set("Europe/Kiev");

$to = "funny_foam@yahoo.com";
$headers = "MIME-Version: 1.0\r\n"
    . "From: admin@ketzer.pp.ua \r\n"
    . "Content-Type: text/plain; charset=UTF-8 \r\n"
    . "Reply-To: =?utf-8?b?".base64_encode($name)."?= <".$email.">"."\r\n"
    . "X-Mailer: PHP/" . phpversion();
$subject = "=?utf-8?b?".base64_encode("Order from ".$name." - ".$email)."?=";
$message = wordwrap($message."\r\nTel.: ".$tel."\r\nE-mail: ".$email."\r\nDate: ".strftime("%A, %d-%B-%G %T"),70,"\r\n");
//$message = "=?utf-8?b?".base64_encode($message)."?=";

if(mail($to, $subject, $message, $headers)){
    echo "success";
}else{
    echo "fail";
}