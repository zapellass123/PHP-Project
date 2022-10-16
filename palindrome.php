<?php

function palindrome($str) {
    $str = str_replace(' ', '', preg_replace('/[^A-Za-z0-9\-]/', '', $str));
    $word = "";
    for ($i = strlen($str)-1; $i >= 0;$i--) {
        $word .= $str[$i];
    } 
    // Return value to check your result
    return $word == $str ? true : false;
}

// $string = palindrome("level");
// var_dump($string);