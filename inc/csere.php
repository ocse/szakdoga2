<?php
function ekezetnelkul($filename){
    $keres = array("á", "é", "í", "ó", "ö", "ő", "ú", "ü", "ű", " ", );
    $csere = array("a", "e", "i", "o", "o", "o", "u", "u", "u", "_", );
    return str_replace($keres, $csere, $filename);
    
}