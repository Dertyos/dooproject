<?php

class developerController {

    public function __construct() {
        require_once "models/Developer.php";
        session_start();
    }

    public function register() {
        
        $name = $_POST['name'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $rol = $_POST['rol'];
        $scrumTeamId = $_POST['scrumTeamId']; 
        $documentNumber = $_POST['documentNumber'];
        $password = $_POST['password'];


        $developer = new Developer();
        $developer->store($name, $email, $phone, $rol, $scrumTeamId, $documentNumber, $password);

        // Redirect to login
        header('Location: index.php?controller=developer&action=seeLogin');
    }

    public function seeLogin() {
        $data['title'] = "Login";
        require_once "views/devs/login.php";
    }

    public function seeRegister() {
        $data['title'] = "developer registration";
        require_once "views/devs/register.php";
    }

    public function login() {
        $documentNumber = $_POST['documentNumber'];
        $password = $_POST['password'];

        $developerModel = new Developer();
        $developer = $developerModel->getDeveloper($documentNumber);

        // var_dump($developer);

        if($developer == null) {
            $data['title'] = "Login";
            $data['error'] = "There is no developer with that document number";
            require_once "views/devs/login.php";
        } else {
            // Verify the password
            if(password_verify($password, $developer['password'])) {
                $_SESSION["documentNumber"] = $developer['documentNumber'];
                header("Location: index.php");
            } else {
                $data['title'] = "Login";
                $data['error'] = "Incorrect password";
                require_once "views/devs/login.php";
            }
        }
    }

    public function logout() {
        unset($_SESSION['documentNumber']);
        header('Location: index.php?controller=developer&action=seeLogin');
    }

}


?>
