<?php require "views/shared/header.php" ?>

<div class="container">
  <h1 class="text-center my-5"><?= $data['titulo'] ?></h1>
  <p>
    <span class="fw-bold">ID:</span>
    <?= $data['scrumTeams']['id'] ?>
  </p>
  <p>
    <span class="fw-bold">Name</span>
    <?= $data['scrumTeams']['name'] ?>
  </p>
  <p>
    <span class="fw-bold">Scrum Team Description</span>
    <?= $data['scrumTeams']['description'] ?> 
  </p>
  <!-- Sección de Backlog -->
  <div class="row">
    <div class="col">
      <h2>Backlog</h2>
      <?php
        $backlogData = getTasksBacklog($data['scrumTeams']['id']);
        foreach ($backlogData['task'] as $task) {
          // Aquí vas a mostrar cada tarea del backlog
          echo "<div class='task'>{$task['name']}</div>";
        }
      ?>
    </div>

    <!-- Sección de Sprints -->
    <?php
      $sprintsData = getTasksSprint($data['scrumTeams']['id']);
      foreach ($sprintsData as $sprint) {
        echo "<div class='col'>";
        echo "<h2>Sprint {$sprint['sprint']['name']}</h2>";
        foreach ($sprint['task'] as $task) {
          // Aquí vas a mostrar cada tarea del sprint
          echo "<div class='task'>{$task['name']}</div>";
        }
        echo "</div>";
      }
    ?>
  </div>

  <a href="index.php?controlador=scrumteam" class="btn btn-primary">Volver</a>
</div>

<?php require "views/shared/footer.php" ?>