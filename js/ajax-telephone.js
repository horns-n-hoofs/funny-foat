/**
 * Created by coder on 20.05.16.
 */
function displayPhone() {
    if (window.XMLHttpRequest) {
        xmlhttp = new XMLHttpRequest();
    } else {
        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
    }
    xmlhttp.onreadystatechange = function () {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            document.getElementById("ajax-telephone").innerHTML = xmlhttp.responseText;
        }
    }
    xmlhttp.open("GET", "telephone_display.php", true);
    xmlhttp.send();
}