<?php require "views/shared/header.php"; ?>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>


<style>
    /* Estilos para hacer los botones más pequeños y mejorar el diseño general */
    .btn {
        padding: 0.25rem 0.5rem;
        /* Reduce el padding para hacer los botones más pequeños */
        font-size: 0.8rem;
        /* Disminuye el tamaño de la fuente */
        line-height: 1;
        /* Ajusta la altura de la línea */
        border-radius: 0.2rem;
        /* Suaviza los bordes */
    }

    /* Estilos adicionales para el contenedor y la tabla */
    .table {
        margin-top: 20px;
        margin-bottom: 20px;
    }

    .table th {
        background-color: #007bff;
        color: white;
    }

    .table-bordered th,
    .table-bordered td {
        border: 1px solid #dee2e6;
    }

    /* Clases para espaciado y visibilidad */
    .mb-2 {
        margin-bottom: 0.5rem;
    }

    .mb-3 {
        margin-bottom: 1rem;
    }

    .text-center {
        text-align: center;
    }

    /* Estilos para las tareas */
    .task {
        background: #f8f9fa;
        margin-bottom: 0.5rem;
        padding: 0.5rem;
        border-radius: 0.2rem;
    }

    .priority,
    .status {
        font-weight: bold;
    }

    .priority {
        color: #ffc107;
    }

    .status {
        color: #17a2b8;
    }
</style>
<div class="container">
    <h1 class="text-center mb-3">
        <?= $data['scrumTeam']['name'] ?> Details
    </h1>

    <table class="table table-bordered">
        <thead class="thead-dark">
            <tr>
                <th scope="col">Backlog Tasks <a
                        href="index.php?controller=task&action=insert&scrumTeamId=<?= $data['scrumTeam']['id'] ?>"
                        class="btn btn-primary mb-2">
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
                                <!-- Añadir estado y prioridad aquí para cada tarea del backlog -->
                                <span>Priority:
                                    <?= $task['priority']; ?>
                                </span>
                                <span>Status:
                                    <?= $task['status']; ?>
                                </span>

                                <a href="index.php?controller=task&action=edit&id=<?= $task['id']; ?>"
                                    class="btn btn-warning">Edit</a>
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
                                            <a href="index.php?controller=task&action=insert&sprintId=<?= $sprint['id'] ?>"
                                                class="btn btn-primary mb-2">
                                                <i class="fa fa-plus-circle"></i></a>
                                            <?php if (isset($data['sprintTasks'][$sprint['id']])): ?>
                                                <?php foreach ($data['sprintTasks'][$sprint['id']] as $task): ?>
                                                    <div>
                                                        <?= $task['name'] ?>
                                                        <!-- Añadir estado y prioridad aquí para cada tarea del sprint -->
                                                        <span>Priority:
                                                            <?= $task['priority']; ?>
                                                        </span>
                                                        <span>Status:
                                                            <?= $task['status']; ?>
                                                        </span>
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
    <div class="text-center">
        <canvas id="burndownChart"></canvas>
    </div>
</div>

<script type="text/javascript">
    let burndownChartData = <?php echo json_encode($data['burndownChartData']); ?>;
    let sprintId = <?php echo json_encode($id - 1); ?>;
</script>

<script>
    if (Object.keys(burndownChartData).length > 0) {
        // Tomar los datos del primer sprint como ejemplo
        let specificSprintData = burndownChartData[Object.keys(burndownChartData)[sprintId]];

        const ctx = document.getElementById('burndownChart').getContext('2d');

        const data = {
            labels: Array.from({ length: specificSprintData.length }, (_, i) => i + 1),
            datasets: [{
                label: 'Tiempo Estimado Restante',
                data: specificSprintData,
                fill: false,
                borderColor: 'rgb(75, 192, 192)',
                tension: 0.1
            }]
        };

        const config = {
            type: 'line',
            data: data,
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        };

        const burndownChart = new Chart(ctx, config);
    } else {
        console.error("No hay datos para mostrar en el gráfico burndown.");
    }
</script>


<?php require "views/shared/footer.php"; ?>