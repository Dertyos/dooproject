<?php

class Task {

    private $database;
    private $tasks;

    public function __construct() {
        $this->database = Connection::connect();
        $this->tasks = array();
    }

    public function list() {
        $sql = "SELECT * FROM task";
        if (!$result = $this->database->query($sql)) {
            echo "Sorry, this website is experiencing problems.";
        }

        while ($row = $result->fetch_assoc()) {
            $this->tasks[] = $row;
        }

        return $this->tasks;
    }

    public function insert($name, $description, $priority, $estimated, $status, $backlogId, $sprintId, $developerId) {
        $sql = "INSERT INTO task(name, description, priority, estimated, status, backlogId, sprintId, developerId)
                VALUES('$name', '$description', $priority, $estimated, '$status', $backlogId, $sprintId, $developerId)";

        $this->database->query($sql);
    }

    public function getTaskBacklog($backlogId) {
        $sql = "SELECT * FROM taks
                WHERE backlogId = '$backlogId'";
        $consult = $this->db->query($sql);
        $devObject = $consult->fetch_assoc();
        return $devObject;
    }

    public function getTask($sprintId) {
        $sql = "SELECT * FROM task
                WHERE sprintId = '$sprintId'";
        $consult = $this->db->query($sql);
        $devObject = $consult->fetch_assoc();
        return $devObject;
    }

    public function update($id, $name, $description, $priority, $estimated, $status, $backlogId, $sprintId, $developerId) {
        $sql = "UPDATE task
                SET name = '$name', description = '$description', priority = $priority, estimated = $estimated, status = '$status', backlogId = $backlogId, sprintId = $sprintId, developerId = $developerId
                WHERE id = $id";

        $this->database->query($sql);
    }

    public function delete($id) {
        $sql = "DELETE FROM task
                WHERE id = $id";

        $this->database->query($sql);
    }

}

?>
