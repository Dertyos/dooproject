<?php include_once "views/shared/header.php"; ?>

<h1 class="text-center"><?= $data['title']; ?></h1>

<div class="container text-center">
    <div class="form-signin">
        <!-- Asegúrate de actualizar la acción del formulario para apuntar al controlador y método correctos -->
        <form action="index.php?controller=sprint&action=store" method="post">
            <div class="form-floating mb-3">
                <input type="text" class="form-control" name="name" placeholder="Sprint Name" required>
                <label for="name">Sprint Name</label>
            </div>
            <div class="form-floating mb-3">
                <input type="text" class="form-control" name="description" placeholder="Sprint Description" required>
                <label for="description">Sprint Description</label>
            </div>
            <div class="form-floating mb-3">
                <input type="date" class="form-control" name="startDate" placeholder="Start Date" required>
                <label for="startDate">Start Date</label>
            </div>
            <div class="form-floating mb-3">
                <input type="date" class="form-control" name="endDate" placeholder="End Date" required>
                <label for="endDate">End Date</label>
            </div>
            <?php if (isset($data['scrumTeamId'])): ?>
            <input type="hidden" class="form-control" id="scrumTeamId" name="scrumTeamId"
                value="<?= $data['scrumTeamId'] ?>" required>
        <?php else: ?>
            <div class="form-group-floating mb-3">
                <label for="scrumTeamId">Assign Scrum Team:</label>
                <select class="form-control" id="scrumTeamId" name="scrumTeamId">
                    <?php foreach ($data['scrumTeams'] as $scrumTeam): ?>
                        <option value="<?= $scrumTeam['id']; ?>">
                            <?= $scrumTeam['name']; ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
        <?php endif; ?>
            <button type="submit" class="btn btn-primary">Create Sprint</button>
        </form>
    </div>
</div>

<?php include_once "views/shared/footer.php"; ?>