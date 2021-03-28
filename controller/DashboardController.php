<?php

namespace controller;

use repository\UserRepository;
use repository\LoginRepository;

class DashboardController {

    private $userRepository;
    private $loginRepository;

    public function __construct() {
        $this->userRepository = new UserRepository();
        $this->loginRepository = new LoginRepository();
    }

    public function show() {
        if( !logged_in() ) {
            redirect( 'login' );
        }
        
        $user_id = $_SESSION['user_id'];
        $user = $this->userRepository->getUser( $user_id );

        if( $user ) {
            return view( 'dashboard.php',[
                'user'  => $user
            ] );
        }

        session_destroy();
        redirect( 'login' );
    }

    public function stats() {
        if( !logged_in() ) {
            redirect( BASE_URL . '/login' );
        }

        $user_id = $_SESSION['user_id'];

        $user_logins = $this->loginRepository->userLogins( $user_id );
        $all_logins = $this->loginRepository->all();

        return view( 'login-stats.php',[
            'user_logins'   => $user_logins
        ]);
    }
}