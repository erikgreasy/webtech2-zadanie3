<?php

namespace repository;

use inc\Database;
use model\User;
use model\Login;


class LoginRepository {

    private $conn;

    public function __construct() {
        $db = new Database();
        $this->conn = $db->getConnection();
    }

    public function all() {
        $sql = "SELECT * FROM logins";
        $stmt = $this->conn->query( $sql );

        $logins = $stmt->fetchAll( \PDO::FETCH_CLASS, Login::class );
        
        return $logins;
    }

    public function userLogins( $user_id ) {
        $sql = "SELECT * FROM logins WHERE user_id = :user_id";
        $stmt = $this->conn->prepare( $sql );

        $stmt->execute([
            'user_id'   => $user_id
        ]);
        $user_logins = $stmt->fetchAll( \PDO::FETCH_CLASS, Login::class );

        return $user_logins;
    }

    public function add( Login $login ) {
        $sql = "INSERT INTO logins (user_id, type) VALUES(:user_id, :type)";
        $stmt = $this->conn->prepare($sql);
        $result = $stmt->execute([
            'user_id'   => $login->getUserId(),
            'type'      => $login->getType(),
        ]);

        return $result;
    }
}