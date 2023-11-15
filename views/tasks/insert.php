<?php include_once "views/shared/Header.php" ?>

<h1 class="text-center"><?= $data['title'] ?></h1>

<div class="container text-center">
    <div class="form-signin">
        <form action="index.php?controller=task&action=store" method="post">
            <div class="form-floating mb-3">
                <input type="text" class="form-control" name="name" placeholder="Task Name">
                <label for="name">Task Name</label>
            </div>
            <div class="form-floating mb-3">
                <textarea class="form-control" name="description" placeholder="Task Description"></textarea>
                <label for="description">Description</label>
            </div>
            <div class="form-floating mb-3">
                <select class="form-select" name="priority" aria-label="Priority">
                    <option value="High">High</option>
                    <option value="Medium">Medium</option>
                    <option value="Low">Low</option>
                </select>
                <label for="priority">Priority</label>
            </div>
            <div class="form-floating mb-3">
                <input type="number" class="form-control" name="estimatedTime" placeholder="Estimated Time">
                <label for="estimatedTime">Estimated Time</label>
            </div>
            <div class="form-floating mb-3">
                <select class="form-select" name="status" aria-label="Status">
                    <option value="Not Started">Not Started</option>
                    <option value="In Progress">In Progress</option>
                    <option value="Completed">Completed</option>
                </select>
                <label for="status">Status</label>
            </div>
            <div class="form-floating mb-3">
                <select class="form-select" id="scrumTeamId" name="scrumTeamId" aria-label="Floating label select example">
                    <?php foreach($data['scrumTeams'] as $item) { ?>
                        <option value="<?= $item['id'] ?>"><?= $item['name'] ?></option>
                    <?php } ?>
                </select>
                <label for="floatingSelect">Assign your Scrum Team</label>
            </div>
            <div class="form-floating mb-3">
                <select class="form-select" id="developerId" name="developerId" aria-label="Floating label select example">
                    <?php foreach($data['scrumTeams'] as $item) { ?>
                        <option value="<?= $item['id'] ?>"><?= $item['name'] ?></option>
                    <?php } ?>
                </select>
                <label for="floatingSelect">Assign your Scrum Team</label>
            </div>
            <button type="submit" class="btn btn-primary">Create Task</button>
        </form>
    </div>
</div>

<?php include_once "views/shared/footer.php" ?>
