<?php 

require_once 'inc/config.inc.php';

use Pecee\Http\Request;
use Pecee\SimpleRouter\SimpleRouter as Router;
Router::setDefaultNamespace('controller');

// DASHOBOARD
Router::get( ROUTING_PREFIX . '/' , 'DashboardController@show');
Router::get( ROUTING_PREFIX . '/login-stats' , 'DashboardController@stats');

// AUTH
Router::get( ROUTING_PREFIX . '/login' , 'AuthController@login');
Router::post( ROUTING_PREFIX . '/login' , 'AuthController@handle_login');
Router::get( ROUTING_PREFIX . '/register' , 'AuthController@register');
Router::post( ROUTING_PREFIX . '/register' , 'AuthController@handleRegister');
Router::post( ROUTING_PREFIX . '/logout' , 'AuthController@logout');
Router::get( ROUTING_PREFIX . '/ldap' , 'AuthController@ldap');
Router::post( ROUTING_PREFIX . '/ldap' , 'AuthController@handle_ldap');

// GOOGLE AUTH
Router::get( ROUTING_PREFIX . '/google-add' ,'GoogleAuthController@add' );
Router::post( ROUTING_PREFIX . '/google-add' ,'GoogleAuthController@handle_add' );
Router::get( ROUTING_PREFIX . '/google-login' ,'GoogleAuthController@login' );
Router::post( ROUTING_PREFIX . '/google-check' ,'GoogleAuthController@check' );



// 404
Router::error(function(Request $request, \Exception $exception) {
    return view('core/404.php');
});

Router::start();
