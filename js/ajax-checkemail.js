/**
 * Created by coder on 29.05.16.
 */
function checkEmail(str) {
    if (str.length == 0) {
        document.getElementById("email").innerHTML = "";
        return;
    } else {
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                document.getElementById("email").innerHTML = xmlhttp.responseText;
            }
        };
        xmlhttp.open("GET", "php/email_validator.php?email=" + str, true);
        xmlhttp.send();
    }
}