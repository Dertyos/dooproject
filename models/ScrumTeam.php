<?php

class ScrumTeam {

    private $db;
    private $scrumTeams;

    public function __construct() {
        $this->db = connection::connect();
        $this->scrumTeams = array();
    }

    public function list() {
        // $sql = "SELECT * FROM scrum_team";
        $sql = "SELECT * FROM scrumteam";
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
        $sql = "INSERT INTO scrumteam(name, description) VALUES('$name', '$description')";
        $this->db->query($sql);
    }

    public function getScrumTeam($id) {
        $sql = "SELECT * FROM scrumteam WHERE id = $id";
        $result = $this->db->query($sql);
        $register = $result->fetch_assoc();
        return $register;
    }

    public function update($id, $name, $description) {
        $sql = "UPDATE scrumteam SET name = '$name', description = '$description' WHERE id = $id";
        $this->db->query($sql);
    }

    public function delete($id) {
        $sql = "DELETE FROM scrumteam WHERE id = $id";
        $this->db->query($sql);
    }

}
?>