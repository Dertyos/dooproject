<?php

class SprintController
{

    public function __construct()
    {
        require_once "models/Sprint.php";
        require_once "models/Task.php";
        require_once "models/Developer.php";
        require_once "models/ScrumTeam.php";
    }

    public function index()
    {
        session_status() == PHP_SESSION_NONE ? session_start() : null;
        if (isset($_SESSION['documentNumber'])) {
            $sprint = new Sprint();
            $data['sprintTasks'] = $sprint->sprintTasks();
            $data['title'] = "Sprints";
            require_once "views/sprint/index.php";
            exit;
        } else {
            $_SESSION['error'] = 'You do not have access. Please log in.';
            header('Location: index.php?controller=developer&action=login');
            exit;
        }
    }



    public function insert()
    {
        $scrumTeam = new ScrumTeam();
        $data['scrumTeams'] = $scrumTeam->list();
        $data['title'] = "Create Sprint";

        require_once "views/sprint/insert.php";
    }

    public function store()
    {
        // Lógica para almacenar el nuevo sprint en la base de datos
        $name = $_POST['name'];
        $description = $_POST['description'];
        $startDate = $_POST['startDate'];
        $endDate = $_POST['endDate'];
        $scrumTeamId = $_POST['scrumTeamId'];

        $sprintModel = new Sprint();
        $sprintModel->insert($name, $description, $startDate, $endDate, $scrumTeamId);

        // Después de almacenar el sprint, podrías redirigir a la lista de sprints
        header('Location: index.php?controller=sprint&action=index');
    }

    public function edit($id)
    {
        $sprint = new Sprint();
        $data['id'] = $id;
        $data['sprint'] = $sprint->getSprintById($id);
        $data['title'] = "update sprint";
        require_once "views/sprint/edit.php";
    }

    public function update()
    {
        $id = $_POST['id'];
        $name = $_POST['name'];
        $description = $_POST['description'];
        $startDate = $_POST['startDate'];
        $endDate = $_POST['endDate'];
        $scrumTeamId = $_POST['scrumTeamId'];

        $sprintModel = new Sprint();
        $sprintModel->update($id, $name, $description, $startDate, $endDate, $scrumTeamId);

        $this->index();
    }

    public function delete($id)
    {
        $sprint = new Sprint();
        $sprint->delete($id);
        $this->index();
    }

    public function view($id)
    {
        $sprint = new Sprint();
        $tasks = new Task();
        $scrumTeam = new ScrumTeam();
        $developers = new Developer();

        $data['developers'] = $developers->list();
        $data['sprint'] = $sprint->getSprintById($id);
        $data['scrumTeam'] = $scrumTeam->getScrumTeam($data['sprint']['scrumTeamId']);
        $data['sprintTasks'] = $tasks->getTasksSprint($id);
        $data['sprintDevelopers'] = $developers->getScrumTeamDevelopers($data['scrumTeam']['id']);
        foreach ($data['sprintTasks'] as $task) {
            $data['developer'][$task['id']] = $developers->getDeveloperById($task['developerId']);
        }
        $data['title'] = "Sprint Details";

        // Cálculo para el gráfico burndown
        $taskTime = 0;
        if (isset($sprintTasks) && is_array($sprintTasks)) {
            foreach ($sprintTasks as $task) {
                if ($task['status'] != "completed") {
                    $taskTime += $task['estimatedTime'];
                }
            }
        }
        $task = new Task();
        $data['taskTime'] = $taskTime;
        $data['sprintDuration'] = $sprint->sprintDuration($id);
        
        require_once "views/sprint/view.php";
    }


    public function updateAction()
    {
        $id = $_POST['id'];
        $action = $_POST['action'];
        $sprint = new Sprint();

        switch ($action) {
            case 'updateStartDate':
                $startDate = $_POST['startDate'];
                $sprint->updateStartDate($id, $startDate);
                break;
            case 'updateEndDate':
                $endDate = $_POST['endDate'];
                $sprint->updateEndDate($id, $endDate);
                break;
            case 'updateDescription':
                $description = $_POST['description'];
                $sprint->updateDescription($id, $description);
                break;
        }

        header('Location: index.php?controller=task&action=index');
        exit;
    }
}
// public function moveTask($taskId, $sprintId)
// {
//     // Lógica para mover una tarea de un sprint a otro
//     $sprintModel = new Sprint();
//     $sprintModel->moveTaskToSprint($taskId, $sprintId);

//     // Después de mover la tarea, podrías redirigir a la vista del sprint actualizado
//     $this->index();
// }


