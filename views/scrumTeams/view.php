<?php require "views/shared/header.php" ?>

<div class="container">
  <<div class="scrum-board">
        <div class="board-section backlog">
            <h2>Backlog</h2>
            <?php foreach ($data['backlogtask'] as $task): ?>
                <div class="task <?php echo strtolower($task['status']); ?>">
                    <p><?php echo $task['name']; ?></p>
                    <!-- Add other task details here -->
                </div>
            <?php endforeach; ?>
        </div>

        <div class="board-section sprints">
            <h2>Sprints</h2>
            <?php foreach ($data['sprints'] as $sprint): ?>
                <div class="sprint">
                    <h3><?php echo $sprint['name']; ?></h3>
                    <?php foreach ($data['sprinttask'] as $task): ?>
                        <div class="task <?php echo strtolower($task['status']); ?>">
                            <p><?php echo $task['name']; ?></p>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endforeach; ?>
        </div>
  </div>

  <a href="index.php?controlador=scrumteam" class="btn btn-primary">Volver</a>
</div>

<?php require "views/shared/footer.php" ?>