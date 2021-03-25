<?php


class User {

    private $id;
    private $name;
    private $surname;
    private $email;
    private $login;
    private $password;

    public function getName() {
        return $this->name;
    }

}