<?php

require_once 'inc/Database.php';

class DashboardController {

    private $conn;

    public function __construct() {
        $db = new Database();
        $this->conn = $db->getConnection();
    }

    public function show() {
        if( !logged_in() ) {
            redirect( 'login' );
        }
        return view( 'dashboard.php' );
    }
}