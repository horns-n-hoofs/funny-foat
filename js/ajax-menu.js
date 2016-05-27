/**
 * Created by coder on 20.05.16.
 */
function displayDropdown(display) {
    if(window.XMLHttpRequest){
        xmlhttp = new XMLHttpRequest();
    }else{
        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
    }
    xmlhttp.onreadystatechange = function () {
        if(xmlhttp.readyState == 4 && xmlhttp.status == 200){
            document.getElementById("ajax-menu").innerHTML = xmlhttp.responseText;
        }
    };
    xmlhttp.open("GET","dropdown_menu_display.php?display="+display,true);
    xmlhttp.send();
}