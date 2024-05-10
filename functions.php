<?php
function jednotka($kategoria) {
    if($kategoria == "vlhkost")
    {
        return "%"; 
    }
    elseif($kategoria == "teplota")
    {
        return "°C";
    }
    else 
    {
        return "";
    }
}