/* 
 * 
 */

function showAttachFileDialog(isCheked){
    if(window.XMLHttpRequest){
        xmlhttp = new XMLHttpRequest();
    }else{
        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
    }
    xmlhttp.onreadystatechange = function () {
        if(xmlhttp.readyState == 4 && xmlhttp.status == 200){
            document.getElementById("ajax-attachfile").innerHTML = xmlhttp.responseText;
        }
    };
    xmlhttp.open("GET","php/attachfile_controls_display.php?display="+isCheked,true);
    xmlhttp.send();
}
