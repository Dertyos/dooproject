<?php

class DeveloperController
{
    public function __construct()
    {
        require_once "models/Developer.php";
        require_once 'models/ScrumTeam.php';
        require_once 'models/Task.php';
    }

    public function index()
    {
        session_status() == PHP_SESSION_NONE ? session_start() : null;

        if (isset($_SESSION['documentNumber'])) {
            $developer = new Developer();
            $data['developers'] = $developer->list();
            $data['title'] = "Developers";

            require_once "views/devs/index.php";
            exit;
        } else {
            $_SESSION['error'] = 'You do not have access. Please log in.';
            header('Location: index.php?controller=developer&action=login');
            exit;
        }

    }

    public function store()
    {
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
        $developer->insert($name, $email, $phone, $rol, $scrumTeamId, $documentNumber, $password);

        header('Location: index.php?controller=developer&action=seeLogin');
    }

    public function insert()
    {
        $developer = new Developer();
        $scrumTeam = new ScrumTeam();
        $data['developers'] = $developer->list();
        $data['scrumTeams'] = $scrumTeam->list();
        $data['title'] = "New Developer";
        // Cargar la vista
        require_once "views/devs/insert.php";
    }

    public function seeLogin()
    {
        $data['title'] = "Login";
        require_once "views/devs/login.php";
    }

    public function login()
    {
        session_start();

        $data = [];


        if (isset($_POST['documentNumber']) && isset($_POST['password'])) {
            $documentNumber = $_POST['documentNumber'];
            $password = $_POST['password'];

            $developerModel = new Developer();
            $developer = $developerModel->getDeveloper($documentNumber);

            if ($developer == null) {
                $data['title'] = "Login";
                $data['error'] = "There is no developer with that document number";
            } else {
                // Verificar la contraseña
                if (password_verify($password, $developer['password'])) {
                    $_SESSION["documentNumber"] = $developer['documentNumber'];
                    header('Location: index.php?controller=developer&action=index');
                    exit; // Importante para prevenir más ejecución de código después de la redirección
                } else {
                    $data['title'] = "Login";
                    $data['error'] = "Incorrect password";
                    echo "No hay una sesión activa con 'documentNumber'";
                }
            }
        } else {
            $data['title'] = "Login";
            $data['error'] = "Document number and password are required.";
        }

        // Mostrar la vista de login
        require_once "views/devs/login.php";
    }


    public function logout()
    {
        session_start(); 

        if (isset($_SESSION['documentNumber'])) {
            unset($_SESSION['documentNumber']);
        }

        session_destroy();
        header('Location: index.php?controller=developer&action=login'); 
        exit; // Detiene la ejecución del script después de la redirección
    }

    public function delete($id)
    {
        $developer = new Developer();
        $developer->delete($id);
        $this->index();
    }

    public function edit($id)
    {
        $developer = new Developer();
        $scrumTeam = new ScrumTeam();
        $data['id'] = $id;
        $data['developer'] = $developer->getDeveloperById($id);
        $data['scrumTeams'] = $scrumTeam->list();
        $data['title'] = "Update Scrum Team";
        require_once "views/devs/edit.php";
    }

    public function update()
    {
        $id = $_POST['id'];
        $developer = new Developer();

        $fields = [
            'name' => $_POST['name'] ?? null,
            'email' => $_POST['email'] ?? null,
            'phone' => $_POST['phone'] ?? null,
            'rol' => $_POST['rol'] ?? null,
            'scrumTeamId' => $_POST['scrumTeamId'] ?? null,
            'documentNumber' => $_POST['documentNumber'] ?? null,
            'password' => $_POST['password'] ?? null,
        ];

        $developer->update($id, $fields);
        $this->index();
    }

    public function view($id)
    {
        $developer = new Developer();
        $tasks = new Task();

        $data['developer'] = $developer->getDeveloperById($id);
        $data['developerTasks'] = $tasks->getDeveloperTasks($id);
        // $data['timeNeeded'] = $tasks->calculateTotalEstimatedTime($data['developerTasks']);
        $data['title'] = "Developer Details";

        require_once "views/devs/view.php";
    }
}



?>