<?php require "views/shared/header.php"; ?>

<div class="container">
    <h1 class="text-center mb-3">
        <?= $data['scrumTeam']['name'] ?> Details
    </h1>

    <table class="table table-bordered">
        <thead class="thead-dark">
            <tr>
                <th scope="col">Backlog Tasks <a href="index.php?controller=task&action=insert&scrumTeamId=<?=$data['scrumTeam']['id'] ?>" class="btn btn-primary mb-2">
                        <i class="fa fa-plus-square"></i></a></th>
                <th scope="col">Sprints</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>
                    <?php if (!empty($data['backlogtask'])): ?>
                        <?php foreach ($data['backlogtask'] as $task): ?>
                            <div>
                                <?= $task['name'] ?>
                            </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <p>No backlog tasks available.</p>
                    <?php endif; ?>
                </td>
                <td>
                    <?php if (!empty($data['sprints'])): ?>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Start Date</th>
                                    <th>End Date</th>
                                    <th>Tasks</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($data['scrumTeamSprints'] as $sprint): ?>
                                    <tr>
                                        <td>
                                            <?= $sprint['name'] ?>
                                        </td>
                                        <td>
                                            <?= $sprint['startDate'] ?>
                                        </td>
                                        <td>
                                            <?= $sprint['endDate'] ?>
                                        </td>
                                        <td>
                                            <a href="index.php?controller=task&action=insert&sprintId=<?= $sprint['id'] ?>" class="btn btn-primary mb-2">
                                                <i class="fa fa-plus-circle"></i></a>
                                            <?php if (isset($data['sprintTasks'][$sprint['id']])): ?>
                                                <?php foreach ($data['sprintTasks'][$sprint['id']] as $task): ?>
                                                    <div>
                                                        <?= $task['name'] ?>
                                                    </div>
                                                <?php endforeach; ?>
                                            <?php else: ?>
                                                <p>No tasks for this sprint.</p>
                                            <?php endif; ?>
                                        </td>
                                        <td>
                                            <a href="index.php?controller=sprint&action=view&id=<?= $sprint['id'] ?>"
                                                class="btn btn-info">See more</a>
                                            <a href="index.php?controller=sprint&action=edit&id=<?= $sprint['id'] ?>"
                                                class="btn btn-warning">Edit</a>
                                            <a href="index.php?controller=sprint&action=delete&id=<?= $sprint['id'] ?>"
                                                class="btn btn-danger">Delete</a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    <?php else: ?>
                        <p>No sprints available.</p>
                    <?php endif; ?>
                </td>
            </tr>
        </tbody>
    </table>
</div>

<?php require "views/shared/footer.php"; ?>