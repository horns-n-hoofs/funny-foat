<?php
$display = ($_REQUEST["display"]);
$output = "";
if($display == "true"){
<<<<<<< HEAD
    $output = "true";
=======
    $output = "<input type=\"file\" name=\"fileToUpload\"/>";
>>>>>>> origin/master
}
echo $output;
