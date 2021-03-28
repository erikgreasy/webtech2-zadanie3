<?php

namespace repository;

use inc\Database;
use model\User;


class UserRepository {

    private $conn;

    public function __construct() {
        $db = new Database();
        $this->conn = $db->getConnection();
    }

    public function getUser( $id ) {
        $sql = "SELECT * FROM users WHERE id = :id";
        $stmt = $this->conn->prepare( $sql );
        $stmt->setFetchMode( \PDO::FETCH_CLASS, User::class );
        $stmt->execute([
            'id'    => $id,
        ]);

        return $stmt->fetch();
    }

    public function getByLogin( $login ) {
        $sql = "SELECT * FROM users WHERE login = :login";
        $stmt = $this->conn->prepare( $sql );
        $stmt->setFetchMode( \PDO::FETCH_CLASS, User::class );
        $stmt->execute([
            'login'    => $login,
        ]);

        $user = $stmt->fetch();

        return $user;
    }

    public function getByEmail( $email ) {
        $sql = "SELECT * FROM users WHERE email = :email";
        $stmt = $this->conn->prepare( $sql );
        $stmt->setFetchMode( \PDO::FETCH_CLASS, User::class );
        $stmt->execute([
            'email'    => $email,
        ]);

        $user = $stmt->fetch();

        return $user;
    }

    public function add( User $user ) {
        $sql = "INSERT INTO users (name, surname, email, login, password) VALUES(:name, :surname, :email, :login, :password)";
        $stmt = $this->conn->prepare( $sql );
        
        $result = $stmt->execute([
            'name'      => $user->getName(),
            'surname'   => $user->getSurname(),
            'email'     => $user->getEmail(),
            'login'     => $user->getLogin(),
            'password'  => $user->getPassword()
        ]);

        $user->setId( $this->conn->lastInsertId() );

        if( $result ) {
            return $user->getId();
        } else {
            return false;
        }
    }



    public function update( User $user ) {
        $new_user = $this->getUser( $user->getId() );
        $sql = "UPDATE users SET name = :name, surname = :surname, login = :login, email = :email, password = :password, googleAuth = :googleAuth WHERE id = :id";
        $stmt = $this->conn->prepare( $sql );
        $result = $stmt->execute([
            'id'    => $user->getId(),
            'name'  => $user->getName(),
            'surname'   => $user->getSurname(),
            'login' => $user->getLogin(),
            'email' => $user->getEmail(),
            'password'  => $user->getPassword(),
            'googleAuth'   => $user->getGoogleAuth()
        ]);

        return $result;
        
    }

    public function addSecret( $user_id, $secret ) {
        $user = $this->getUser( $user_id );
        $user->setGoogleAuth( $secret );
        return $this->update( $user );
    }
}