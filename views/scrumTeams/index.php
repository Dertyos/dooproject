<?php require "views/shared/header.php" ?>
    
    <div class="container">
        <h1 class="text-center mb-3"><?= $data['title'] ?></h1>
        <a href="index.php?controlador=scrumteam&accion=insert" class="btn btn-secondary mb-3">Create a ScrumTeam</a>
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
                        <td><?= $item['nombre'] ?></td>
                        <td>
                            <a href="index.php?controlador=scrumteam&accion=view&id=<?= $item['id'] ?>" class="btn btn-info">See more</a>
                            <a href="index.php?controlador=scrumteam&accion=edit&id=<?= $item['id'] ?>" class="btn btn-warning">Edit</a>
                            <a href="index.php?controlador=scrumteam&accion=delete&id=<?= $item['id'] ?>" class="btn btn-danger">Delete</a>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>

<?php require "views/shared/footer.php" ?>