<?php


/**
 * Show template, assign passed variables and die.
 */
function view( $template_file, $var_arr = [] ) {
    extract($var_arr);
    include_once 'view/' . $template_file;
    exit;
}


/**
 * Dump n die. Prints out variable and then die like a real hero.
 */
function dd( $var ) {
    echo '<pre>';
    var_dump($var);
    echo '</pre>';
    die();
}


function logged_in() {
    if( isset( $_SESSION['login'] ) && $_SESSION['login'] ) {
        return true;
    }
    
    return false;
}
