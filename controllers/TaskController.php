<?php

class TaskController {

    public function __construct() {
        require_once 'models/Task.php';
    }

    public function index() {

        if(isset($_SESSION['documentNumber'])) {
            $task = new Task();
            $data['tasks'] = $task->list();
            $data['title'] = "Task";
            // Cargar la vista
            require_once "views/tasks/index.php";
        } else {
            echo "<p>You do not have access</p>";
        }

    }

    // Mostrar la vista para crear un nuevo registro (task)
    public function insert() {
        $data['title'] = "Create Task";
        // Cargar la vista
        require_once "views/tasks/insert.php";
    }

    // Guardar el registro
    public function store() {
        // Recibir los datos del formulario
        $name = $_POST['name'];
        $description = $_POST['description'];
        $priority = $_POST['priority'];
        $estimatedTime = $_POST['estimatedTime'];
        $status = $_POST['status'];
        $idBacklog = $_POST['idBacklog'] ?? null; // Puede ser nulo
        $idSprint = $_POST['idSprint'] ?? null; // Puede ser nulo
        $idDeveloper = $_POST['idDeveloper'] ?? null; // Puede ser nulo
        $idScrumTeam = $_POST['idScrumTeam'];

    // Guardando el registro
        $task = new Task();
        $idDeveloper = 

        $task->insert($name, $description, $priority, $estimatedTime, $status, $idBacklog, $idSprint, $idDeveloper, $idScrumTeam);

    // Enviar a la vista del index
        $this->  index();
    }

    // Visualizar la información de un registro
    public function view($id) {
        $task = new Task();
        $data['title'] = "Task's details";
        $data['task'] = $task->getTask($id);
        require_once "views/tasks/view.php";
    }

    // Mostrar la vista para actualizar un registro (task)
    public function edit($id) {
        $task = new Task();
        $data['id'] = $id;
        $data['task'] = $task->getTask($id);
        $data['title'] = "update Task";
        require_once "views/tasks/edit.php";
    }

    // Actualizar el registro
    public function update() {
        $id = $_POST['id'];
        $name = $_POST['name'];
        $description = $_POST['description'];
        $priority = $_POST['priority'];
        $estimatedTime = $_POST['estimatedTime'];
        $status = $_POST['status'];
        $idBacklog = $_POST['idBacklog'] ?? null; // Puede ser nulo
        $idSprint = $_POST['idSprint'] ?? null; // Puede ser nulo
        $idDeveloper = $_POST['idDeveloper'] ?? null; // Puede ser nulo
        $idScrumTeam = $_POST['idScrumTeam'];
    
        $task = new Task();
        $task->update($id, $name, $description, $priority, $estimatedTime, $status, $idBacklog, $idSprint, $idDeveloper, $idScrumTeam);
        $this->index();
    }

    // Elimina un task
    public function delete($id) {
        $task = new Task();
        $task->delete($id);
        $this->index();
    }

}

?>