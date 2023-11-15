<?php

function getController($controller) {

    $nameController = ucwords($controller). "Controller";
    $fileController = "controllers/$nameController.php";

    if(!is_file($fileController)){ // Si no es un archivo
        // Cargar el controlador principal
        $fileController = "controllers/" . PRINCIPAL_CONTROLLER . ".php";
    }


    require_once $fileController;
    $control = new $nameController;
    return $control;


}

function getAction($controller, $action, $id=null) {

    if(isset($action) && method_exists($controller, $action)) {

        if($id == null) {
            $controller->$action();
        } else {
            $controller->$action($id);
        }
        

    } else {
        $controller->PRINCIPAL_ACTION;
    }
}

?>