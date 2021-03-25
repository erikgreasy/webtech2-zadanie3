<?php

require_once 'inc/Database.php';

class AuthController {

    private $conn;

    public function __construct() {
        $db = new Database();
        $this->conn = $db->getConnection();
    }

    
    public function login() {
        return view('auth/login.php');
    }


    public function handle_login() {
        $errors = [];

        $login = $_POST['login'];
        $password = $_POST['password'];

        if( trim($login) == '' ) {
            $errors[] = 'Prazdny login';
        }
        
        if( trim($password) == '' ) {
            $errors[] = 'Prazdne heslo';
        }

        if( !empty( $errors ) ) {
            return view( 'auth/login.php', [
                'errors'    => $errors
            ] );
        }

        $stmt = $this->conn->prepare( "SELECT * FROM users WHERE login = :login" );
        $stmt->execute([
            'login' => $login
        ]);

        $result = $stmt->fetch( PDO::FETCH_OBJ );

        if( $result ) {

            if (password_verify( $password, $result->password)) {
                // Success!
                $_SESSION['login'] = 'abc';

                return redirect(BASE_URL);

            }else {
                // Invalid credentials
                $errors[] = 'Zle heslo';
            }

            
        } else {
            $errors[] = 'Neplatny login';
        }

        return view( 'auth/login.php', [
            'errors'    => $errors
        ] );

    }


    public function register() {
        return view('auth/register.php');
    }

    public function handleRegister() {
        $errors = [];

        $name = $_POST['name'];
        $surname = $_POST['surname'];
        $email = $_POST['email'];
        $login = $_POST['login'];
        $password = $_POST['password'];
        $confirm_password = $_POST['confirm_password'];

        if( trim($name) == '' ) {
            $errors[] = 'Meno je povinne';
        }

        if( trim($surname) == '' ) {
            $errors[] = 'Priezvisko je povinne';
        }

        if( trim($email) == '' ) {
            $errors[] = 'Email je povinne';
        }

        if( trim($login) == '' ) {
            $errors[] = 'Login je povinny';
        }

        if( $password == '' ) {
            $errors[] = 'Heslo je povinne';
        } else if( $password != $confirm_password ) {
            $errors[] = 'Hesla sa nezhoduju';
        }

        if( !empty( $errors ) ) {
            return view( 'auth/register.php', [
                'errors'    => $errors
            ] );
        }


        $password_encrypted = password_hash($password, PASSWORD_BCRYPT);

        $sql = "INSERT INTO users (name, surname, email, login, password) VALUES(:name, :surname, :email, :login, :password)";
        $stmt = $this->conn->prepare( $sql );
        $result = $stmt->execute([
            'name'  => $name,
            'surname'   => $surname,
            'email'     => $email,
            'login'     => $login,
            'password'  => $password_encrypted
        ]);

        return redirect( BASE_URL );
    }

    public function logout() {
        session_destroy();
        redirect( BASE_URL );
    }
}