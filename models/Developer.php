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
            echo "We are sorry, but the website is having problems.";
        }

        while($row = $result->fetch_assoc()) {
            $this->developers[] = $row;
        }

        return $this->developers;
    }

    public function insert($name, $email, $phone, $rol, $scrumTeamId, $documentNumber, $password) {
        
        $password = password_hash($password, PASSWORD_BCRYPT);

        $sql = "INSERT INTO developer(name, email, phone, rol, scrumTeamId, documentNumber, password)
        VALUES ('$name', '$email', '$phone', '$rol', $scrumTeamId, '$documentNumber', '$password')";
        $this->db->query($sql);
    }

    public function getDeveloper($documentNumber) {
        $sql = "SELECT * FROM developer
                WHERE documentNumber = '$documentNumber'";
        $consult = $this->db->query($sql);
        $devObject = $consult->fetch_assoc();
        return $devObject;
    }

    public function getDeveloperById($id) {
        $sql = "SELECT * FROM developer WHERE id = '$id'";
        $consult = $this->db->query($sql);
        $devObject = $consult->fetch_assoc();
        return $devObject;
    }

    public function getScrumTeamDevelopers($scrumTeamId) {
        $sql = "SELECT * FROM developer WHERE scrumTeamId = '$scrumTeamId'";
        $consult = $this->db->query($sql);
        $developers = [];
        while ($row = $consult->fetch_assoc()) {
            $developers[] = $row;
        }
        return $developers;
    }
    


    public function update($id, $fields) {
        $updates = [];
        foreach ($fields as $key => $value) {
            if ($value !== null) {
                if ($key == 'password') {
                    $value = password_hash($value, PASSWORD_BCRYPT);
                }
                $updates[] = "$key = '$value'";
            }
        }
    
        if (count($updates) > 0) {
            $sql = "UPDATE developer SET " . implode(', ', $updates) . " WHERE id = $id";
            $this->db->query($sql);
        }
    }

    public function delete($id) {
        $sql = "DELETE FROM developer WHERE id = $id";
        $this->db->query($sql);
    }

}
?>