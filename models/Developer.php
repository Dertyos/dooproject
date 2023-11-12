<?php

class Developer {

    private $db;
    private $developers;

    public function __construct() {
        $this->db = Connection::connect();
        $this->developers = array();
    }

    public function list() {
        $sql = "SELECT * FROM developer";
        if(!$result = $this->db->query($sql)) {
            echo "We're sorry, this website is experiencing problems.";
        }

        while($row = $result->fetch_assoc()) {
            $this->developers[] = $row;
        }

        return $this->developers;
    }

    public function insert($name, $email, $phone, $rol, $scrumTeamId) {
        $sql = "INSERT INTO developer(name, email, phone, rol, scrumTeamId)
                VALUES('$name', '$email', '$phone', $'rol', $scrumTeamId)";
        
        $this->db->query($sql);
    }

    public function getDeveloper($id) {
        $sql = "SELECT developer.*, scrumTeam.name as scrumTeamName
                FROM `developer` 
                JOIN scrumTeam 
                ON developer.scrumTeamId = scrumTeam.id 
                WHERE developer.id = $id";
        
        $result = $this->db->query($sql);
        $record = $result->fetch_assoc();
        return $record;
    }

    public function update($id, $name, $email, $phone, $rol, $scrumTeamId) {
        $sql = "UPDATE developer
                SET name = '$name', email = '$email', phone = '$phone', rol = 'rol', scrumTeamId = $scrumTeamId
                WHERE id = $id";

        $this->db->query($sql);
    }

    public function delete($id) {
        $sql = "DELETE FROM developer 
                WHERE id = $id";

        $this->db->query($sql);
    }

}
?>