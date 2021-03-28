<?php

namespace model;

class Auth {

    private static $instance;

    public static function getInstance() {
        if (!Auth::$instance instanceof self) {
             Auth::$instance = new self();
        }
        return Auth::$instance;
    }

    public static function login( User $user ) {
        $_SESSION['user_id'] = $user->getId();
    }
}