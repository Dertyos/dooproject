<?php

class Sprint {

private $db; // database connection
private $sprints; // array of sprints

public function __construct() {
    $this->db = connection::connect(); // connect to database
    $this->sprints = array(); // initialize sprints array
}

public function list() { // list all sprints
    $sql = "SELECT * FROM sprint"; // SQL query to select all sprints
    $resultado = $this->db->query($sql); // execute SQL query
    if (!$resultado) {
        echo "Lo sentimos, este sitio web está experimentando problemas.";
        exit; // exit if SQL query fails
    }

    while ($fila = $resultado->fetch_assoc()) { // iterate over results and add each sprint to the sprints array
        $this->sprints[] = $fila;
    }

    return $this->sprints; // return the sprints array
}

public function insert($name, $description, $startDate, $endDate) { // insert a new sprint
    $sql = "INSERT INTO sprint(nombre, descripcion, fechaInicio, fechaFin)
            VALUES('$name', '$description', '$startDate', '$endDate')"; // SQL query to insert a new sprint
    $this->db->query($sql); // execute SQL query
}

public function getSprint($id) { // get a specific sprint by ID
    $sql = "SELECT sprint.*, backlog.name as backlogName
            FROM `sprint`
            JOIN backlog
            ON sprint.idBacklog = backlog.id
            WHERE sprint.id = $id"; // SQL query to select a specific sprint by ID
    $resultado = $this->db->query($sql); // execute SQL query
    $registro = $resultado->fetch_assoc(); // get the first row of the result set
    return $registro; // return the sprint data
}

public function update($id, $name, $description, $startDate, $endDate) { // update a specific sprint
    $sql = "UPDATE sprint
            SET nombre = '$name', descripcion = '$description', fechaInicio = '$startDate', fechaFin = '$endDate'
            WHERE id = $id"; // SQL query to update a specific sprint
    $this->db->query($sql); // execute SQL query
}

public function delete($id) { // delete a specific sprint by ID
    $sql = "DELETE FROM sprint
            WHERE id = $id"; // SQL query to delete a specific sprint by ID
    $this->db->query($sql); // execute SQL query
}

}
?>