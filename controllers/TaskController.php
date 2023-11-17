<?php

class TaskController
{

    public function __construct()
    {
        require_once 'models/Task.php';
        require_once 'models/ScrumTeam.php';
        require_once 'models/Developer.php';
        require_once 'models/Sprint.php';
        require_once 'models/Backlog.php';
    }

    public function index()
    {
        session_status() == PHP_SESSION_NONE ? session_start() : null;
        if (isset($_SESSION['documentNumber'])) {
            $taskModel = new Task();
            $data['tasks'] = $taskModel->list();

            $developerModel = new Developer();
            $scrumTeamModel = new ScrumTeam();
            $sprintModel = new Sprint();
            $backlogModel = new Backlog();

            $data['backlogs'] = [];
            $data['developers'] = [];
            $data['scrumTeams'] = [];
            $data['sprints'] = [];

            foreach ($data['tasks'] as $task) {
                $data['backlogs'][$task['id']] = $backlogModel->getBacklogById($task['backlogId']);
                $data['developers'][$task['id']] = $developerModel->getDeveloperById($task['developerId']);
                $data['scrumTeams'][$task['id']] = $scrumTeamModel->getScrumTeam($task['scrumTeamId']);
                $data['sprints'][$task['id']] = $sprintModel->getSprintById($task['sprintId']);
            }

            // $remainingTime = 0;
            // foreach ($data['scrumTeams'] as $scrumTeam) {
            //     $developersList = $developerModel->getScrumTeamDevelopers($scrumTeam['id']);
            //     $timeWorked = (lenght($developersList)) * $scrumTeam['workTime']; 
            //     $timeNeeded = $scrumTeam->scrumTeamTET($scrumTeam['id']);
            //     $remainingTime = $timeNeeded - $timeWorked
            // }

            $data['title'] = "Tasks";
            require_once "views/tasks/index.php";
            exit;
        } else {
            $_SESSION['error'] = 'You do not have access. Please log in.';
            header('Location: index.php?controller=developer&action=login');
            exit;
        }
    }

    public function insert()
    {
        $task = new Task();
        $scrumTeam = new ScrumTeam();
        $sprint = new Sprint();
        $developer = new Developer();


        if (isset($_GET['scrumTeamId'])) {
            $data['scrumTeamId'] = $_GET['scrumTeamId'];
            $backlogId = $_GET['scrumTeamId'];
            $data['sprintsList'] = $sprint->getSprints($backlogId);
            $data['developersList'] = $developer->getScrumTeamDevelopers($backlogId);
        }
        else if(isset($_GET['sprintId'])){
            $data['sprintId'] = $_GET['sprintId'];
            $sprint = $sprint->getSprintById($_GET['sprintId']);
            $data['scrumTeamId'] = $sprint['scrumTeamId'];
            $data['developersList']= $developer->getScrumTeamDevelopers($sprint['scrumTeamId']);
        } 
        else if(isset($_GET['developerId'])) {
            $data['developerId'] = $_GET['developerId'];
            $developer = $developer->getDeveloperById($_GET['developerId']);
            $data['scrumTeamId'] = $developer['scrumTeamId'];
            $data['sprintsList'] = $sprint->getSprints($developer['scrumTeamId']);
        }

        $sprint = new Sprint();
        $developer = new Developer();

        $data['scrumTeams'] = $scrumTeam->list();
        $data['sprints'] = $sprint->list();
        $data['developers'] = $developer->list();
        
        $data['title'] = "New Task";
        require_once "views/tasks/insert.php";
    }

    // private function determineInsertContext($params)
    // {
    //     $context = ['scrumTeamId' => null, 'sprintId' => null, 'backlogId' => null, 'developerId' => null];

    //     if (isset($params['scrumTeamId'])) {
    //         $context['scrumTeamId'] = $params['scrumTeamId'];
    //         $backlog = new Backlog();
    //         $context['backlogId'] = $backlog->getBacklog($params['scrumTeamId']);
    //     } else if (isset($params['sprintId'])) {
    //         $context['sprintId'] = $params['sprintId'];
    //         $sprint = new Sprint();
    //         $sprint = $sprint->getSprintById($params['sprintId']);
    //         $context['scrumTeamId'] = $sprint['scrumTeamId'];
    //     } else if (isset($params['backlogId'])) {
    //         $context['backlogId'] = $params['backlogId'];
    //         $backlog = new Backlog();
    //         $backlog = $backlog->getBacklogById($params['backlogId']);
    //         $context['scrumTeamId'] = $backlog['scrumTeamId'];
    //     } else if (isset($params['developerId'])) {
    //         $context['developerId'] = $params['developerId'];
    //         $developer = new Developer();
    //         $developer = $developer->getDeveloperById($params['developerId']);
    //         $context['scrumTeamId'] = $developer['scrumTeamId'];
    //         $backlog = new Backlog();
    //         $backlog = $backlog->getBacklog($developer['scrumTeamId']);
    //         $context['backlogId'] = $backlog['id']; // Corrected here
    //     }

    //     return $context;
    // }

    public function store()
    {
        $name = $_POST['name'];
        $description = $_POST['description'];
        $priority = $_POST['priority'];
        $estimatedTime = $_POST['estimatedTime'];
        $status = $_POST['status'];
        $backlogId = $_POST['backlogId'] == null ? $_POST['scrumTeamId'] : $_POST['backlogId'];
        $sprintId = $_POST['sprintId'];
        $developerId = $_POST['developerId'];
        $scrumTeamId = $_POST['scrumTeamId'];

        $task = new Task();
        $task->insert($name, $description, $priority, $estimatedTime, $status, $backlogId, $sprintId, $developerId, $scrumTeamId);

        $this->index();
    }

    public function view($id)
    {
        $task = new Task();
        $data['title'] = "Task Details";
        $data['task'] = $task->getTask($id);
        require_once "views/tasks/view.php";
    }

    public function edit($id)
    {
        $developer = new Developer();
        $sprint = new Sprint();
        $task = new Task();


        $data['developersList'] = $developer->list();
        $data['sprints'] = $sprint->list();
        $data['task'] = $task->getTask($id);

        $data['title'] = "Edit Task";
        require_once "views/tasks/edit.php";
    }

    public function update()
    {
        $backlog = new Backlog();
        $backlog = $backlog->getBacklog($_POST['scrumTeamId']);
        $id = $_POST['id'];
        $name = $_POST['name'];
        $description = $_POST['description'];
        $priority = $_POST['priority'];
        $estimatedTime = $_POST['estimatedTime'];
        $status = $_POST['status'];
        $backlogId = $backlog['id'];
        $sprintId = !empty($_POST['sprintId']) ? $_POST['sprintId'] : null;
        $developerId = !empty($_POST['developerId']) ? $_POST['developerId'] : null;
        $scrumTeamId = $_POST['scrumTeamId'];

        $task = new Task();
        $task->update($id, $name, $description, $priority, $estimatedTime, $status, $backlogId, $sprintId, $developerId, $scrumTeamId);

        $this->index();
    }

    public function updateAction()
    {
        $id = $_POST['id'];
        $action = $_POST['action'];
        $task = new Task();

        switch ($action) {
            case 'updateStatus': $status = $_POST['status'];
                $task->updateStatus($id, $status);
                break;
            case 'updatePriority': $priority = $_POST['priority'];
                $task->updatePriority($id, $priority);
                break;
            case 'updateEstimatedTime':
                $estimatedTime = $_POST['estimatedTime'];
                $task->updateEstimatedTime($id, $estimatedTime);
                break;    
        }

        header('Location: index.php?controller=task&action=index');
        exit; 
    }

    public function updatePriority()
    {
        $id = $_POST['id'];
        $priority = $_POST['priority'];
        
        $task = new Task();
        $task->updatePriority($id, $priority);

        header('Location: index.php?controller=task&action=index');
        exit; 
    }

    public function updateDeveloper(){
        $taskId = $_POST['taskId']; // Asegúrate de que esto coincida con el nombre del campo oculto en el formulario.
        $developerId = $_POST['developerId'];
        $sprintId = $_POST['sprintId'];

        $task = new Task();
        $task->updateDeveloper($taskId, $developerId);

        header('Location: index.php?controller=sprint&action=view&id=' . $sprintId);
        exit; 
    
    }
    public function delete($id)
    {
        $task = new Task();
        $task->delete($id);
        $this->index();
    }
    
}

?>