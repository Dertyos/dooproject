<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/style.css">
    <title><?= $data['title'] ?></title>
    <script src="https://kit.fontawesome.com/21d7b20d22.js" crossorigin="anonymous"></script>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Scrum Teams Manager</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="index.php?controller=home&action=index">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="index.php?controller=task&action=index">Tasks</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="index.php?controller=sprint&action=index">Sprints</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="index.php?controller=developer&action=index">Developers</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="index.php?controller=scrumTeam&action=index">Scrum Teams</a>
                    </li>
                    
                </ul>
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <span class="navbar-text">
                            <?php if(isset($_SESSION['documentNumber'])): ?>
                                <?= htmlspecialchars($_SESSION['documentNumber']) ?>
                            <?php endif; ?>
                        </span>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="index.php?controller=developer&action=logout">
                            <i class="fas fa-power-off"></i> Logout
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Resto del contenido del cuerpo de la página aquí -->

    <!-- Incluir scripts de Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
</body>
</html>
