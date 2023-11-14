<?php

class ScrumTeamController {

    public function __construct() {
        require_once 'models/ScrumTeam.php';
    }

    public function index() {

        if(isset($_SESSION['documentNumber'])) {
            $scrumTeam = new ScrumTeam();
            $data['scrumTeams'] = $scrumTeam->list();
            $data['title'] = "ScrumTeam";
            // Cargar la vista
            require_once "views/scrumTeams/index.php";
        } else {
            echo "<p>You do not have access</p>";
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

        // Guardando el registro
        $scrumTeam = new ScrumTeam();
        $scrumTeam->insert($name, $description);

        // Enviar a la vista del index
        $this->index();

    }

    // Visualizar la información de un registro
    public function view($id) {
        $scrumTeam = new ScrumTeam();
        $data['title'] = "ScrumTeam details";
        $data['scrumTeam'] = $scrumTeam->getScrumTeam($id);
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

}

?>