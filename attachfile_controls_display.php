<?php
$display = ($_REQUEST["display"]);
$output = "";
if($display == "true"){
    $output = "<input type=\"file\" name=\"fileToUpload\"/>";
}
echo $output;
