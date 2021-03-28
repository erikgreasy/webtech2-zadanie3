<?php

namespace controller;

use repository\UserRepository;
use repository\LoginRepository;
use model\User;
use model\Login;


class AuthController {

    private $userRepository;
    private $loginRepository;


    public function __construct() {
        $this->userRepository = new UserRepository();
        $this->loginRepository = new LoginRepository();
    }

    
    public function login() {
        if(logged_in()) {
            redirect(BASE_URL);
        }

        // create Client Request to access Google API
        $client = new \Google_Client();
        $client->setClientId(CLIENT_ID);
        $client->setClientSecret(CLIENT_SECRET);
        $client->setRedirectUri(REDIRECT_URI);
        $client->addScope("email");
        $client->addScope("profile");
        // authenticate code from Google OAuth Flow
        if (isset($_GET['code'])) {
            $token = $client->fetchAccessTokenWithAuthCode($_GET['code']);
            $client->setAccessToken($token['access_token']);
            
            // // get profile info
            $google_oauth = new \Google_Service_Oauth2($client);
            $google_account_info = $google_oauth->userinfo->get();
            $email =  $google_account_info->email;
            $full_name =  $google_account_info->name;
            $full_name = explode( ' ', $full_name );
            $name = $full_name[0];
            $surname = $full_name[1];

            $user = $this->userRepository->getByEmail( $email );

            // User not found in DB
            if( !$user ) {
                $user = new User();
                $user->setName($name);
                $user->setSurname($surname);
                $user->setEmail($email);

                $this->userRepository->add( $user );
                
                $user = $this->userRepository->getByEmail( $email );

            }
            $login = new Login();

            $login->setUserId( $user->getId() );
            $login->setType( 'google' );
            $this->loginRepository->add( $login );
            login_user( $user->getId(), $login );

            redirect( BASE_URL );
        }

        return view('auth/login.php', [
            'google_url' => $client->createAuthUrl()
        ]);
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

        $user = $this->userRepository->getByLogin( $login );

        if( $user ) {

            if (password_verify( $password, $user->getPassword() )) {
                // Success!

                
                $_SESSION['ga-uid'] = $user->getId();
                if( $user->getGoogleAuth() == '' ) {
                    return redirect(BASE_URL . '/google-add');
                } else {
                    return redirect(BASE_URL . '/google-login');
                }

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
        if(logged_in()) {
            redirect(BASE_URL);
        }
        
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
            $errors[] = 'Email je povinny';
        }
        $emails = $this->userRepository->getEmails();
        if( in_array( $email, $emails ) ) {
            $errors[] = 'Zadany email uz je obasdeny';
        }

        if( trim($login) == '' ) {
            $errors[] = 'Login je povinny';
        }
        $logins = $this->userRepository->getLogins();
        if( in_array( $login, $logins ) ) {
            $errors[] = 'Zadany login uz je obasdeny';
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

        $user = new User();
        $user->setName( $name );
        $user->setSurname( $surname );
        $user->setEmail( $email );
        $user->setLogin( $login );
        $user->setPassword( $password_encrypted );

        $this->userRepository->add( $user );
        $login = new Login();
        $login->setUserId( $user->getId() );
        $login->setType( 'native' );
        $this->loginRepository->add( $login );
        login_user( $user->getId(), $login );


        return redirect( BASE_URL );
    }

    public function logout() {
        logout_user();
        redirect( BASE_URL );
    }


    public function ldap() {

        return view( 'auth/ldap.php' );
        
    }

    public function handle_ldap() {
        if(logged_in()) {
            redirect(BASE_URL);
        }
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
            return view( 'auth/ldap.php', [
                'errors'    => $errors
            ] );
        }


        // using ldap bind
        $ldapuid  = $login;     // ldap rdn or dn
        $ldappass = $password;  // associated password

        $dn = 'ou=People, DC=stuba, DC=sk';
        $ldaprdn = "uid=$ldapuid, $dn";

        // connect to ldap server
        $ldapconn = ldap_connect("ldap.stuba.sk")
            or die("Could not connect to LDAP server.");

        
        if ($ldapconn) {

            $set = ldap_set_option($ldapconn, LDAP_OPT_PROTOCOL_VERSION, 3);
            // binding to ldap server
            $ldapbind = ldap_bind($ldapconn, $ldaprdn, $ldappass);

            // verify binding
            if( !$ldapbind ) {

                $errors[] = 'Prihlásenie neúspešné. Skúste to prosím ešte raz.';

            } else {
                $results = ldap_search($ldapconn,$dn,"uid=$ldapuid",array("givenname","employeetype","surname","mail","faculty","cn","uisid","uid"),0,5);
                $ldap_user = ldap_get_entries($ldapconn,$results)[0];
                $name = $ldap_user['givenname'][0];
                $surname = $ldap_user['sn'][0];
                $email = $ldap_user['mail'][0];


                $user = $this->userRepository->getByEmail( $email );

                // User not found in DB
                if( !$user ) {
                    $user = new User();
                    $user->setName($name);
                    $user->setSurname($surname);
                    $user->setEmail($email);

                    $this->userRepository->add( $user );
                    
                    $user = $this->userRepository->getByEmail( $email );

                }

                $login = new Login();

                $login->setUserId( $user->getId() );
                $login->setType( 'ldap' );
                $this->loginRepository->add( $login );
                login_user( $user->getId(), $login );

                redirect( BASE_URL );

            }
            
            ldap_unbind($ldapconn);

        }


        // Credentails do not match
        if( !empty( $errors ) ) {
            return view( 'auth/ldap.php', [
                'errors'    => $errors
            ] );
        }

    }    
}