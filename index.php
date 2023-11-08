<?php 

    require_once "config/config.php";
    require_once "core/routes.php";

    require_once "config/database.php";
    require_once "controllers/ProyectoController.php";

    if(isset($_GET['controller'])) {
        $controller = getController($_GET['controller']);
        if(isset($_GET['action'])) {
            if(isset($_GET['id'])) {
                getAction($controller, $_GET['action'], $_GET['id']);
            } else {
                getAction($controller, $_GET['action']);
            }
            
        } else {
            getAction($controller, PRINCIPAL_ACTION);
        }
    } else {
        $controller = getController(PRINCIPAL_CONTROLLER);
        getAction($controller, PRINCIPAL_ACTION);
    }

?>