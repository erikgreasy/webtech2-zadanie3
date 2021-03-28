<?php

namespace controller;

use repository\UserRepository;
use repository\LoginRepository;
use model\User;
use model\Login;

class GoogleAuthController {

    private $userRepository;
    private $loginRepository;

    public function __construct() {
        $this->userRepository = new UserRepository();
        $this->loginRepository = new LoginRepository();
    }


    public function login() {
        $user_id = $_SESSION['ga-uid'];
        if( ! $user_id || logged_in() ) {
            redirect( BASE_URL );
        }
        return view( 'auth/google/google-login.php',[
            'user_id'   => $user_id
        ] );
    }


    public function add() {
        $user_id = $_SESSION['ga-uid'];
        if( !$user_id || logged_in() ) {
            redirect( BASE_URL );
        }
        
        $websiteTitle = 'Webtech 2 - Zadanie 3';
        $ga = new \PHPGangsta_GoogleAuthenticator();
        $secret = $ga->createSecret();
        $qrCodeUrl = $ga->getQRCodeGoogleUrl($websiteTitle, $secret);
      
        return view( 'auth/google/google-add.php', [
            'user_id'   => $user_id,
            'qr_url'    => $qrCodeUrl,
            'secret'    => $secret,
        ] );
    }

    public function handle_add() {
        $secret = $_POST['google_secret'];
        $user_id = $_POST['user_id'];

        $this->userRepository->addSecret( $user_id, $secret );


        redirect( 'google-login' );
    }

    public function check() {
        $ga = new \PHPGangsta_GoogleAuthenticator();

        $user_id = $_POST['user_id'];
        $google_code = $_POST['google_code'];
        
        $user = $this->userRepository->getUser( $user_id );

        $secret = $user->getGoogleAuth();

        $checkResult = $ga->verifyCode($secret, $google_code, 2);    // 2 = 2*30sec clock tolerance

        if ($checkResult) {
            $login = new Login();
            $login->setUserId( $user->getId() );
            $login->setType( 'native' );
            $this->loginRepository->add( $login );
            $_SESSION['ga-uid'] = null;
            login_user( $user->getId(), $login );

        } else {
            redirect( 'google-login' );
        }

        redirect( BASE_URL );
    }

    
}