<?php
/**
 * Created by PhpStorm.
 * User: coder
 * Date: 23.05.16
 * Time: 21:38
 */

/**
 * @param $data
 * @return string normalize string from input form
 */
function input_validator($data){
    return trim(stripslashes(htmlspecialchars($data)));
}

$email = input_validator($_REQUEST["email"]);
$output = "";
if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
    $output = "Неправильный email";
}

echo $output;
