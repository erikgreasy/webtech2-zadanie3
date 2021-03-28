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
function dd( $var = '' ) {
    echo '<pre>';
    var_dump($var);
    echo '</pre>';
    die();
}


function logged_in() {
    if( isset( $_SESSION['user_id'] ) && $_SESSION['user_id'] ) {
        return true;
    }
    
    return false;
}

function login_user( $user_id, $login ) {
    // dd(model\Auth::getInstance()->login());
    $_SESSION['user_id'] = $user_id;
    // $db = new inc\Database();
    // $conn = $db->getConnection();
    // log_login( $conn, $user_id );

    return true;
}

function logout_user() {
    session_destroy();
}



function get_logged_user() {
    if( !logged_in() ) {
        return false;
    }

    $user_id = $_SESSION['user_id'];

    $ur = new repository\UserRepository();
        
    return $ur->getUser( $user_id );

}