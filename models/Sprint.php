<?php

class Sprint
{

    private $db; // database connection
    private $sprints; // array of sprints

    public function __construct()
    {
        $this->db = connection::connect(); // connect to database
        $this->sprints = array(); // initialize sprints array
    }

    public function list()
    { // list all sprints
        $sql = "SELECT * FROM sprint"; // SQL query to select all sprints
        $result = $this->db->query($sql); // execute SQL query
        if (!$result) {
            echo "So sorry,This site is having problems.";
            exit; // exit if SQL query fails
        }

        while ($row = $result->fetch_assoc()) { // iterate over results and add each sprint to the sprints array
            $this->sprints[] = $row;
        }

        return $this->sprints; 
    }

    public function insert($name, $description, $startDate, $endDate, $scrumTeamId)
    { 
        $sql = "INSERT INTO sprint(name, description, startDate, endDate, scrumTeamId)
            VALUES('$name', '$description', '$startDate', '$endDate', '$scrumTeamId')"; 
        $this->db->query($sql); 
    }

    public function getSprints($scrumTeamId)
    {
        $sql = "SELECT * FROM sprint
            WHERE scrumTeamId = '$scrumTeamId'";
        $result = $this->db->query($sql); 
        if (!$result) {
            echo "So sorry,This site is having problems.";
            exit; 
        }

        while ($row = $result->fetch_assoc()) { 
            $this->sprints[] = $row;
        }

        return $this->sprints; 
    }

    public function getSprintById($id)
    {
        $sql = "SELECT * FROM sprint
            WHERE id = '$id'";
        $consult = $this->db->query($sql);
        $devObject = $consult->fetch_assoc();
        return $devObject;
    }

    public function update($id, $name, $description, $startDate, $endDate, $scrumTeamId)
    { 
        $sql = "UPDATE sprint
            SET name = '$name', description = '$description', startDate = '$startDate', endDate = '$endDate', scrumTeamId = '$scrumTeamId'
            WHERE id = $id"; 
        $this->db->query($sql); 
    }

    public function delete($id)
    { 
        $sql = "DELETE FROM sprint
            WHERE id = $id"; 
        $this->db->query($sql); 
    }


    public function sprintTasks() {
        $sprints = $this->list();
        $sprintTasks = array();
    
        foreach ($sprints as $sprint) {
            $sprintId = $sprint['id'];
            $sql = "SELECT * FROM Task WHERE sprintId = " . $sprintId;
            $result = $this->db->query($sql);
            $tasks = $result->fetch_all(MYSQLI_ASSOC);
    
            $sprint['tasks'] = $tasks;
            array_push($sprintTasks, $sprint);
        }
    
        return $sprintTasks;
    }
    
    public function updateStartDate($id, $startDate) {
        $sql = "UPDATE sprint SET startDate = '$startDate' WHERE id = $id";
        $this->db->query($sql);
    }
    public function updateEndDate($id, $endDate) {
        $sql = "UPDATE sprint SET endDate = '$endDate' WHERE id = $id";
        $this->db->query($sql);
    }

    public function updateDescription($id, $description) {
        $sql = "UPDATE sprint SET description = '$description' WHERE id = $id";
        $this->db->query($sql);
    }

    public function sprintDuration($sprintId){
        $sql = "SELECT DATEDIFF(endDate, startDate) AS duration FROM Sprint WHERE id = $sprintId";
        $consult = $this->db->query($sql);
        if($consult){
            $duration = $consult->fetch_assoc();
            return $duration['duration'];
        } else {
            // Manejo de error en caso de que la consulta falle
            return null;
        }
    }

}
?>