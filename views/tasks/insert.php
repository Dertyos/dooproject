<?php require "views/shared/header.php"; ?>
<link rel="stylesheet" href="assets/task.css">

<div class="container my-5">
    <h1 class="text-center">
        <?= $data['title'] ?>
    </h1>

    <form action="index.php?controller=task&action=store" method="post" class="my-4">
        <div class="form-group">
            <label for="name">Name:</label>
            <input type="text" class="form-control" id="name" name="name" required>
        </div>

        <div class="form-group">
            <label for="description">Description:</label>
            <textarea class="form-control" id="description" name="description" required></textarea>
        </div>

        <div class="form-group">
            <label for="estimatedTime">Estimated Time:</label>
            <input type="number" class="form-control" id="estimatedTime" name="estimatedTime" required>
        </div>

        <div class="form-group">
            <label for="priority">Priority:</label>
            <select class="form-control" id="priority" name="priority" required>
                <option value="stat">Stat</option>
                <option value="high">High</option>
                <option value="normal">Normal</option>
            </select>
        </div>

        <div class="form-group">
            <label for="status">Status:</label>
            <select class="form-control" id="status" name="status" required>
                <option value="pending">Pending</option>
                <option value="in_progress">In Progress</option>
                <option value="completed">Completed</option>
            </select>
        </div>

        <?php if (isset($data['scrumTeamId'])): ?>
            <input type="hidden" class="form-control" id="scrumTeamId" name="scrumTeamId"
                value="<?= $data['scrumTeamId'] ?>" required>
        <?php else: ?>
            <div class="form-group">
                <label for="scrumTeam">Assign Scrum Team:</label>
                <select class="form-control" id="scrumTeamId" name="scrumTeamId">
                    <?php foreach ($data['scrumTeams'] as $scrumTeam): ?>
                        <option value="<?= $scrumTeam['id']; ?>">
                            <?= $scrumTeam['name']; ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
        <?php endif; ?>

        <?php if (isset($data['sprintId'])): ?>
            <input type="hidden" class="form-control" id="sprintId" name="sprintId" value="<?= $data['sprintId'] ?>"
                required>
        <?php else: ?>
            <div class="form-group">
                <label for="sprint">Assign Sprint:</label>
                <select class="form-control" id="sprintId" name="sprintId">
                    <?php foreach ((isset($data['sprintsList']) ? $data['sprintsList'] : $data['sprints']) as $sprint): ?>
                        <option value="<?= $sprint['id']; ?>">
                            <?= $sprint['name']; ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
        <?php endif; ?>

        <?php if (isset($data['developerId'])): ?>
            <input type="hidden" class="form-control" id="developerId" name="developerId"
                value="<?= $data['developerId'] ?>" required>
        <?php else: ?>
            <div class="form-group">
                <label for="developer">Assign Developer:</label>
                <select class="form-control" id="developerId" name="developerId">
                    <?php foreach ((isset($data['developersList']) ? $data['developersList'] : $data['developers']) as $developer): ?>
                        <option value="<?= $developer['id']; ?>">
                            <?= $developer['name']; ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
        <?php endif; ?>

        
        <input type="hidden" class="form-control" id="backlogId" name="backlogId" value="<?= isset($data['backlogId']) ? $data['backlogId'] : null ?>" required>

        <button type="submit" class="btn btn-primary">Create Task</button>
    </form>
</div>

<script>
    document.getElementById('scrumTeam').addEventListener('change', function() {
        document.getElementById('backlogId').value = this.value;
        
    });
</script>

<?php require "views/shared/footer.php"; ?>