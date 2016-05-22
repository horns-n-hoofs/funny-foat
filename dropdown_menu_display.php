<?php
/**
 * Created by PhpStorm.
 * User: coder
 * Date: 18.05.16
 * Time: 22:07
 */
$display = $_REQUEST["display"];
$list = "";
if ($display == 1) {
$list = "<ul style=\"display: inline-block\">
        <li class=\"active nav1\" onclick=\"displayDropdown(0)\"><a href=\"#page_Onas\">О нас</a></li>
        <li class=\"nav2\" onclick=\"displayDropdown(0)\"><a href=\"#page_Vyveskiizpenoplasta\">Вывески из пенопласта</a></li>
        <li class=\"nav3\" onclick=\"displayDropdown(0)\"><a href=\"#page_Prazdnichnyidekor\">Праздничный декор</a></li>
        <li class=\"nav4\" onclick=\"displayDropdown(0)\"><a href=\"#page_Vashuyutnyidom\">Ваш уютный дом</a></li>
        <li class=\"nav5\" onclick=\"displayDropdown(0)\"><a href=\"#page_Kontakty\">Контакты</a></li>
      </ul>";
}
echo $list;