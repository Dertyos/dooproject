<?php require "views/shared/header.php"; ?>
<link rel="stylesheet" href="assets/task.css">

<div class="container my-5">
    <h1 class="text-center"><?= $data['title'] ?></h1>

    <!-- Sección de Detalles del Desarrollador -->
    <div class="developer-details mt-4">
        <h2 class="text-info">Developer Details</h2>
        <div class="details-box p-3">
            <p><strong>Name:</strong> <?= $data['developer']['name'] ?></p>
            <p><strong>Email:</strong> <?= $data['developer']['email'] ?></p>
            <p><strong>Phone:</strong> <?= $data['developer']['phone'] ?></p>
            <p><strong>Role:</strong> <?= $data['developer']['rol'] ?></p>
        </div>
    </div>

    <!-- Sección de Tareas Asignadas al Desarrollador -->
    <div class="developer-tasks mt-4">
        <h2 class="text-success">Assigned Tasks</h2>
        <a href="index.php?controller=task&action=insert&developerId=<?= $data['developer']['id'] ?>" class="btn btn-primary">Add New Task</a>
        <div class="tasks-box">
            <?php if (!empty($data['developerTasks'])): ?>
                <?php foreach ($data['developerTasks'] as $task): ?>
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
                <p class="text-secondary">No tasks assigned.</p>
            <?php endif; ?>
        </div>
    </div>

    <a href="index.php?controller=developer" class="btn btn-primary mt-3">Back to Developers</a>
</div>

<?php require "views/shared/footer.php"; ?>
