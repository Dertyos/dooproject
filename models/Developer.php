<?php

class Developer {

    private $database;
    private $developers;

    public function __construct() {
        $this->database = Connection::connect();
        $this->developers = array();
    }

    public function list() {
        $sql = "SELECT * FROM developer";
        if(!$result = $this->database->query($sql)) {
            echo "We're sorry, this website is experiencing problems.";
        }

        while($row = $result->fetch_assoc()) {
            $this->developers[] = $row;
        }

        return $this->developers;
    }

    public function insert($name, $email, $phone, $scrumTeamId) {
        $sql = "INSERT INTO developer(name, email, phone, scrumTeamId)
                VALUES('$name', '$email', '$phone', $scrumTeamId)";
        
        $this->database->query($sql);
    }

    public function getDeveloper($id) {
        $sql = "SELECT developer.*, scrumTeam.name as scrumTeamName
                FROM `developer` 
                JOIN scrumTeam 
                ON developer.scrumTeamId = scrumTeam.id 
                WHERE developer.id = $id";
        
        $result = $this->database->query($sql);
        $record = $result->fetch_assoc();
        return $record;
    }

    public function update($id, $name, $email, $phone, $scrumTeamId) {
        $sql = "UPDATE developer
                SET name = '$name', email = '$email', phone = '$phone', scrumTeamId = $scrumTeamId
                WHERE id = $id";

        $this->database->query($sql);
    }

    public function delete($id) {
        $sql = "DELETE FROM developer 
                WHERE id = $id";

        $this->database->query($sql);
    }

}
?>