<?php require "views/shared/header.php" ?>

<div class="container">
    <div class="scrum-team-details mt-4">
        <h2 class="text-info">Scrum Team Details</h2>
        <div class="details-box p-3">
            <p><strong>Team Name:</strong> <?= $data['scrumTeam']['name'] ?></p>
            <p><strong>Description:</strong> <?= $data['scrumTeam']['description'] ?></p>
        </div>
    </div>
    <div class="backlog-tasks mt-4">
        <h2 class="text-success">Backlog Tasks</h2>
        <a href="index.php?controller=task&action=insert&scrumTeamId=<?= $data['scrumTeam']['id'] ?>" class="btn btn-primary">Add New Task</a>
        <div class="tasks-box">
            <?php if (!empty($data['backlogtask'])): ?>
                <?php foreach ($data['backlogtask'] as $task): ?>
                    <div class="task-card">
                    <div class="task-status-indicator <?= strtolower($task['status']); ?>"></div>
                        <div class="task-content">
                            <p class="task-name"><?= $task['name']; ?></p>
                            <a href="index.php?controller=task&action=view&id=<?= $task['id'] ?>" class="info-icon">
                                <i class="fas fa-info-circle"></i>
                            </a>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p class="text-secondary">No backlog tasks available.</p>
            <?php endif; ?>
        </div>
    </div>

    <div class="sprints mt-4">
        <h2 class="text-warning">Sprints</h2>
        <?php if (!empty($data['sprints'])): ?>
            <?php foreach ($data['sprints'] as $sprint): ?>
                <div class="sprint-card">
                    <p><strong>Sprint:</strong> <?= $sprint['name']; ?></p>
                    <p><strong>Start Date:</strong> <?= $sprint['startDate']; ?></p>
                    <p><strong>End Date:</strong> <?= $sprint['endDate']; ?></p>

                    <div class="sprint-tasks mt-2">
                        <h3 class="text-success">Sprint Tasks</h3>
                        <div class="tasks-box">
                        <a href="index.php?controller=task&action=insert&sprintId=<?= $sprint['id'] ?>" class="btn btn-primary">Add New Task</a>
                            <?php if (!empty($data['sprintTasks'][$sprint['id']])): ?>
                                <?php foreach ($data['sprintTasks'][$sprint['id']] as $task): ?>
                                    <div class="task-card">
                                        <div class="task-status-indicator <?= strtolower($task['status']); ?>"></div>
                                        <div class="task-content">
                                            <p class="task-name"><?= $task['name']; ?></p>
                                            <a href="index.php?controller=task&action=view&id=<?= $task['id'] ?>" class="info-icon">
                                                <i class="fas fa-info-circle"></i>
                                            </a>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <p class="text-secondary">No tasks for this sprint.</p>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p class="text-secondary">No sprints available.</p>
        <?php endif; ?>
    </div>

  <a href="index.php?controller=scrumteam" class="btn btn-primary">Back</a>
</div>

<?php require "views/shared/footer.php" ?>
