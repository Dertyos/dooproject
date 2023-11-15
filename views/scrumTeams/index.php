<?php require "views/shared/header.php" ?>
    
    <div class="container">
        <h1 class="text-center mb-3"><?= $data['title'] ?></h1>
        <a href="index.php?controller=scrumteam&action=insert" class="btn btn-secondary mb-3">Create a ScrumTeam</a>
        <table class="table">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($data['scrumTeams'] as $item) { ?>
                    <tr>
                        <td><?= $item['name'] ?></td>
                        <td>
                            <a href="index.php?controller=scrumteam&action=view&id=<?= $item['id'] ?>" class="btn btn-info">See more</a>
                            <a href="index.php?controller=scrumteam&action=edit&id=<?= $item['id'] ?>" class="btn btn-warning">Edit</a>
                            <a href="index.php?controller=scrumteam&action=delete&id=<?= $item['id'] ?>" class="btn btn-danger">Delete</a>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>

<?php require "views/shared/footer.php" ?>