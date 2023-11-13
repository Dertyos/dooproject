<?php 

    require_once "settings/settings.php";
    require_once "core/routes.php";

    require_once "settings/database.php";
    require_once "controllers/HomeController.php";
    require_once "controllers/UserController.php";

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