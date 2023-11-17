<?php require "views/shared/header.php" ?>

<div class="container">
    <h1 class="text-center mb-3">
        <?= $data['title'] ?>
    </h1>
    <a href="index.php?controller=sprint&action=insert" class="btn btn-secondary mb-3">Create a Sprint</a>
    <table class="table">
        <thead>
            <tr>
                <th>Name</th>
                <th>Description</th>
                <th>Start Date</th>
                <th>End Date</th>
                <th>Scrum Team</th>
                <th>Tasks</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($data['sprintTasks'] as $sprint) { ?>
                <tr>
                    <td><?= $sprint['name'] ?></td>
                    <td><?= $sprint['description'] ?></td>
                    <td><?= $sprint['startDate'] ?></td>
                    <td><?= $sprint['endDate'] ?></td>
                    <td><?= $sprint['scrumTeamId']?></td>
                    <td>
                        <?php if (isset($sprint['tasks'])): ?>
                            <?php foreach ($sprint['tasks'] as $task) { ?>
                                <div>
                                    <?= $task['name'] ?>
                                </div>
                            <?php } ?>
                        <?php endif; ?>
                    </td>
                    <td>
                        <a href="index.php?controller=sprint&action=view&id=<?= $sprint['id'] ?>" class="btn btn-info">See more</a>
                        <a href="index.php?controller=sprint&action=edit&id=<?= $sprint['id'] ?>"class="btn btn-warning">Edit</a>
                        <a href="index.php?controller=sprint&action=delete&id=<?= $sprint['id'] ?>" class="btn btn-danger">Delete</a>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>

<?php require "views/shared/footer.php" ?>