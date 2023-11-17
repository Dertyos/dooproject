<?php require "views/shared/header.php" ?>

<div class="container">
    <h1 class="text-center my-5"><?= $data['title'] ?></h1>
    <form action="index.php?controller=sprint&action=update" method="post">
        <input type="hidden" name="id" value="<?= $data['id'] ?>">

        <div class="form-floating mb-3">
            <input type="text" class="form-control" id="name" name="name" value="<?= $data['sprint']['name'] ?? '' ?>" required>
            <label for="name">Sprint Name</label>
        </div>

        <div class="form-floating mb-3">
            <textarea class="form-control" id="description" name="description"><?= $data['sprint']['description'] ?? '' ?></textarea>
            <label for="description">Description</label>
        </div>

        <div class="form-floating mb-3">
            <input type="date" class="form-control" id="startDate" name="startDate" value="<?= $data['sprint']['startDate'] ?? '' ?>" required>
            <label for="startDate">Start Date</label>
        </div>

        <div class="form-floating mb-3">
            <input type="date" class="form-control" id="endDate" name="endDate" value="<?= $data['sprint']['endDate'] ?? '' ?>" required>
            <label for="endDate">End Date</label>
        </div>

        <input type="hidden" class="form-control" id="scrumTeamId" name="scrumTeamId" value="<?= $data['sprint']['scrumTeamId']?>" required>


        <button type="submit" class="btn btn-primary">Save Sprint</button>
    </form>
</div>

<?php require "views/shared/footer.php" ?>
