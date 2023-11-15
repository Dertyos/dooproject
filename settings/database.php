<?php

class Connection {

    public static function connect() {
        $connection = new mysqli("127.0.0.1", "root", "", "scrum");
        if(!$connection) {
            die("failed connection: " . mysqli_connect_error());
        }
        return $connection;
    }

}

?>