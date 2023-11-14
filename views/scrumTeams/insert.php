<?php include_once "views/shared/header.php" ?>

<h1 class="text-center"><?= $data['title'] ?></h1>

<div class="container text-center">
    <div class="form-signin">
        <form action="index.php?controller=scrumTeam&action=store" method="post">
            <div class="form-floating mb-3">
                <input type="text" class="form-control" name="name" placeholder="Name" >
                <label for="name">Name</label>
            </div>
            <div class="form-floating mb-3">
                <input type="description" class="form-control" name="description" placeholder="Scrum Team Description" >
                <label for="description">Description Address</label>
            </div>
            <button type="submit" class="btn btn-primary">Create Scrum Team</button>
        </form>
    </div>
</div>

<?php include_once "views/shared/footer.php" ?>