<?php

ini_set('display_errors', 1);

// WEB
DEFINE( "BASE_URL", "http://localhost/webtech/zadanie3" );
define( "ROUTING_PREFIX", 'webtech/zadanie3' );

// GOOGLE AUTH
DEFINE( "CLIENT_ID", "587670219289-n2friq6k62g7h0aqd1hf3fgrmael48bs.apps.googleusercontent.com" );
DEFINE( "CLIENT_SECRET", "mx3Tf7tM17SfbgltswdoprzX" );
DEFINE( "REDIRECT_URI", "http://localhost/webtech/zadanie3/login" );



require __DIR__ . '/vendor/autoload.php';
require_once 'inc/helper-router-functions.php';
require_once 'inc/functions.php';
  

// AUTOLOAD
spl_autoload_register(function ($class_name) {
    include str_replace( '\\', '/', $class_name ) . '.php';
});


// Start a Session
if (!session_id()) @session_start();
