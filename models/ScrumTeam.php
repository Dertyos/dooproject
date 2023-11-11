<?php

class ScrumTeam {

    private $db;
    private $scrumTeams;

    public function __construct() {
        $this->db = Conexion::conectar();
        $this->scrumTeams = array();
    }

    public function list() {
        // $sql = "SELECT * FROM scrum_team";
        $sql = "SELECT * FROM scrum_team";
        if (!$resultado = $this->db->query($sql)) {
            // echo "Lo sentimos, este sitio web está experimentando problemas.";
            echo "We are sorry, this website is experiencing problems.";
        }

        while ($fila = $resultado->fetch_assoc()) {
            $this->scrumTeams[] = $fila;
        }

        return $this->scrumTeams;
    }

    public function insert($name, $description) {
        // $sql = "INSERT INTO scrum_team(nombre, descripcion) VALUES('$nombre', '$descripcion')";
        $sql = "INSERT INTO scrum_team(name, description) VALUES('$name', '$description')";
        $this->db->query($sql);
    }

    public function getScrumTeam($id) {
        // $sql = "SELECT scrum_team.*, developer.name as developerName FROM `scrum_team` JOIN developer ON scrum_team.id = developer.idScrumTeam WHERE scrum_team.id = $id";
        $sql = "SELECT scrum_team.*, developer.name as developerName FROM `scrum_team` JOIN developer ON scrum_team.id = developer.idScrumTeam WHERE scrum_team.id = $id";
        $resultado = $this->db->query($sql);
        $registro = $resultado->fetch_assoc();
        return $registro;
    }

    public function update($id, $name, $description) {
        // $sql = "UPDATE scrum_team SET nombre = '$nombre', descripcion = '$descripcion' WHERE id = $id";
        $sql = "UPDATE scrum_team SET name = '$name', description = '$descripcion' WHERE id = $id";
        $this->db->query($sql);
    }

    public function delete($id) {
        // $sql = "DELETE FROM scrum_team WHERE id = $id";
        $sql = "DELETE FROM scrum_team WHERE id = $id";
        $this->db->query($sql);
    }

}
?>