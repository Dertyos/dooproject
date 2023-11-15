<?php

class Task {

    private $db;
    private $tasks;

    public function __construct() {
        $this->db = Connection::connect();
        $this->tasks = array();
    }

    public function list() {
        $sql = "SELECT * FROM task";
        if (!$result = $this->db->query($sql)) {
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

        $this->db->query($sql);
    }

    public function getBacklogTasks($backlogId) {
        $sql = "SELECT * FROM task
                WHERE backlogId = '$backlogId'";
        $consult = $this->db->query($sql);
        $devObject = $consult->fetch_assoc();
        return $devObject;
    }

    public function getDeveloperTasks($developerId) {
        $sql = "SELECT * FROM task WHERE developerId = '$developerId'";
        $consult = $this->db->query($sql);
        
        $tasks = [];
        while ($row = $consult->fetch_assoc()) {
            $tasks[] = $row;
        }
        return $tasks;
    }

    public function getTasksSprint($sprintId) {
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

        $this->db->query($sql);
    }

    public function delete($id) {
        $sql = "DELETE FROM task
                WHERE id = $id";

        $this->db->query($sql);
    }

}

?>
