<?php

class ScrumTeamController {

    public function __construct() {
        require_once 'models/ScrumTeam.php';
        require_once 'models/Sprint.php';
        require_once 'models/Task.php';
        require_once 'models/Backlog.php';
    }

    public function index() {
        session_status() == PHP_SESSION_NONE ? session_start() : null;
        if(isset($_SESSION['documentNumber'])) {
            $scrumTeam = new ScrumTeam();
            $data['scrumTeams'] = $scrumTeam->list();
            $data['title'] = "ScrumTeam";

            require_once "views/scrumTeams/index.php";
            exit;
        } else {
            $_SESSION['error'] = 'You do not have access. Please log in.';
            header('Location: index.php?controller=audeveloperth&action=login');
            exit;
        }

    }

    // Mostrar la vista para crear un nuevo registro (ScrumTeam)
    public function insert() {
        $data['title'] = "Create ScrumTeam";
        // Cargar la vista
        require_once "views/scrumTeams/insert.php";
    }

    // Guardar el registo
    public function store() {
        // Recibir los datos del formulario
        $name = $_POST['name'];
        $description = $_POST['description'];
        $workTime = $_POST['workTime'];
    
        // Guardando el registro del ScrumTeam
        $scrumTeam = new ScrumTeam();
        $scrumTeamId = $scrumTeam->insert($name, $description, $workTime);
    
        // Comprobar si el ScrumTeam se ha creado correctamente y obtener el ID
        if ($scrumTeamId) {
            // Crear un Backlog asociado al ScrumTeam
            $backlog = new Backlog();
            $backlogInserted = $backlog->insert($scrumTeamId);
            if (!$backlogInserted) {
                // Manejar el error al insertar el Backlog
                $_SESSION['error'] = 'There was an error creating the backlog.';
            }
        } else {
            // Manejar el error al insertar el ScrumTeam
            $_SESSION['error'] = 'There was an error creating the ScrumTeam.';
        }

        $this->index();
    }

    // Visualizar la información de un registro
    public function view($id) {
        $scrumTeam = new ScrumTeam();
        $sprint = new Sprint();
        $data['scrumTeam'] = $scrumTeam->getScrumTeam($id);
        $data['sprints'] = $sprint->list();
        $data['scrumTeamSprints'] = [];

        foreach ($data['sprints'] as $sprint) {
            if ($sprint['scrumTeamId'] == $data['scrumTeam']['id']) {
                $data['scrumTeamSprints'][] = $sprint;
            }
        }

        $backlog = new Backlog();
        $tasks = new Task();
        $data['scrumTeamTET'] = $tasks->scrumTeamTET($data['scrumTeam']['id']);
        $data['backlog'] = $backlog->getBacklog($id);
        $data['backlogtask'] = $tasks->getBacklogTasks($data['backlog']['id']);

        foreach ($data['sprints'] as $sprint) {
            $data['sprintTasks'][$sprint['id']] = $tasks->getTasksSprint($sprint['id']);
        }
        $data['title'] = "ScrumTeam Details";

        require_once "views/scrumTeams/view.php";
    }

    // Mostrar la vista para actualizar un registro (scrumTeam)
    public function edit($id) {
        $scrumTeam = new ScrumTeam();
        $data['id'] = $id;
        $data['scrumTeam'] = $scrumTeam->getScrumTeam($id);
        $data['title'] = "update ScrumTeam";
        require_once "views/scrumTeams/edit.php";
    }

    // Actualizar el registro
    public function update() {
        $id = $_POST['id'];
        $name = $_POST['name'];
        $description = $_POST['description'];

        $scrumTeam = new ScrumTeam();
        $scrumTeam->update($id, $name, $description);
        $this->index();
    }

    // Elimina un scrumTeam
    public function delete($id) {
        $scrumTeam = new ScrumTeam();
        $scrumTeam->delete($id);
        $this->index();
    }

    public function getTasksBacklog($id) {
        $backlog = new Backlog();
        $tasks = new Task();
        $data['backlog'] = $backlog->getBacklog($id);
        $data['task'] = $tasks->getBacklogTasks($data['backlog']['id']);
        return $data;
    }

    public function getTasksSprint($id) {
        $sprint = new Sprint();
        $tasks = new Task();
        $data['sprint'] = $sprint->getSprint($id);
        $data['task'] = $tasks->getTasksSprint($data['sprint']['id']);
        return $data;
    }
}

?>