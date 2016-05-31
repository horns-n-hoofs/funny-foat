<?php
/**
 * Created by PhpStorm.
 * @User: coder
 * @Date: 23.05.16
 * @Time: 21:37
 *
 * Do not properly displays attachment and message
 */

/**
 * Class AttachmentError
 * Custom class for attachment validation errors handling
 */
class AttachmentError extends Exception
{
    /**
     * @return string - error message
     */
    public function errMessage()
    {
        $error_message = $this -> getMessage();
        return $error_message;
    }
}

/**
 * @param $data
 * @return string normalize string from input form
 */
function input_validator($data){
    return trim(stripslashes(htmlspecialchars($data)));
}

//data should be prevalidated on the fly
/**
 * @return empty string if OK, error message otherwise
 */
function compose_and_send_mail()
{
    $name = input_validator($_POST["nameFF"]);
    if($name == ""){
        return "Введите Ваше имя";
    }
    $email = input_validator($_POST["contactFF"]);
    if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
        return "Неправильный email";
    }
    $tel = input_validator($_POST["telFF"]);
    $message = input_validator($_POST["messageFF"]);
    if($message == ""){
        return "Введите Ваше сообщение";
    }
    $isAttachPresent = false;
    if (isset($_POST["attachPic"]) && $_FILES["fileToUpload"]["name"] != "") {
        $isAttachPresent = true;
    }
//hard to fix locale
    setlocale(LC_ALL, 'en_US');
    date_default_timezone_set("Europe/Kiev");

    $boundary = md5("sontseslav");
    $to = "funny_foam@yahoo.com";
    $headers = "MIME-Version: 1.0\r\n"
        . "From: admin@ketzer.pp.ua \r\n"
        . "Reply-To: =?utf-8?b?" . base64_encode($name) . "?= <" . $email . ">" . "\r\n"
        . "Content-Type: multipart/mixed; boundary = $boundary\r\n\r\n";

    $subject = "=?utf-8?b?" . base64_encode("Order from " . $name . " - " . $email) . "?=";

    $body = "--$boundary\r\n";
    $body .= "Content-Type: text/plain; charset=UTF-8 \r\n";
    $body .= "Content-Transfer-Encoding: base64\r\n\r\n";
    $body .= chunk_split(base64_encode($message . "\r\nTel.: " . $tel . "\r\nE-mail: " . $email . "\r\nDate: " . strftime("%A, %d-%B-%G %T")));

    if ($isAttachPresent) {
        $target_file = basename($_FILES["fileToUpload"]["name"]);
        $image_file_type = pathinfo($target_file, PATHINFO_EXTENSION);
        try {
            //check it through ["mime"] instead
            if ($image_file_type != "jpg" && $image_file_type != "png" &&
                $image_file_type != "jpeg" && $image_file_type != "gif" &&
                $image_file_type != "JPG" && $image_file_type != "PNG" &&
                $image_file_type != "JPEG" && $image_file_type != "GIF"
            ) {
                throw new AttachmentError("Sorry, only JPG, JPEG, PNG & GIF files are allowed.");
            }
            $check_format_size = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
            if (!$check_format_size) {
                throw new AttachmentError("File is not an image " . $check_format_size["mime"] . ".");
            }
            if ($_FILES["fileToUpload"]["size"] > 2048000) {//2 Mb
                throw new AttachmentError("Too large file.");
            }
        } catch (AttachmentError $e) {
            return $e->errMessage();
        }

        //add attachment
        $file_MIME = $_FILES["fileToUpload"]["type"];
        $file_tmp = $_FILES["fileToUpload"]["tmp_name"];
        $file_size = $_FILES["fileToUpload"]["size"];
        $handle = fopen($file_tmp, "r");
        $content = fread($handle, $file_size);
        fclose($handle);
        $encoded_content = chunk_split(base64_encode($content));

        $body .= "--$boundary\r\n";
        $body .= "Content-Type: $file_MIME; name=\"$target_file\"\r\n";
        $body .= "Content-Disposition: attachment; filename=\"$target_file\"\r\n";
        $body .= "Content-Transfer-Encoding: base64\r\n";
        $body .= "X-Attachment-Id: " . rand(1000, 99999) . "\r\n\r\n";
        $body .= $encoded_content;
    }

    if (mail($to, $subject, $body, $headers)) {
        return ""; 
    }else{
        return "Произошла ошибка. Позвоните консультатну.";
    }
}
    
