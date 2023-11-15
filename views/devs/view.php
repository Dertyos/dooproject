public function view($id) {
        $developer = new Developer();
        $tasks = new Task();
    
        $data['developer'] = $developer->getDeveloper($id);
        $data['developerTasks'] = $tasks->getDeveloperTasks($id);
        $data['title'] = "Developer Details";
    
        require_once "views/devs/view.php";
    }