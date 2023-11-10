<?php

class UserController {

    public function __construct() {
        require_once "models/User.php";
        session_start();
    }

    public function register() {
        $documentNumber = $_POST['documentNumber'];
        $name = $_POST['name'];
        $email = $_POST['email'];
        $password = $_POST['password'];

        $user = new User();
        $user->store($documentNumber, $name, $email, $password);

        // Redirect to login
        header('Location: index.php?controller=user&action=seeLogin');
    }

    public function seeLogin() {
        $data['title'] = "Login";
        require_once "views/users/login.php";
    }

    public function seeRegister() {
        $data['title'] = "User registration";
        require_once "views/users/register.php";
    }

    public function login() {
        $documentNumber = $_POST['documentNumber'];
        $password = $_POST['password'];

        $userModel = new User();
        $user = $userModel->queryUser($documentNumber);

        // var_dump($user);

        if($user == null) {
            $data['title'] = "Login";
            $data['error'] = "There is no user with that document number";
            require_once "views/users/login.php";
        } else {
            // Verify the password
            if(password_verify($password, $user['password'])) {
                $_SESSION["documentNumber"] = $user['documentNumber'];
                header("Location: index.php");
            } else {
                $data['title'] = "Login";
                $data['error'] = "Incorrect password";
                require_once "views/users/login.php";
            }
        }
    }

    public function logout() {
        unset($_SESSION['documentNumber']);
        header('Location: index.php?controller=user&action=seeLogin');
    }

}


?>
