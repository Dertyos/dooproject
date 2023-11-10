<?php

class Backlog {

    private $db;
    private $backlogs;

    public function __construct() {
        $this->db = Connection::connect();
        $this->backlogs = array();
    }

    public function list() {
        $sql = "SELECT * FROM backlog";
        if (!$result = $this->db->query($sql)) {
            echo "We're sorry, this website is experiencing problems.";
        }

        while ($row = $result->fetch_assoc()) {
            $this->backlogs[] = $row;
        }

        return $this->backlogs;
    }

    public function insert($name, $description) {
        $sql = "INSERT INTO backlog(name, description)
                VALUES('$name', '$description')";

        $this->db->query($sql);
    }

    public function getBacklog($id) {
        $sql = "SELECT * FROM backlog WHERE id = $id";
        $result = $this->db->query($sql);
        $record = $result->fetch_assoc();
        return $record;
    }

    public function update($id, $name, $description) {
        $sql = "UPDATE backlog
                SET name = '$name', description = '$description'
                WHERE id = $id";

        $this->db->query($sql);
    }

    public function delete($id) {
        $sql = "DELETE FROM backlog
                WHERE id = $id";

        $this->db->query($sql);
    }

}

