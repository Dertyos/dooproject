<?php

class SprintController {

    public function __construct() {
        require_once "models/Sprint.php";
        session_start();
    }

    public function index() {

        // if(isset($_SESSION['documentNumber'])) {
            $task = new Task();
            $data['tasks'] = $task->list();
            $data['title'] = "Task";
            // Cargar la vista
            require_once "views/sprint/index.php";
        // } else {
        //     echo "<p>You do not have access</p>";
        // }

    }

    public function show($scrumTeamId) {
        $sprintModel = new Sprint();
        $sprint = $sprintModel->getSprint($scrumTeamId);
        
        $tasks = $sprintModel->getSprintTasks($id);
        
    }

    public function insert() {
        $data['title'] = "Create Sprint";
        // Cargar la vista
        require_once "views/sprint/insert.php";
    }

    public function store() {
        // Lógica para almacenar el nuevo sprint en la base de datos
        $name = $_POST['name'];
        $description = $_POST['description'];
        $startDate = $_POST['startDate'];
        $endDate = $_POST['endDate'];

        $sprintModel = new Sprint();
        $sprintModel->insert($name, $description, $startDate, $endDate);

        // Después de almacenar el sprint, podrías redirigir a la lista de sprints
        header('Location: index.php?controller=sprint&action=list');
    }

    public function edit($id) {
        $sprintModel = new Sprint();
        $sprint = $sprintModel->getSprint($id);
        require_once "views/scrumTeams/edit.php";
    }

    public function update($id) {
        $name = $_POST['name'];
        $description = $_POST['description'];
        $startDate = $_POST['startDate'];
        $endDate = $_POST['endDate'];

        $sprintModel = new Sprint();
        $sprintModel->update($id, $name, $description, $startDate, $endDate);

        header('Location: index.php?controller=sprint&action=list');
    }

    public function delete($id) {
        // Lógica para eliminar el sprint de la base de datos
        $sprintModel = new Sprint();
        $sprintModel->delete($id);

        // Después de eliminar el sprint, podrías redirigir a la lista de sprints
        header('Location: index.php?controller=sprint&action=list');
    }

    public function moveTask($taskId, $sprintId) {
        // Lógica para mover una tarea de un sprint a otro
        $sprintModel = new Sprint();
        $sprintModel->moveTaskToSprint($taskId, $sprintId);

        // Después de mover la tarea, podrías redirigir a la vista del sprint actualizado
        header("Location: index.php?controller=sprint&action=show&id=$sprintId");
    }

}
