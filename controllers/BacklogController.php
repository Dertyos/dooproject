<?php

class BacklogController {

    public function __construct() {
        require_once "models/Backlog.php";
        session_start();
    }

    public function getBacklog($id) {

        $backlogModel = new Backlog();
        $backlog = $backlogModel->getBacklog($id);

    }

    public function store() {
        // Almacena el nuevo backlog
        $name = $_POST['name'];
        $description = $_POST['description'];

        $backlogModel = new Backlog();
        $backlogModel->insert($name, $description);

        // Redirige al índice
        header('Location: index.php?controller=backlog&action=index');
    }

    public function update($id) {
        // Actualiza el backlog
        $name = $_POST['name'];
        $description = $_POST['description'];

        $backlogModel = new Backlog();
        $backlogModel->update($id, $name, $description);

        // Redirige al índice
        header('Location: index.php?controller=backlog&action=index');
    }

    public function delete($id) {
        // Elimina el backlog
        $backlogModel = new Backlog();
        $backlogModel->delete($id);

        // Redirige al índice
        header('Location: index.php?controller=backlog&action=index');
    }
}
?>
