<?php

class TaskController {

    public function __construct() {
        require_once 'models/Task.php';
        require_once 'models/ScrumTeam.php';
        require_once 'models/Developer.php';
        require_once 'models/Sprint.php';
        require_once 'models/Backlog.php';
    }

    public function index() {
        $task = new Task();
        $data['tasks'] = $task->list();
        $data['title'] = "Tasks";
        require_once "views/tasks/index.php";
    }

    public function insert() {
        $developer = new Developer();
        $scrumTeam = new ScrumTeam();
        $sprint = new Sprint();
        $backlog = new Backlog();

        $data['developers'] = $developer->list();
        $data['scrumTeams'] = $scrumTeam->list();
        $data['title'] = "New Task";

        // Determinar el contexto de la inserción basado en parámetros GET
        $data['context'] = $this->determineInsertContext($_GET);

        require_once "views/tasks/insert.php";
    }

    private function determineInsertContext($params) {
        $context = ['scrumTeamId' => null, 'sprintId' => null, 'backlogId' => null, 'developerId' => null];

        if (isset($params['scrumTeamId'])) {
            $context['scrumTeamId'] = $params['scrumTeamId'];
        }
        if (isset($params['sprintId'])) {
            $context['sprintId'] = $params['sprintId'];
            $sprint = new Sprint();
            $sprint =$sprint->getSprintById($params['sprintId']);
            $context['scrumTeamId'] = $sprint['scrumTeamId'];   
        }
        if (isset($params['backlogId'])) {
            $context['backlogId'] = $params['backlogId'];
            $backlog = new Backlog();
            $backlog = $backlog->getBacklogById($params['backlogId']);
            $context['scrumTeamId'] = $backlog['scrumTeamId'];
        }
        if (isset($params['developerId'])) {
            $context['developerId'] = $params['developerId'];
            $developer = new Developer();
            Sdeveloper = $developer->getDeveloperById($params['developerId']);
            $context['scrumTeamId'] = $developer['scrumTeamId']

        }

        return $context;
    }

    public function store() {
        $name = $_POST['name'];
        $description = $_POST['description'];
        $priority = $_POST['priority'];
        $estimatedTime = $_POST['estimatedTime'];
        $status = $_POST['status'];
        $idBacklog = $_POST['idBacklog'] ?? null;
        $idSprint = $_POST['idSprint'] ?? null;
        $idDeveloper = $_POST['idDeveloper'] ?? null;
        $idScrumTeam = $_POST['idScrumTeam'];

        $task = new Task();
        $task->insert($name, $description, $priority, $estimatedTime, $status, $idBacklog, $idSprint, $idDeveloper, $idScrumTeam);

        $this->index();
    }

    public function view($id) {
        $task = new Task();
        $data['title'] = "Task Details";
        $data['task'] = $task->getTask($id);
        require_once "views/tasks/view.php";
    }

    public function edit($id) {
        $task = new Task();
        $data['id'] = $id;
        $data['task'] = $task->getTask($id);
        $data['title'] = "Edit Task";
        require_once "views/tasks/edit.php";
    }

    public function update() {
        $id = $_POST['id'];
        $name = $_POST['name'];
        $description = $_POST['description'];
        $priority = $_POST['priority'];
        $estimatedTime = $_POST['estimatedTime'];
        $status = $_POST['status'];
        $idBacklog = $_POST['idBacklog'] ?? null;
        $idSprint = $_POST['idSprint'] ?? null;
        $idDeveloper = $_POST['idDeveloper'] ?? null;
        $idScrumTeam = $_POST['idScrumTeam'];

        $task = new Task();
        $task->update($id, $name, $description, $priority, $estimatedTime, $status, $idBacklog, $idSprint, $idDeveloper, $idScrumTeam);

        $this->index();
    }

    public function delete($id) {
        $task = new Task();
        $task->delete($id);
        $this->index();
    }
}

?>
