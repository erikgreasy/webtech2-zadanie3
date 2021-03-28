<?php

namespace model;

class User {

    private $id;
    private $name;
    private $surname;
    private $email;
    private $login;
    private $password;
    private $googleAuth;

    public function getId() {
        return $this->id;
    }

    public function getName() {
        return $this->name;
    }

    public function getSurname() {
        return $this->surname;
    }

    public function getEmail() {
        return $this->email;
    }

    public function getLogin() {
        return $this->login;
    }

    public function getFullName() {
        return $this->getName() . ' ' . $this->getSurname();
    }

    public function getPassword() {
        return $this->password;
    }

    public function getGoogleAuth() {
        return $this->googleAuth;
    }

    public function setId( $id ) {
        $this->id = $id;
    }

    public function setName( $name ) {
        $this->name = $name;
    }

    public function setSurname( $surname ) {
        $this->surname = $surname;
    }

    public function setEmail( $email ) {
        $this->email = $email;
    }

    public function setLogin( $login ) {
        $this->login = $login;
    }

    public function setPassword( $password ) {
        $this->password = $password;
    }

    public function setGoogleAuth( $googleAuth ) {
        $this->googleAuth = $googleAuth;
    }

}