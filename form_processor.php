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
/**
 * Returns error message if error occured, otherwise - empty string
 */
function attach_handler(){
    if($isAttachPresent){
        $target_file = basename($_FILES["fileToUpload"]["name"]);
        $image_file_type = pathinfo($target_file, PATHINFO_EXTENSION);
        if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
            return "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        }
        $check_format_size = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
        if (!$check_format_size){
            return "File is not an image " . $check_format_size["mime"] . ".";
        }
        if($_FILES["fileToUpload"]["size"] > 2048000){//2 Mb
            return "Too large file.";
        }
        //creating attachment
    }
}
//data should be prevalidated on the fly

$name = input_validator($_POST["nameFF"]);
$email = input_validator($_POST["contactFF"]);
$tel = input_validator($_POST["telFF"]);
$message = input_validator($_POST["messageFF"]);
$isAttachPresent = false;
if(isset($_POST["attachPic"]) && $_FILES["fileToUpload"]["name"] != ""){
    $isAttachPresent = true;
}



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

if(mail($to, $subject, $message, $headers)){
    echo "success";
}
    