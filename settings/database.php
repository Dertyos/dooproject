<?php

class Conection {

    public static function conect() {
        $conection = new mysqli("127.0.0.1", "root", "", "uccdev");
        if(!$conection) {
            die("failed conection: " . mysqli_connect_error());
        }
        return $conection;
    }

}

?>