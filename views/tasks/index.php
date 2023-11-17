<?php require "views/shared/header.php"; ?>

<div class="container">
    <h1 class="text-center mb-3"><?= $data['title']; ?></h1>
    <a href="index.php?controller=task&action=insert" class="btn btn-secondary mb-3">Create a Task</a>
    <table class="table">
        <thead>
            <tr>
                <th>Name</th>
                <th>Description</th>
                <th>Priority</th>
                <th>Estimated Time</th>
                <th>Status</th>
                <th>Backlog</th>
                <th>Sprint</th>
                <th>Developer</th>
                <th>Scrum Team</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($data['tasks'] as $task): ?>
                <tr>
                    <form action="index.php?controller=task&action=updateAction" method="post">
                        <td><?= $task['name']; ?></td>
                        <td><?= $task['description']; ?></td>
                        <td>
                        <select class="form-control" name="priority" onchange="updateActionAndSubmit(this, 'updatePriority')">
                                <option value="stat" <?= $task['priority'] == 'stat' ? 'selected' : '' ?>>Stat</option>
                                <option value="high" <?= $task['priority'] == 'high' ? 'selected' : '' ?>>High</option>
                                <option value="normal" <?= $task['priority'] == 'normal' ? 'selected' : '' ?>>Normal</option>
                            </select>
                            <input type="hidden" name="id" value="<?= $task['id']; ?>">
                        </td>
                        <td>
                            <input type="text" class="form-control" name="estimatedTime" value="<?= $task['estimatedTime']; ?>" onchange="updateActionAndSubmit(this, 'updateEstimatedTime')">
                        </td>
                        <td>
                        <select class="form-control" name="status" onchange="updateActionAndSubmit(this, 'updateStatus')">
                                <option value="pending" <?= $task['status'] == 'pending' ? 'selected' : '' ?>>Pending</option>
                                <option value="in_progress" <?= $task['status'] == 'in_progress' ? 'selected' : '' ?>>In Progress</option>
                                <option value="completed" <?= $task['status'] == 'completed' ? 'selected' : '' ?>>Completed</option>
                            </select>
                            <input type="hidden" name="id" value="<?= $task['id']; ?>">
                        </td>
                        <!-- Resto de las celdas -->
                        <td><?= $data['backlogs'][$task['id']]['name'] ?? 'N/A'; ?></td>
                        <td><?= $data['sprints'][$task['id']]['name'] ?? 'N/A'; ?></td>
                        <td><?= $data['developers'][$task['id']]['name'] ?? 'N/A'; ?></td>
                        <td><?= $data['scrumTeams'][$task['id']]['name'] ?? 'N/A'; ?></td>
                        <td>
                            <a href="index.php?controller=task&action=edit&id=<?= $task['id']; ?>" class="btn btn-warning">Edit</a>
                            <a href="index.php?controller=task&action=delete&id=<?= $task['id']; ?>" class="btn btn-danger">Delete</a>
                        </td>
                        <input type="hidden" name="action" value="">
                        <input type="hidden" name="id" value="<?= $task['id']; ?>">
                    </form>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<script>
    function updateActionAndSubmit(selectElement, action) {
        // Actualizar el campo oculto con la acción correspondiente
        selectElement.form.action.value = action;

        // Enviar el formulario
        selectElement.form.submit();
    }
</script>


<?php require "views/shared/footer.php"; ?>
