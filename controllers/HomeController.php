<?php

class HomeController {
  public function index() {
    if(!isset($_SESSION)) {
      session_start();
    }

    if(isset($_SESSION['documentNumber']))
    {
      $data['title'] = "Scrum Teams";
      require_once "views/home/index.php";
    } else {
      header("Location: index.php?controller=developer&action=seeLogin");
    }
  }
}

?>