<?php 

require_once 'config.php';
require_once 'controller/AuthController.php';
require_once 'controller/DashboardController.php';


use Pecee\Http\Request;
use Pecee\SimpleRouter\SimpleRouter as Router;

// AUTH
Router::get( ROUTING_PREFIX . '/' , 'DashboardController@show');
Router::get( ROUTING_PREFIX . '/login' , 'AuthController@login');
Router::post( ROUTING_PREFIX . '/login' , 'AuthController@handle_login');
Router::get( ROUTING_PREFIX . '/register' , 'AuthController@register');
Router::post( ROUTING_PREFIX . '/register' , 'AuthController@handleRegister');
Router::post( ROUTING_PREFIX . '/logout' , 'AuthController@logout');



// 404
Router::error(function(Request $request, \Exception $exception) {
    return view('core/404.php');
});

Router::start();
