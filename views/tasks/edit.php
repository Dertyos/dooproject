<?php require "views/shared/header.php" ?>

<div class="container">
    <h1 class="text-center my-5">
        <?= $data['title'] ?>
    </h1>
    <form action="index.php?controller=task&action=update" method="post">
        <input type="hidden" name="id" value="<?= $data['task']['id'] ?>">

        <div class="form-group mb-3">
            <label for="name">Name</label>
            <input type="text" class="form-control" id="name" name="name" value="<?= $data['task']['name'] ?>" required>
        </div>

        <div class="form-group mb-3">
            <label for="description">Description</label>
            <textarea class="form-control" id="description" name="description"
                required><?= $data['task']['description'] ?></textarea>
        </div>

        <select class="form-control" name="priority" id="priority">
            <option value="stat" <?= $data['task']['priority'] == 'stat' ? 'selected' : '' ?>>Stat</option>
            <option value="high" <?= $data['task']['priority'] == 'high' ? 'selected' : '' ?>>High</option>
            <option value="normal" <?= $data['task']['priority'] == 'normal' ? 'selected' : '' ?>>Normal</option>
        </select>
        </td>

        <div class="form-group mb-3">
            <label for="estimatedTime">Estimated Time</label>
            <input type="number" class="form-control" id="estimatedTime" name="estimatedTime"
                value="<?= $data['task']['estimatedTime'] ?>" required>
        </div>

        <div class="form-group mb-3">
            <label for="status">Status</label>
            <select class="form-control" id="status" name="status" required>
                <option value="pending" <?= $data['task']['status'] == 'pending' ? 'selected' : '' ?>>Pending</option>
                <option value="in_progress" <?= $data['task']['status'] == 'in_progress' ? 'selected' : '' ?>>In Progress
                </option>
                <option value="completed" <?= $data['task']['status'] == 'completed' ? 'selected' : '' ?>>Completed
                </option>
            </select>
        </div>

        <div class="form-group mb-3">
            <label for="sprintId">Sprint</label>
            <select class="form-control" id="sprintId" name="sprintId">
                <?php foreach ($data['sprints'] as $sprint): ?>
                    <option value="<?= $sprint['id']; ?>" <?= $data['task']['sprintId'] == $sprint['id'] ? 'selected' : '' ?>>
                        <?= $sprint['scrumTeamId'] . " " . $sprint['name']; ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="form-group">
            <label for="developerId">Assign Developer:</label>
            <select class="form-control" id="developerId" name="developerId">
            </select>
        </div>

        <input type="hidden" id="scrumTeamId" name="scrumTeamId" value="">
        <button type="submit" class="btn btn-primary">Save Task</button>
    </form>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        var sprintSelect = document.getElementById('sprintId');
        var developerSelect = document.getElementById('developerId');
        var developers = <?= json_encode($data['developersList']); ?>;
        var sprints = <?= json_encode($data['sprints']); ?>;

        function filterDevelopers() {
            var selectedSprintId = sprintSelect.value;
            var selectedScrumTeamId;

            // Encontrar el scrumTeamId asociado con el sprint seleccionado
            for (var i = 0; i < sprints.length; i++) {
                if (sprints[i].id.toString() === selectedSprintId) {
                    selectedScrumTeamId = sprints[i].scrumTeamId;
                    break;
                }
            }

            developerSelect.innerHTML = ''; // Limpiar la lista de desarrolladores

            // Filtrar y mostrar desarrolladores que pertenecen al equipo Scrum seleccionado
            developers.forEach(function (developer) {
                if (developer['scrumTeamId'] === selectedScrumTeamId) {
                    var option = new Option(developer['name'], developer['id']);
                    developerSelect.add(option);
                }
            });

            // Actualizar el valor del campo oculto de scrumTeamId
            document.getElementById('scrumTeamId').value = selectedScrumTeamId || '';
        }

        // Event listener para cuando cambia la selección del sprint
        sprintSelect.addEventListener('change', filterDevelopers);

        // Inicializar la lista de desarrolladores basada en el sprint seleccionado inicialmente
        filterDevelopers();
    });

</script>


<?php require "views/shared/footer.php" ?>