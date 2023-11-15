<?php

class Backlog {

    private $db;
    private $backlogs;

    public function __construct() {
        $this->db = Connection::connect();
        $this->backlogs = array();
    }

    public function insert($scrumTeamId) {
        $sql = "INSERT INTO backlog(scrumTeamId)
                VALUES(scrumTeamId)";
        $this->db->query($sql);
    }

    public function getBacklog($scrumTeamId) {
        $sql = "SELECT * FROM backlog WHERE scrumTeamId = $scrumTeamId";
        $result = $this->db->query($sql);
        $record = $result->fetch_assoc();
        return $record;
    }


}

?>