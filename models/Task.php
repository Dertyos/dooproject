<?php

class Task {

    private $db;
    private $tasks;

    public function __construct() {
        $this->db = Connection::connect();
        $this->tasks = array();
    }

    public function list() {
        $sql = "SELECT * FROM task ORDER BY FIELD(priority, 'stat', 'high', 'normal')";
        if (!$result = $this->db->query($sql)) {
            echo "Sorry, this website is experiencing problems.";
        }

        while ($row = $result->fetch_assoc()) {
            $this->tasks[] = $row;
        }

        return $this->tasks;
    }

    public function insert($name, $description, $priority, $estimatedTime, $status, $backlogId, $sprintId, $developerId, $scrumTeamId ) {
        $backlogIdValue = is_null($backlogId) ? 'NULL' : "'$backlogId'";
        $sprintIdValue = is_null($sprintId) ? 'NULL' : "'$sprintId'";
        $developerIdValue = is_null($developerId) ? 'NULL' : "'$developerId'";
    
        $sql = "INSERT INTO task (name, description, priority, estimatedTime, status, backlogId, sprintId, developerId, scrumTeamId)
                VALUES ('$name', '$description', '$priority', $estimatedTime, '$status', $backlogIdValue, $sprintIdValue, $developerIdValue, $scrumTeamId)";
    
        $this->db->query($sql);
    }

    public function getBacklogTasks($backlogId) {
        $sql = "SELECT * FROM task
                WHERE backlogId = '$backlogId'";
        $consult = $this->db->query($sql);
        $tasks = [];
        while ($row = $consult->fetch_assoc()) {
            $tasks[] = $row;
        }
        return $tasks;
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
        $tasks = [];
        while ($row = $consult->fetch_assoc()) {
            $tasks[] = $row;
        }
        return $tasks;
    }

    public function getTask($id) {
        $sql = "SELECT * FROM task
                WHERE id = '$id'";
        $consult = $this->db->query($sql);
        $devObject = $consult->fetch_assoc();
        return $devObject;
    }

    public function update($id, $name, $description, $priority, $estimatedTime, $status, $backlogId, $sprintId, $developerId, $scrumTeamId) {
        $sql = "UPDATE task
                SET name = '$name', description = '$description', priority = $priority, estimatedTime = $estimatedTime, status = '$status', backlogId = $backlogId, sprintId = $sprintId, developerId = $developerId, scrumTeamId = $scrumTeamId
                WHERE id = $id";

        $this->db->query($sql);
    }

    public function updateStatus($id, $status) {
        $sql = "UPDATE task
                SET status = '$status'
                WHERE id = $id";
        $this->db->query($sql);
    }

    public function updatePriority($id, $priority) {
        $sql = "UPDATE task
                SET priority = '$priority'
                WHERE id = $id";
        $this->db->query($sql);
    }
    public function updateEstimatedTime($id, $estimatedTime) {
        $sql = "UPDATE task
                SET estimatedTime = '$estimatedTime'
                WHERE id = $id";
        $this->db->query($sql);
    }

    public function updateDeveloper($id, $developerId){
        $sql = "UPDATE task
                SET developerId = '$developerId'
                WHERE id = $id";
        $this->db->query($sql);
    }

    public function delete($id) {
        $sql = "DELETE FROM task
                WHERE id = $id";

        $this->db->query($sql);
    }

    public function sprintTET($sprintId){
        $sql = "SELECT SUM(estimatedTime) AS totalEstimatedTime FROM task WHERE sprintId = $sprintId AND status = 'pending'";
        $consult = $this->db->query($sql);
        $totalEstimatedTime = $consult->fetch_assoc();
        return $totalEstimatedTime['totalEstimatedTime'];
    }
    
    public function scrumTeamTET($scrumTeamId){
        $sql = "SELECT SUM(estimatedTime) AS totalEstimatedTime FROM task WHERE scrumTeamId = $scrumTeamId AND status = 'pending'";
        $consult = $this->db->query($sql);
        $totalEstimatedTime = $consult->fetch_assoc();
        return $totalEstimatedTime;
    }

    public function developerTET($developerId){
        $sql = "SELECT SUM(estimatedTime) AS totalEstimatedTime FROM task WHERE developerId = $developerId AND status = 'pending'";
        $consult = $this->db->query($sql);
        $totalEstimatedTime = $consult->fetch_assoc();
        return $totalEstimatedTime;
    }
    public function backlogTET($backlogId){
        $sql = "SELECT SUM(estimatedTime) AS totalEstimatedTime FROM task WHERE backlogId = $backlogId AND status = 'pending'";
        $consult = $this->db->query($sql);
        $totalEstimatedTime = $consult->fetch_assoc();
        return $totalEstimatedTime;
    }

}

?>
