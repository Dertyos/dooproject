<?php

class ScrumTeam {

    private $db;
    private $scrumTeams;

    public function __construct() {
        $this->db = connection::connect();
        $this->scrumTeams = array();
    }

    public function list() {
        $sql = "SELECT * FROM scrumteam";
        if (!$result = $this->db->query($sql)) {

            echo "We are sorry, this website is havingproblems.";
        }

        while ($row = $result->fetch_assoc()) {
            $this->scrumTeams[] = $row;
        }

        return $this->scrumTeams;
    }

    public function insert($name, $description, $workTime) {
        $sql = "INSERT INTO scrumteam(name, description, workTime) VALUES('$name', '$description', '$workTime')";
        $this->db->query($sql);
        $scrumTeamId = $this->db->insert_id;
        return $this->getScrumTeam($scrumTeamId);
    }

    public function getScrumTeam($id) {
        $sql = "SELECT * FROM scrumteam WHERE id = $id";
        $result = $this->db->query($sql);
        $register = $result->fetch_assoc();
        return $register;
    }

    public function update($id, $name, $description, $workTime) {
        $sql = "UPDATE scrumteam SET name = '$name', description = '$description', workTime = '$workTime' WHERE id = $id";
        $this->db->query($sql);
    }

    public function delete($id) {
        $sql = "DELETE FROM scrumteam WHERE id = $id";
        $this->db->query($sql);
    }

}
?>