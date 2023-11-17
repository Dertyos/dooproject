<?php

class BacklogController {
    
    public function __construct() {
        require_once "models/Backlog.php";
        require_once "models/ScrumTeam.php";
        require_once "models/Task.php";
        session_start();
    }

    public function index() {

        $backlog = new Backlog();
        $data['backlogs'] = $backlog->list();
        $data['titulo'] = "Backlog";
        // Cargar la vista
        require_once "views/Backlog/index.php";
    }

    public function show($scrumTeamId) {
        $backlog = new Backlog();
        $backlog = $backlog->getBacklog($scrumTeamId);
        $tasks = new Task();
        
        $tasks = $tasks->getBacklogTasks($backlog['id']);
        
    }

    public function store() {
        // Almacena el nuevo backlog
        $scrumTeamId = $_POST['scrumTeamId'];

        $backlogModel = new Backlog();
        $backlogModel->insert($scrumTeamId);

        // Redirige al índice
        header('Location: index.php?controller=scrumteam&action=index');
    }
}
?>
