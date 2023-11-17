<?php require "views/shared/header.php"; ?>

<div class="container">
    <h1 class="text-center mb-3">
        <?= $data['title']; ?>
    </h1>

    <!-- Detalles del Sprint -->
    <form id="dateForm" action="index.php?controller=sprint&action=updateAction" method="post">
        <h3>Detalles del Sprint</h3>
        <input type="hidden" name="id" value="<?= $data['sprint']['id']; ?>">
        <p><strong>Nombre:</strong>
            <?= $data['sprint']['name']; ?>
        </p>
        <p><strong>Descripción:</strong> <input type="text" name="description"
                value="<?= $data['sprint']['description']; ?>"
                onchange="updateActionAndSubmit(this, 'updateDescription')"></p>
        <p><strong>Fecha de Inicio:</strong> <input type="date" name="startDate"
                value="<?= $data['sprint']['startDate']; ?>" onchange="updateActionAndSubmit(this, 'updateStartDate')">
        </p>
        <p><strong>Fecha de Finalización:</strong> <input type="date" name="endDate"
                value="<?= $data['sprint']['endDate']; ?>" onchange="updateActionAndSubmit(this, 'updateEndtDate')"></p>
    </form>

    <h3>Tareas del Sprint  <a href="index.php?controller=task&action=insert&sprintId=<?=$data['sprint']['id'] ?>" class="btn btn-primary mb-2">
                        <i class="fa fa-plus-square"></i></a></h3>
    <table class="table">
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Descripción</th>
                <th>Desarrollador</th>
                <!-- Agrega más columnas si es necesario -->
            </tr>
        </thead>
        <tbody>
            <?php foreach ($data['sprintTasks'] as $task): ?>
                <tr>
                    <td>
                        <?= $task['name']; ?>
                    </td>
                    <td>
                        <?= $task['description']; ?>
                    </td>
                    <td>
                        <form action="index.php?controller=task&action=updateDeveloper" method="post">
                            <input type="hidden" name="taskId" value="<?= $task['id']; ?>">
                            <input type="hidden" name="sprintId" value="<?= $data['sprint']['id']; ?>">
                            <!-- Cambiado de 'id' a 'taskId' -->
                            <select class="form-control" name="developerId" onchange="updateActionAndSubmit(this, 'updateDeveloper')">
                                <?php foreach ($data['sprintDevelopers'] as $developer): ?>
                                    <option value="<?= $developer['id']; ?>" <?= $developer['id'] == $task['developerId'] ? 'selected' : '' ?>>
                                        <?= $developer['name']; ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </form>
                    </td>
                    <!-- Agrega más celdas si es necesario -->
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<script>
    function updateActionAndSubmit(selectElement, action) {
        // Actualizar el campo oculto con la acción correspondiente
        selectElement.form.action.value = action;

        // Enviar el formulario
        selectElement.form.submit();
    }
</script>


<?php require "views/shared/footer.php"; ?>