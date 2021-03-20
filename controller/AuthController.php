<?php

class AuthController {


    public function login() {
        return view('auth/login.php');
    }


    public function register() {
        return view('auth/register.php');
    }
}