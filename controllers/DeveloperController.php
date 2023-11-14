<?php

class DeveloperController {

    public function __construct() {
        require_once "models/Developer.php";
        require_once 'models/ScrumTeam.php';
    }

    public function store() {
        // Recibir los datos del formulario
        $name = $_POST['name'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $rol = $_POST['rol'];
        $scrumTeamId = $_POST['scrumTeamId'];
        $documentNumber = $_POST['documentNumber']; 
        $password = $_POST['password']; 
        
    // Guardando el registro
        $developer = new Developer();
        $developer->insert($name, $email, $phone, $rol, $scrumTeamId, $documentNumber, $password );

    // Enviar a la vista del index
    header('Location: index.php?controller=developer&action=seeLogin');
    }

    public function insert() {
        $developer = new Developer();
        $scrumTeam = new ScrumTeam();
        $data['developers'] = $developer->list();
        $data['scrumTeams'] = $scrumTeam->list();
        $data['title'] = "New Developer";
        // Cargar la vista
        require_once "views/devs/insert.php";
    }   

    public function seeLogin() {
        $data['title'] = "Login";
        require_once "views/devs/login.php";
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
                echo "La sesión está activa con el número de documento: " . $_SESSION['documentNumber'];
            } else {
                $data['title'] = "Login";
                $data['error'] = "Incorrect password";
                require_once "views/devs/login.php";
                echo "No hay una sesión activa con 'documentNumber'";
            }
        }
    }

    public function logout() {
        unset($_SESSION['documentNumber']);
        header('Location: index.php?controller=developer&action=seeLogin');
    }

    public function delete($id) {
        $developer = new Developer();
        $developer->delete($id);
        $this->index();
    }

    public function edit($id) {
        $developer = new Developer();
        $scrumTeam = new ScrumTeam();
        $data['id'] = $id;
        $data['scrumTeam'] = $developer->getScrumTeam($id);
        $data['title'] = "Update scrumTeam";
        require_once "views/devs/edit.php";
    }

    public function update() {
        $id = $_POST['id'];
        $name = $_POST['name'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $rol = $_POST['rol'];
        $scrumTeamId = $_POST['scrumTeamId'];
        $documentNumber = $_POST['documentNumber']; 

        $developer = new Developer();
        $developer->update($id, $name, $password);
        $this->index();
    }

}


?>
