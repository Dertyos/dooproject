<?php

class Backlog {

    private $db;
    private $backlogs;

    public function __construct() {
        $this->db = Connection::connect();
        $this->backlogs = array();
    }

    public function insert($scrumTeamId) {
        $sql = "INSERT INTO backlog(scrumTeamId) VALUES($scrumTeamId)";
        $this->db->query($sql);
        $backlogId = $this->db->insert_id;
        return $this->getBacklogById($backlogId);
    }

    public function getBacklog($scrumTeamId) {
        $sql = "SELECT * FROM backlog WHERE scrumTeamId = $scrumTeamId";
        $result = $this->db->query($sql);
        $record = $result->fetch_assoc();
        return $record;
    }
    public function getBacklogById($id) {
        $sql = "SELECT * FROM backlog WHERE id = $id";
        if ($id === null || !is_numeric($id)) {
            return null;
        }
        $result = $this->db->query($sql);
        $record = $result->fetch_assoc();
        return $record;
    }

    public function list() {
        $sql = "SELECT * FROM backlog";
        if(!$result = $this->db->query($sql)) {
            echo "We are sorry, but the website is having problems.";
        }

        while($row = $result->fetch_assoc()) {
            $this->backlogs[] = $row;
        }

        return $this->backlogs;
    }
}

?>