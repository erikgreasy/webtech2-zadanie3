<?php

ini_set('display_errors', 1);


DEFINE( "BASE_URL", "http://localhost/webtech/zadanie3" );
define( "ROUTING_PREFIX", 'webtech/zadanie3' );

require __DIR__ . '/vendor/autoload.php';
require_once 'inc/helper-router-functions.php';
require_once 'inc/functions.php';


// Start a Session
if (!session_id()) @session_start();
